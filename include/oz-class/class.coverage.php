<?php    
    class Coverage extends Database{

        public function get_coverage_by_slug ($slug) {
            $sql = "SELECT * FROM coverage WHERE urlcomponent = ?";
            $stmt = $this->db_prepare($sql);
            $stmt->bind_param('s', $slug);
            if ( $stmt->execute() ){
                $result = $stmt->get_result();
                while($row = $result->fetch_object()) {
                    $data = $row;
                }
                return $data;
            }
            return false;
        }

        public function get_coverage ($id) {
            $sql = "SELECT * FROM coverage WHERE id = ?";
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

        public function get_coverages () {
            $sql = "SELECT * FROM coverage WHERE 1=1 ORDER BY id DESC";
            if ( $obj = $this->db_fetch_obj($sql) ){
                return $obj;
            }
            return $obj;
        }

        
    }


