<?php
$filepath = realpath(dirname(__FILE__));
    include ($filepath.'/../lib/session.php');
    Session::checkLogin();//goi ham trong file session
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
    include_once ('privileges.php');
?>

<?php
class adminlogin{

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database(); //class trong file database
        $this->fm = new Format(); //class trong file format
    }

    public function login_admin($username, $password){
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
    
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
    
        if(empty($username) || empty($password)){
            $alert = "Tên đăng nhập và mật khẩu không được bỏ trống";
            return $alert;
        }else{
            $query = "SELECT * FROM taikhoan WHERE username = '$username' AND password = '$password' LIMIT 1";
            $result = $this->db->select($query);
    
            if($result != false){
                $value = $result->fetch_assoc();
                Session::set("adminlogin", true);
                Session::set("adminId", $value['adminId']);
                Session::set("username", $value['username']);
                Session::set("name", $value['name']);
    
                // Sử dụng adminId từ kết quả truy vấn để lấy tất cả các quyền của người dùng
                $userPrivileges ="SELECT * FROM user_privileges INNER JOIN phanquyen on user_privileges.phanquyen_id = phanquyen.MaQuyen WHERE user_privileges.taikhoan_id = ".$value['adminId'];
                // Đảm bảo rằng hàm select trả về một mảng
                $userPrivileges = $this->db->select($userPrivileges);
    
                if(!empty($userPrivileges)){
                    $value['privileges'] = array();
                    foreach($userPrivileges as $privileges){
                        $value['privileges'][] =  $privileges['url_match'];         
                    }
                }
                $_SESSION['current_user'] = $value;
                header("Location: index.php");
            }else{
                $alert = "Tên đăng nhập hoặc mật khẩu không đúng";
                return $alert;
            }
        }   
    }

    public function resetPassword($username, $password) {
        $password = $password;
        $query = "UPDATE taikhoan SET password = '$password' WHERE username = '$username'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>Mật khẩu đã được cập nhật thành công</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Mật khẩu chưa được cập nhật</span>";
            return $msg;
        }
    }

}
?>