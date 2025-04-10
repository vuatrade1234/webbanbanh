<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
class brand {

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database(); //class trong file database
        $this->fm = new Format(); //class trong file format
    }

    public function insert_brand($brandname){
        $brandname = $this->fm->validation($brandname);   
        $brandname = mysqli_real_escape_string($this->db->link, $brandname); 
        if(empty($brandname)){
            $alert = "<span class='error'>Thương hiệu không được bỏ trống</span>";
            return $alert;
        }else{
            $query = "INSERT INTO thuonghieu(TenTH) VALUES('$brandname')";
            $result = $this->db->insert($query);
    
            if($result){
                $alert = "<span class='success'>Thêm thương hiệu thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm thương hiệu thất bại</span>";
            }
        }   
    }

    public function show_brand(){
        $query = "SELECT * FROM thuonghieu ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getbrandbyId($id){
        $query = "SELECT * FROM thuonghieu WhERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($brandname, $id){
        $brandname = $this->fm->validation($brandname); 
        $brandname = mysqli_real_escape_string($this->db->link, $brandname);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($brandname)){
            $alert = "<span class='error'>thương hiệu không được bỏ trống</span>";
            return $alert;
        }else{
            $query = "UPDATE thuonghieu SET TenTH = '$brandname' WHERE id = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Cập nhật thương hiệu thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Cập nhật thương hiệu thất bại</span>";
                return $alert;
            }
        }
    }
    public function del_brand($id){
        $query = "DELETE FROM thuonghieu WHERE id = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'>Xóa thương hiệu thành công</span>";
            return $alert;
        }else{
            $alert = "<span class='error'>Xóa thương hiệu thất bại</span>";
            return $alert;
        }
    }

}
?>