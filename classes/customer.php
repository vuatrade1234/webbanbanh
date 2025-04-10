

<?php
    
     $filepath = realpath(dirname(__FILE__));
     include_once($filepath.'/../lib/database.php');
     include_once($filepath.'/../helpers/format.php');

?>
<?php
class customer{

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database(); //class trong file database
        $this->fm = new Format(); //class trong file format
    }


    public function insert_customer($data){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $yearold = mysqli_real_escape_string($this->db->link, $data['yearold']);
        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        
        if ($name == "" || $yearold == "" || $email == "" || $username == "" || $address == "" || $phone == "" || $password == "") {
            $alert = "<span class='error'>Không được bỏ trống</span>";
            return $alert;
        } else {
            $check_username_email = "SELECT * FROM khachhang WHERE Username='$username' OR Email='$email' LIMIT 1";
            $result_check = $this->db->select($check_username_email);
        
            if ($result_check) {
                $alert = "<span class='error'>Username hoặc email đã tồn tại</span>";
                return $alert;
            } else {
                $query = "INSERT INTO khachhang (Email, Username, Password, HoTen, NgaySinh, SDT, DiaChi) VALUES('$email', '$username', '$password', '$name', '$yearold', '$phone', '$address')";
                $result = $this->db->insert($query);
        
                if ($result) {
                    $alert = "<span class='success'>Đăng ký thành công</span>";
                    return $alert;
                    // header('Location:index.php');
                } else {
                    $alert = "<span class='success'>Đăng ký không thành công</span>";
                    return $alert;
                }
            }
        }
    }
    public function insert_binhluan($customer_id, $id){
        // $productid = $_POST['product_id_binhluan'];
        $tenbinhluan = $_POST['tennguoibinhluan'];
        $binhluan = $_POST['binhluan'];

        if($tenbinhluan=='' || $binhluan==''){
            $alert = "<span class='error'>Không được bỏ trống</span>";
            return $alert;
        }else{
            $query = "INSERT INTO binhluan(TenNBL, binhluan, MaSP, MaKH) VALUES('$tenbinhluan', '$binhluan', '$id', '$customer_id')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class ='success'>Bạn đã thêm bình luận</span>";
                    return $alert;
                    // header('Location:index.php');
                }else{
                    $alert = "<span class = 'success'>Thêm bình luận lỗi</span>";
                    return $alert;
    
                }

        }
    }
    public function update_comment($MaBL, $reply ){
        $reply = mysqli_real_escape_string($this->db->link, $reply);
        if($reply==''){
            $alert = "<span class='error'>Không được bỏ trống</span>";
            return $alert;
        }else{
            $query = "UPDATE binhluan SET TraLoi_BL='$reply' WHERE MaBL='$MaBL'";
            $result = $this->db->update($query);

            if($result){
                $alert = "<span class='error'>Đã trả lời</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Trả lời thất bại</span>";
                return $alert;
            }
        }
    }
    public function login_customer($data){
        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if( $username == '' || $password==''){
            $alert = "<span class='error'>Username và password không được bỏ trống</span>";
            return $alert;
        }else{
            $check_login = "SELECT * FROM khachhang WHERE Username='$username' AND Password='$password'";
            $result_check = $this->db->select($check_login);
            if($result_check){
                $value = $result_check->fetch_assoc();
                Session::set('customer_login',true);
                Session::set('customer_id',$value['MAKH']);
                Session::set('customer_name',$value['HoTen']);
                header("Location: " . $_SERVER['REQUEST_URI']);
                // header('Location:index.php');
            }else{
                $alert = "<span class='error'>Username hoặc password không đúng</span>";
                return $alert;
            }
        }
    }
    public function resetPassword_customer($email, $password) {
        $password = $password;
        $query = "UPDATE khachhang SET password = '$password' WHERE Email = '$email'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Mật khẩu đã được cập nhật thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Mật khẩu chưa được cập nhật</span>";
            return $msg;
        }
    }
    public function show_customers($id){
        $query = "SELECT * FROM khachhang WHERE MAKH = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_order($order_code){
        $query = "SELECT * FROM dathang WHERE MaDonH = '$order_code'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_customer_detail($customer_id){
        $query = "SELECT * FROM khachhang WHERE MAKH = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_binhluan($id){
        $query = "SELECT * FROM binhluan WHERE MaSP = '$id'";
        $result = $this->db->select($query);
        return $result;
        
    }
    public function show_binhluan_customerid($id,$customer_id){
        $query = "SELECT * FROM binhluan WHERE MaSP = '$id' AND MaKH= '$customer_id'";
        $result = $this->db->select($query);
        return $result;
        
    }
    public function show_all_binhluan(){
        $query = "SELECT binhluan.*, sanpham.TenSP FROM binhluan INNER JOIN sanpham ON binhluan.MaSP = sanpham.MaSP";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_customer($data, $id){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $yearold = mysqli_real_escape_string($this->db->link, $data['yearold']);
        $username = mysqli_real_escape_string($this->db->link, $data['username']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);

        if($name=="" || $yearold=="" || $username=="" || $address=="" || $phone=="" ){
            $alert = "<span class='error'>Không được bỏ trống các trường</span>";
            return $alert;
        }else{
                $query = "UPDATE khachhang SET Username = '$username', HoTen = '$name', NgaySinh = '$yearold', SDT = '$phone', DiaChi = '$address' WHERE MAKH = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Sửa thành công</span>";
                    return $alert;
                    // header('Location:index.php');
                }else{
                    $alert = "<span class = 'success'>Sửa không thành công</span>";
                    return $alert;
    
                }
        }
    }
    public function del_binhluan($blid){
        $query = "DELETE FROM binhluan WHERE MaBL = '$blid'";
        $result = $this->db->delete($query);
        return $result;
    }      
    
}

?>