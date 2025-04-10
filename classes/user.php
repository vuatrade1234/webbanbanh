<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
class user{

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database(); //class trong file database
        $this->fm = new Format(); //class trong file format
    }
    
    public function insert_user($username, $password, $name, $email){
        $username = $this->fm->validation($username);//kiem tra hop le, validation trong file format
        $password = $this->fm->validation($password);
        $name = $this->fm->validation($name);
        $email = $this->fm->validation($email);

        $username = mysqli_real_escape_string($this->db->link, $username);//link trong file database
        $password = mysqli_real_escape_string($this->db->link, $password);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if(empty($username) || empty($password) || empty($name) || empty($email)){
            $alert = "<span class='error'>Tên đăng nhập, mật khẩu, email, họ tên không được bỏ trống </span>";
            return $alert;
        }else{
            $query = "INSERT INTO taikhoan(username, password, name, email) VALUES('$username', '$password', '$name', '$email')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'>Thêm tài khoản thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='success'>Thêm tài khoản không thành công</span>";
                return $alert;
            }
        }   
    }

    public function show_user(){
        $query = "SELECT * FROM taikhoan order by adminId";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_user($username, $name, $email,$id){$username = mysqli_real_escape_string($this->db->link, $username);//link trong file database
        $name = mysqli_real_escape_string($this->db->link, $name);
        $email = mysqli_real_escape_string($this->db->link, $email);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($username)  || empty($name) || empty($email)){
            $alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
            return $alert;
        }else{
            $query = "UPDATE taikhoan SET username = '$username', name = '$name', email = '$email' WHERE adminId = '$id'";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='cs'>Sửa tài khoản thành công</span>";
                echo $alert;
                
            }else{
                $alert = "<span class='error'>Sửa tài khoản thất bại</span>";
                echo $alert;
            }
        }   
    }

    public function delete_user($id){
        $query = "DELETE FROM taikhoan WHERE adminId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='cs'>Xoá tài khoản thành công</span>";
            echo $alert;
            
        }else{
            $alert = "<span class='error'>Xoá tài khoản thất bại</span>";
            echo $alert;
        }
    }  

 

    public function getuserbyId($id){
        $query = "SELECT * FROM taikhoan WHERE adminId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

}
?>