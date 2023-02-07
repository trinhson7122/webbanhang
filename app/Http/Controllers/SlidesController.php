<?php

namespace App\Http\Controllers;

use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);
        $file_name = time() . '.' . $request->file('image')->extension();
        //dd($file_name);
        $url = $request->file('image')->storeAs('images/slides', $file_name ,  'public');
        Slides::create([
            'image' => Storage::url($url),
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('message', 'Thêm slide thành công!');
    }

    public function update(Request $request, $id)
    {
        $slide = Slides::find($id);
        $arr = [
            'display' => 0
        ];
        if($request->has('display')){
            $arr['display'] = 1;
        }
        //dd($arr);
        $slide->update($arr);
        return redirect()->back()->with('message', 'Cập nhật hiển thị slide thành công!');
    }

    public function destroy($id)
    {
        $slide = Slides::find($id);
        $slide->delete();
        return redirect()->back()->with('message', 'Xóa slide thành công!');
    }
}
