<?php
    ob_start(); // Thêm vào đầu tệp cart.php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class cart{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function add_to_cart($quantity, $id, $customer_id) {
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
        
            $query = "SELECT * FROM sanpham WHERE MaSP = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
        
            $image = $result['hinhanh'];
            $productName = $result['TenSP'];
        
            // Lấy thông tin giá và kiểm tra giá sale
            $originalPrice = (float)$result['Gia']; // Giá gốc
$salePercentage = (float)$result['GiaSale']; // Phần trăm giảm giá
$salePrice = $originalPrice - ($originalPrice * ($salePercentage / 100));

        
            // Sử dụng giá sale nếu có, nếu không sẽ sử dụng giá gốc
            $price = ($salePrice > 0) ? $salePrice : $originalPrice;
        
            $check_cart = "SELECT * FROM giohang WHERE MaSP = '$id' AND sId = '$sId'";
            $result_check = $this->db->select($check_cart);
        
            if ($result_check) {
                $cart_product = $result_check->fetch_assoc();
                $cart_quantity = $cart_product['SoLuong'];
                $new_quantity = $cart_quantity + $quantity;
                $query_update = "UPDATE giohang SET SoLuong = '$new_quantity' WHERE MaSP = '$id' AND sId = '$sId'";
                $update_result = $this->db->update($query_update);
        
                if ($update_result) {
                    header('Location:cart.php');
                } else {
                    header('Location:404.php');
                }
            } else {
                $query_insert = "INSERT INTO giohang(MaSP, MaKH, sId, TenSP, Gia, SoLuong, hinhanh) VALUES('$id', '$customer_id', '$sId', '$productName', '$price', '$quantity', '$image')";
                $result = $this->db->insert($query_insert);
        
                if ($result) {
                    header('Location:cart.php');
                } else {
                    header('Location:404.php');
                }
            }
        }
        
        
        public function get_product_cart($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM giohang WHERE MaKH = '$customer_id' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_cart_checkout($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM giohang WHERE MaKH = '$customer_id' AND  giohang.tinhtrang=1";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity, $cartId){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "UPDATE giohang SET SoLuong = '$quantity' WHERE MaGH = '$cartId'";
            $result = $this->db->update($query);
            if($result){
                $smg = "<span class='success'> Bạn đã cập nhật số lượng </span>";
                return $smg;
            }else{
                $smg = "<span class='error'> Cập nhật số lượng thất bại </span>";
                return $smg;
            }
        }

        public function del_product_cart($cartid){
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);
            $query = "DELETE FROM giohang WHERE MaGH = '$cartid'";
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
            }
        }

        public function check_cart($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM giohang WHERE sId = '$sId' AND MaKH='$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function check_order($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM dathang WHERE MaKH='$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_all_data_cart($customer_id){
            $sId = session_id();
            $query = "DELETE FROM giohang WHERE MaKH = '$customer_id' AND sId = '$sId' AND tinhtrang='1'";
            $result = $this->db->delete($query);
            return $result;
        }
        public function show_all_cart(){
            // Kiểm tra xem người dùng có đăng nhập không
            if(isset($_SESSION['customer_id'])) {
                $userId = $_SESSION['customer_id'];
                $query = "SELECT * FROM giohang WHERE MaKH = '$userId'";
                $result = $this->db->select($query);
                return $result;
            } else {
                // Xử lý trường hợp người dùng chưa đăng nhập
            }
        }

        public function show_quantity_product_cart($id) {
            $query = "SELECT * FROM sanpham WHERE MaSP = '$id'";
            $result = $this->db->select($query);
            return $result;

        }
        public function insertOrder($customer_id){
            // $sId = session_id();
            $query = "SELECT * FROM giohang WHERE MaKH = '$customer_id' AND tinhtrang='1' ";
            $get_product = $this->db->select($query);
            $order_code = rand(0000, 9999);
           // inssert vao da dat hang
            $query_placed = "INSERT INTO dadathang(MaDonH, tinhtrang, MaKH) VALUES('$order_code', '0', '$customer_id')";
            $insert_placed = $this->db->insert($query_placed);
            if($get_product){
                while($result= $get_product->fetch_assoc()){
                    $productid = $result['MaSP'];
                    $productName = $result['TenSP'];
                    $customer_id = $result['MaKH'];
                    $quantity = $result['SoLuong'];
                    $price = $result['Gia'] * $quantity;
                    $image = $result['hinhanh'];
                    $query_order = "INSERT INTO dathang(MaSP, TenSP, MaKH, SoLuong, Gia, hinhanh, MaDonH) VALUES('$productid', '$productName', '$customer_id', '$quantity', '$price', '$image', '$order_code')";
                    $insert_order = $this->db->insert($query_order);

                }
            }
        }
        public function getAmountPrice($customer_id){
            $query = "SELECT Gia FROM dathang WHERE MaKH = '$customer_id' AND ngaymua = now()";
            $get_price = $this->db->select($query);
            return $get_price;
        }
        public function get_cart_ordered($customer_id){
            $query = "SELECT * FROM dathang WHERE MaKH = '$customer_id'";
            $get_price = $this->db->select($query);
            return $get_price;
        }
        
        public function get_inbox_cart(){
            $query = "SELECT * FROM dadathang, khachhang WHERE dadathang.MaKH = khachhang.MAKH  ORDER BY date_create DESC";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;
        }
         public function get_inbox_cart_history($customer_id){
            $query = "SELECT * FROM dadathang, khachhang WHERE dadathang.MaKH = khachhang.MAKH AND dadathang.MaKH = '$customer_id' ORDER BY date_create DESC";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;
         }
        public function shifted($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            
            $query = "UPDATE dadathang SET tinhtrang = '1' WHERE MaDonH = '$id'";
            $result = $this->db->update($query);
            if($result){
                $smg = "<span class='success'>Cập nhật thành công</span>";
                return $smg;
            }else{
                $smg = "<span class='error'>Cập nhật số lượng thất bại</span>";
                return $smg;
            }

        }
        // public function danhanhang($id){
        //     $id = mysqli_real_escape_string($this->db->link, $id);
            
        //     $query = "UPDATE dadathang SET tinhtrang = '2' WHERE MaDonH = '$id'";
        //     $result = $this->db->update($query);
        //     if($result){
        //         $smg = "<span class='success'>Cập nhật thành công</span>";
        //         return $smg;
        //     }else{
        //         $smg = "<span class='error'>Cập nhật số lượng thất bại</span>";
        //         return $smg;
        //     }
        // }
        public function danhanhang($danhanhang){
            $id = mysqli_real_escape_string($this->db->link, $danhanhang);
            
            $query = "UPDATE dadathang SET tinhtrang = '2' WHERE MaDonH = '$id'";
            $result = $this->db->update($query);
            if($result){
                $smg = "<span class='success'>Cập nhật thành công</span>";
            } else {
                $smg = "<span class='error'>Cập nhật số lượng thất bại</span>";
                return $smg; // Trả về thông báo lỗi nếu không cập nhật được trạng thái
            }
        
            $now = date("Y-m-d H:i:s"); 
        
            $sql = "SELECT dathang.SoLuong, dathang.Gia FROM dathang INNER JOIN dadathang ON dathang.MaDonH = dadathang.MaDonH WHERE dadathang.tinhtrang = '2' AND dathang.MaDonH = dadathang.MaDonH";
            $result_dathang = $this->db->select($sql);
        
            $soluongmua = 0;
            $danhthu = 0;
        
            while ($row = $result_dathang->fetch_assoc()) {
                $soluongmua += $row['SoLuong'];
                $danhthu += $row['SoLuong'] * $row['Gia'];
            }
        
            $sql_existing = "SELECT * FROM thongke WHERE ngaydat = '$now'";
            $result_existing = $this->db->select($sql_existing);
        
            if ($result_existing->num_rows == 0) {
                $sql_insert_thongke = "INSERT INTO thongke(ngaydat, donhang, danhthu, soluong) VALUES ('$now', '$soluongmua', '$danhthu', '1')";
                $this->db->insert($sql_insert_thongke);
            } else {
                $sql_update_thongke = "UPDATE thongke SET donhang = '$soluongmua', danhthu = '$danhthu' WHERE ngaydat = '$now'";
                $this->db->update($sql_update_thongke);
            }
        
            return $smg;
        }
        public function returns($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
            
            $query = "UPDATE dadathang SET tinhtrang = '3' WHERE MaDonH = '$id'";
            $result = $this->db->update($query);
            if($result){
                $smg = "<span class='success'>Cập nhật thành công</span>";
                return $smg;
            }else{
                $smg = "<span class='error'>Cập nhật số lượng thất bại</span>";
                return $smg;
            }

        }
        public function del_shifted($id){
            $id = mysqli_real_escape_string($this->db->link, $id);
        
            $query1 = "DELETE FROM dadathang WHERE MaDonH = '$id'";
            $result1 = $this->db->delete($query1);
        
            $query2 = "DELETE FROM dathang WHERE MaDonH = '$id'";
            $result2 = $this->db->delete($query2);
        
            if($result1 && $result2){
                $smg = "<span class='success'>Xóa thành công</span>";
            } else {
                $smg = "<span class='error'>Xóa thất bại</span>";
            }
            return $smg;
        }
        
        public function shifted_confirmd($id, $price, $time){
            $id = mysqli_real_escape_string($this->db->link, $id);
            $price = mysqli_real_escape_string($this->db->link, $price);
            $time = mysqli_real_escape_string($this->db->link, $time);
            
            $query = "UPDATE dadathang SET tinhtrang = '2' WHERE MaKH = '$id' AND  Gia = '$price' AND ngaymua='$time'";
            $result = $this->db->update($query);
            // return $result;
        }

    }
?>