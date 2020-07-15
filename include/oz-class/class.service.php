<?php
class Service extends Database {
    public function get_service ($id) {
        $sql = "SELECT * FROM service WHERE id = ?";
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

    public function get_service_by_slug ($slug) {
        $sql = "SELECT * FROM service WHERE urlcomponent = ?";
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

    public function get_services ($limiter = "") {
        $limit = $limiter ? " LIMIT $limiter" : "";
        $sql = "SELECT * FROM service WHERE 1=1 ORDER BY id DESC $limit";
        if ( $obj = $this->db_fetch_obj($sql) ){
            return $obj;
        }
        return $obj;
    }
    
}