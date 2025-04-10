<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
class category {

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database(); //class trong file database
        $this->fm = new Format(); //class trong file format
    }

    public function insert_category($catname){
        $catname = $this->fm->validation($catname);  
        $catname = mysqli_real_escape_string($this->db->link, $catname);  
        if(empty($catname)){
            $alert = "<span class='error'>Danh mục không được bỏ trống</span>";
            return $alert;
        }else{
            $query = "INSERT INTO danhmuc(TenDM) VALUES('$catname')";
            $result = $this->db->insert($query);
    
            if($result){
                $alert = "<span class='success'>Thêm danh mục thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm danh mục thất bại</span>";
            }
        }   
    }

    public function show_category(){
        $query = "SELECT * FROM danhmuc ORDER BY MaDM DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getcatbyId($id){
        $query = "SELECT * FROM danhmuc WhERE MaDM = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catname, $id){
        $catname = $this->fm->validation($catname); 
        $catname = mysqli_real_escape_string($this->db->link, $catname);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if(empty($catname)){
            $alert = "<span class='error'>Danh mục không được bỏ trống</span>";
            return $alert;
        }else{
            $query = "UPDATE danhmuc SET TenDM = '$catname' WHERE MaDM = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Cập nhật danh mục thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Cập nhật danh mục thất bại</span>";
                return $alert;
            }
        }
    }
    public function del_category($id){
        $query = "DELETE FROM danhmuc WHERE MaDM = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'>Xóa danh mục thành công</span>";
            return $alert;
        }else{
            $alert = "<span class='error'>Xóa danh mục thất bại</span>";
            return $alert;
        }
    }

    public function show_category_fontend(){
        $query = "SELECT * FROM danhmuc ORDER BY MaDM DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_category_all(){
        $query = "SELECT * FROM danhmuc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_product_by_cat($id){
        $query = "SELECT * FROM sanpham WHERE MaDM = '$id' ORDER BY MaDM DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_name_by_cat($id){
        $query = "SELECT sanpham.*,danhmuc.TenDM, danhmuc.MaDM FROM sanpham, danhmuc WHERE sanpham.MaDM = danhmuc.MaDM AND danhmuc.MaDM = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}
?>