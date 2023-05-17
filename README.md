# Project Web bán trà sữa
 
## Dự án tổng hợp kiến thức
### Công nghệ sử dụng
- HTML5, CSS3, Bootstrap4 , Javascript, PHP 8.1, Laravel 9, Jquery.
- MySQL
- Pusher (Realtime)

### Đối tượng sử dụng
- Khách hàng chưa có tài khoản
- Khách hàng có tài khoản
- Cộng tác viên
- Quản trị viên

### Chức năng cho từng đối tượng
A. Khách hàng chưa có tài khoản
- Đăng kí
- Đăng nhập bằng mạng xã hội (Google, Facebook, Github)
- Thêm sản phẩm vào giỏ hàng
- Xem giỏ hàng, áp mã giảm giá
- Tìm kiếm theo tên sản phẩm

B. Khách hàng có tài khoản
- Đăng xuất
- Thêm sản phẩm vào giỏ hàng
- Xem giỏ hàng, áp mã giảm giá
- Tìm kiếm theo tên sản phẩm
- Đặt hàng
- Xem, sửa thông tin cá nhân
- Xem, hủy đơn hàng (Nếu đơn chưa được duyệt thì mới hủy được)

C. Cộng tác viên
- Thêm, sửa sản phẩm (Có xắp xếp theo id, tên, giá, số lượng)
- Thêm người dùng
- Xem và duyệt yêu cầu (Hủy, Chờ xác nhận, Đang giao hàng, Đã giao hàng)
- Thêm mã giảm giá
- Thêm ảnh banner và chọn ảnh nào xuất hiện

D. Quản trị viên
- Quản lý sản phẩm (Thêm, sửa, xóa)
- Quản lý người dùng (Thêm, xóa)
- Quản lý yêu cầu (Duyệt, xóa)
- Quản lý mã giảm giá (Thêm, sửa, xóa)
- Quản lý banner (Thêm, xóa, chọn)
### Phân tích chức năng
- Thêm sản phẩm vào giỏ hàng

Các tác nhân  | Khách hàng
------------- | -------------
Mô tả  | Thêm sản phẩm vào giỏ hàng
Kích hoạt  | Nhấn vào nút 'Thêm vào giỏ hàng' dưới sản phẩm
Trình tự xử lý  | - Thêm thông tin sản phẩm vào Session <br> - Nếu khách hàng đã đăng nhập thì thêm thông tin vào bảng CARTS
Đầu ra  | Thông báo thêm sản phẩm vào giỏ hàng thành công

- Áp mã giảm giá

Các tác nhân  | Khách hàng
------------- | -------------
Mô tả  | Áp dụng mã giảm giá vào giỏ hàng
Kích hoạt  | Nhấn vào nút 'Apply' bên cạnh đầu vào nhập mã giảm giá ở giỏ hàng
Đầu vào  | Tên mã giảm giá
Trình tự xử lý  | - Tìm kiếm tên mã giảm giá trong bảng COUPONS <br> - Nếu mã giảm giá tồn tại và số lượng > 0 thì mã đó có hiệu lực
Đầu ra  | Trang giỏ hàng hiện thị số tiền được giảm

- Đặt hàng

Các tác nhân  | Khách hàng có tài khoản
------------- | -------------
Mô tả  | Đặt các sản phẩm từ giỏ hàng
Kích hoạt  | Nhấn vào nút 'Đặt hàng' ở trang checkout
Đầu vào  | Các thông tin (Họ tên, mail, số điện thoại, địa chỉ). Nếu các thông tin đã có trong tài khoản thì lấy thông tin đó ra
Trình tự xử lý  | - Thêm yêu cầu vào bảng ORDERS và các sản phẩm vào bảng ORDER_DETAILS <br> - Nếu sử dụng mã giảm giá thì giảm số lượng còn của mã giảm giá đi 1 <br> - Xóa giỏ hàng
Đầu ra  | Điều hướng sang trang thông báo đặt hàng thành công

- Đăng nhập bằng mạng xã hội

Các tác nhân  | Khách hàng chưa có tài khoản
------------- | -------------
Mô tả  | Đăng nhập bằng mạng xã hội
Kích hoạt  | Nhấn vào biểu tượng có hình mạng xã hội ở trang đăng nhập
Trình tự xử lý  | - Kiểm tra nếu chưa có email và nhà cung cấp đó trong bảng USERS thì đăng ký tài khoản mới <br> - Nếu đã tồn tại trong bảng USERS thì đăng nhập bằng tài khoản đó
Đầu ra  | Điều hướng sang trang chủ khách hàng

...
