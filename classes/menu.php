<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'/../lib/database.php');
    include_once($filepath.'/../helpers/format.php');
?>
<?php
    class menu{
        private $db;
        private $fm;
    
        public function __construct(){
            $this->db = new Database(); //class trong file database
            $this->fm = new Format(); //class trong file format
        }
        public function show_menu(){
            $query = "SELECT * FROM menu order by menu.thutu ASC";
            $result = $this->db->select($query);
            return $result;
        }
        //privileges, kh them vao file privileges.php dc
        public function show_privileges(){
            $query = "SELECT * FROM phanquyen order by MaQuyen";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_privileges($insertString){
            $query ="INSERT INTO user_privileges (id, taikhoan_id, phanquyen_id) VALUES ".$insertString;
            $result = $this->db->insert($query);
        }

        public function show_usr_privileges(){
            if (isset($_GET['taikhoan_id'])) {
                $query = "SELECT * FROM user_privileges WHERE taikhoan_id = ".$_GET['taikhoan_id'];
                $result = $this->db->select($query);
                return $result;
            } else {
                // Handle the case where 'taikhoan_id' is not set in $_GET
            }
        }
        public function delete_usr_privileges($taikhoan_id){
            $query = "DELETE FROM user_privileges WHERE taikhoan_id = ".$taikhoan_id;
            $result = $this->db->delete($query);
        }
    }
?>