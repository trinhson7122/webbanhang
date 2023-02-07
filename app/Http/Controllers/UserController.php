<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        if($request->has('image')){
            $name = 'user' . time() . '.' . $request->file('image')->extension();
            $file_name = $request->file('image')->storeAs('images/users', $name ,  'public');
            User::create(
                [
                    'name' => $validated['name'],
                    'image' => Storage::url($file_name),
                    'phone' => $validated['phone'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]
            );
        } 
        else{
            User::create(
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]
        );
        }
        
        return to_route('admin.user_manager')->with('message', 'Thêm người dùng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Sửa hồ sơ';
        $user = User::find($id);
        return view('client.editProfile', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        if($request->has('image')){
            $t = Storage::disk('public')->delete(str_replace("storage/", '', $user->image));
            $name = 'user' . time() . '.' . $request->file('image')->extension();
            $file_name = $request->file('image')->storeAs('images/users', $name ,  'public');
            //dd($t);
            $user->update([
                'image' => Storage::url($file_name),
            ]);
        }
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);
        return to_route('profile')->with('message', 'Cập nhật hồ sơ thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::allows('is-super-admin', auth()->user())){
             $user->delete();
            return to_route('admin.user_manager')->with('message', 'Xóa người dùng thành công');
        }
       abort(403);
    }
}
