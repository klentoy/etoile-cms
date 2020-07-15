<?php
class Categories extends Database{
    private $table_name = "category";

    public function get_categories (){
        $q = "SELECT * FROM ". $this->table_name . " WHERE 1=1 ORDER BY id";
        if ($result = $this->db_fetch_obj($q)) {
            return $result;
        }
    }

    public function get_category ($id = ""){        
        $stmt_str = "SELECT * FROM ". $this->table_name . " WHERE id = $id";
        if ( $result = $this->db_fetch_obj($stmt_str) ){
            return $result[0];
        }
        return false;
    }

    public function save_category ($id = null) {
        if ( !isset($_POST) ) return false;

        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $slug = isset($_POST['slug']) ? $_POST['slug'] : '';
        if ( !$id ){
            $query = "INSERT SET ". $this->table_name . " name = ?, slug = ?";
            $stmt = $this->db_prepare($query);
            $stmt->bind_params('ss', $name, $slug);
        }else{
            $query = "UPDATE SET ". $this->table_name . " name = ?, slug = ? WHERE id = ?";
            $stmt = $this->db_prepare($query);
            $stmt->bind_params('ssi', $name, $slug, $id);
        }

        if($stmt->execute()){
            return true;
        }
    }

    
    public function slugify($text){
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}