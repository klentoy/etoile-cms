<?php    
    class Gallery extends Database{

        public function get_gallery ($id) {
            $sql = "SELECT * FROM gallery WHERE id = ?";
            $stmt = $this->db_prepare($sql);
            $stmt->bind_param('i', $id);
            if ( $stmt->execute() ){
                $result = $stmt->get_result();
                while($row = $result->fetch_object()) {
                    $data = $row;
                }
                return $data;
            }
            return false;
        }

        public function get_galleries () {
            $sql = "SELECT * FROM gallery ORDER BY id DESC";
            if ( $obj = $this->db_fetch_obj($sql) ){
                return $obj;
            }
            return $obj;
        }
        
    }


