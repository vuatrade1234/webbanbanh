<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
class product {

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database(); //class trong file database
        $this->fm = new Format(); //class trong file format
    }
    public function search_product($tukhoa){
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * FROM sanpham WHERE TenSP  LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }
    public function insert_product($data, $files){
  
        $productname = mysqli_real_escape_string($this->db->link, $data['productname']);  
        $category = mysqli_real_escape_string($this->db->link, $data['category']); 
        $brand= mysqli_real_escape_string($this->db->link, $data['brand']); 
        $productdesc = mysqli_real_escape_string($this->db->link, $data['productdesc']); 
        $expiry = mysqli_real_escape_string($this->db->link, $data['expiry']); 
        $origin = mysqli_real_escape_string($this->db->link, $data['origin']);
        $dateofanufacture = mysqli_real_escape_string($this->db->link, $data['dateofanufacture']);
        $weight = mysqli_real_escape_string($this->db->link, $data['weight']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']); 
        $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']); 
        //kiem tra va lay anh
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        
        if($productname == "" || $category == "" ||  $brand == ""  || $productdesc == "" || $expiry == "" || $price == "" || $weight == "" || $origin == "" || $dateofanufacture == "" || $quantity == "" || $type == "" || $file_name == ""){
            $alert = "<span class='error'>Các trường không được bỏ trống</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO sanpham(TenSP, MaDM, MaTH, Mota, Gia, Type, XuatXu ,NgaySX, HanSD, KhoiLuong,Soluong, hinhanh) 
            VALUES('$productname', '$category', '$brand', '$productdesc', '$price', '$type','$origin', '$dateofanufacture','$expiry', '$weight', '$quantity', '$unique_image')";
            $result = $this->db->insert($query);
    
            if($result){
                $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Thêm sản phẩm thất bại</span>";
            }
        }   
    }
        public function insert_images_product($files, $id){
            //kiem tra va lay anh
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            
            if($file_name == ""){
                $alert = "<span class='error'>Các trường không được bỏ trống</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO product_images(MaSP, ct_hinhanh) 
                VALUES('$id', '$unique_image')";
                $result = $this->db->insert($query);
        
                if($result){
                    $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Thêm sản phẩm thất bại</span>";
                }
            }   
        }
    public function show_product(){
        $query = "SELECT sanpham.*,danhmuc.TenDM, thuonghieu.TenTH 
        FROM sanpham INNER JOIN danhmuc ON sanpham.MaDM = danhmuc.MaDM
        INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.id
        ORDER BY sanpham.MaSP DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_inages_product($id){
        $query = "SELECT * from  product_images WHERE MaSP = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproductbyId($id){
        $query = "SELECT * FROM sanpham WhERE MaSP = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id){
        $productname = mysqli_real_escape_string($this->db->link, $data['productname']);  
        $category = mysqli_real_escape_string($this->db->link, $data['category']); 
        $brand= mysqli_real_escape_string($this->db->link, $data['brand']); 
        $productdesc = mysqli_real_escape_string($this->db->link, $data['productdesc']); 
        $expiry = mysqli_real_escape_string($this->db->link, $data['expiry']); 
        $origin = mysqli_real_escape_string($this->db->link, $data['origin']);
        $dateofanufacture = mysqli_real_escape_string($this->db->link, $data['dateofanufacture']);
        $weight = mysqli_real_escape_string($this->db->link, $data['weight']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']); 
        $quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']); 
        $salePrice = isset($data['salePrice']) ? mysqli_real_escape_string($this->db->link, $data['salePrice']) : '0%';
        //kiem tra va lay anh
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if($productname == "" || $category == "" ||  $brand == ""  || $productdesc == "" || $expiry == "" || $quantity == "" || $price == "" || $type == ""){
            $alert = "<span class='error'>Các trường không được bỏ trống</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                //Neu nguoi dung chon anh
                if($file_size > 400*1024*1024){
                    $alert = "<span class='error'>Kích thước ảnh 400MB!</span>";
                    return $alert;
                }elseif(in_array($file_ext, $permited) === false)
                {
                    $alert = "<span class='error'>Bạn có thể upload những file ảnh:".implode(', ', $permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE sanpham SET TenSP = '$productname', MaDM = '$category', MaTH = '$brand',  Mota = '$productdesc',Gia = '$price', GiaSale = '$salePrice', Type = '$type', XuatXu = '$origin', NgaySX = '$dateofanufacture', HanSD = '$expiry', KhoiLuong = '$weight', SoLuong = '$quantity',hinhanh = '$unique_image' WHERE MaSP = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Cập nhật sản phẩm thất bại</span>";
                    return $alert;
                }
            }else{
                $query = "UPDATE sanpham SET TenSP = '$productname', MaDM = '$category', MaTH = '$brand',  Mota = '$productdesc',Gia = '$price', GiaSale = '$salePrice', Type = '$type', XuatXu = '$origin', NgaySX = '$dateofanufacture', HanSD = '$expiry', KhoiLuong = '$weight', SoLuong = '$quantity' WHERE MaSP = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Cập nhật sản phẩm thất bại</span>";
                    return $alert;
                }
            }
            
        }
       
    }
    public function del_product($id){
        $query = "DELETE FROM sanpham WHERE MaSP = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'>Xóa sản phẩm thành công</span>";
            return $alert;
        }else{
            $alert = "<span class='error'>Xóa sản phẩm thất bại</span>";
            return $alert;
        }
    }
    public function del_wlist($proid, $customer_id){
        $query = "DELETE FROM spyeuthich WHERE MaSP = '$proid' AND MaKH = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }


    public function getproduct_feathered(){
        $query = "SELECT * FROM sanpham WHERE type = '0' AND (GiaSale = '0' OR GiaSale='')";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_new(){
        $query = "SELECT * FROM sanpham WHERE type = '1' AND (GiaSale = '0' OR GiaSale='') ORDER BY MaSP DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function sale_product(){
        $query = "SELECT * FROM sanpham where GiaSale > 0 ORDER BY MaSP ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($id){
        $query = "SELECT sanpham.*,danhmuc.TenDM, thuonghieu.TenTH 
        FROM sanpham INNER JOIN danhmuc ON sanpham.MaDM = danhmuc.MaDM
        INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.id
        WHERE sanpham.MASP = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_wishlist($customer_id){
        $query = "SELECT * FROM spyeuthich WHERE MaKH = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details_product($id){
    $query = "SELECT sanpham.*,danhmuc.TenDM, thuonghieu.TenTH 
    FROM sanpham INNER JOIN danhmuc ON sanpham.MaDM = danhmuc.MaDM
    INNER JOIN thuonghieu ON sanpham.MaTH = thuonghieu.id
    WHERE sanpham.MaDM = (SELECT MaDM FROM sanpham WHERE MASP = '$id')";
    $result = $this->db->select($query);
    return $result;
    }
    public function insertWishList($productid, $customer_id){
        $productid = mysqli_real_escape_string($this->db->link, $productid);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $check_wlist = "SELECT * FROM spyeuthich WHERE MaSP = '$productid' AND MaKH = '$customer_id'";
        $result_check_wlist = $this->db->select($check_wlist);

        if($result_check_wlist){
            $alert = "<span class='success'>sản phẩm đã có trong danh sách yêu thích</span>";
            return $alert;
        }else{
            $query = "SELECT * FROM sanpham WHERE MaSP = '$productid'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['TenSP'];
            $price = $result['Gia'];
            $image = $result['hinhanh'];

            $query_insert = "INSERT INTO spyeuthich(TenSPYT,  MaKH, Gia, hinhanh, MaSP) VALUES('$productName', '$customer_id', '$price', '$image', '$productid')";
            $insert_wlist = $this->db->insert($query_insert);
            if($insert_wlist){
                $alert = "<span class='success'>Sản phẩm được thêm vào danh sách yêu thích</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Sản phẩm không thêm vào danh sách yêu thích</span>";
                return $alert;
            }
        }
    }

        public function get_star($id, $customer_id){
            $query = "SELECT * FROM danhgiasao WHERE MaSP = '$id' AND MaKH = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_ktdadathang($id, $customer_id) {
            // Truy vấn để kiểm tra xem có đơn hàng nào tương ứng với sản phẩm và khách hàng không và trạng thái là 2 hay không
            $query = "SELECT * FROM dathang, dadathang WHERE dathang.MaSP = '$id' AND dathang.MaKH = '$customer_id' AND dathang.MaDonH = dadathang.MaDonH AND dadathang.tinhtrang = 2";
            
            // Thực hiện truy vấn và trả về kết quả
            $result = $this->db->select($query);
            return $result;
        }

}
?>