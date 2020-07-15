<?php

use Verot\Upload\Upload;

class Blogs extends Database
{
    private $table_name = "blogs";
    private $valid_ext = array("pdf", "doc", "docx", "jpg", "png", "jpeg");
    private $upload_location = "../uploads/blogsimages/";
    private $upload_url_loc = "/uploads/blogsimages/";

    public $id;
    public $title;
    public $subtitle;
    public $slug;
    public $published;
    public $startdate;
    public $image;
    public $detail;
    public $youtube;
    public $category;
    public $tags;
    public $comment;
    public $imagealt;
    public $imagetitle;
    public $seo_title;
    public $meta_desc;
    public $short_desciption;

    public function get_posts()
    {
        $q = "SELECT * FROM blogs WHERE 1=1 ORDER BY id";
        if ($result = $this->db_fetch_obj($q)) {
            return $result;
        }
    }

    public function get_post($id = "")
    {
        if ($id) {
            $post_id = $id;
        } elseif (isset($_GET['post'])) {
            $post_id = $_GET['post'];
        } else {
            return false;
        }
        $stmt_str = "SELECT * FROM blogs WHERE id = $post_id";
        if ($result = $this->db_fetch_obj($stmt_str)) {
            return $result[0];
        }
        return false;
    }

    public function save_post()
    {
        if ($_POST) :
            $this->id = isset($_GET['post']) ? $_GET['post'] : '';
            $this->title = isset($_POST['title']) ? $_POST['title'] : '';
            $this->subtitle = isset($_POST['subtitle']) ? $_POST['subtitle'] : '';
            $this->slug = isset($_POST['slug']) ? $_POST['slug'] : '';
            $this->is_published = isset($_POST['is_published']) ? $_POST['is_published'] : '';
            // $this->startdate = isset($_POST['startdate']) ? $_POST['startdate'] : '';
            $this->startdate = date('Y-m-d H:i:s');
            $this->image = isset($_FILES) ? $_FILES : '';
            $this->detail = isset($_POST['detail']) ? $_POST['detail'] : '';
            $this->youtube = isset($_POST['youtube']) ? $_POST['youtube'] : '';
            $this->category = isset($_POST['category']) ? $_POST['category'] : '';
            $this->tags = isset($_POST['tags']) ? $_POST['tags'] : '';
            $this->comment = isset($_POST['comment']) ? $_POST['comment'] : '';
            $this->imagealt = isset($_POST['imagealt']) ? $_POST['imagealt'] : '';
            $this->imagetitle = isset($_POST['imagetitle']) ? $_POST['imagetitle'] : '';
            $this->seo_title = isset($_POST['seo_title']) ? $_POST['seo_title'] : '';
            $this->meta_desc = isset($_POST['meta_desc']) ? $_POST['meta_desc'] : '';
            $this->short_desciption = isset($_POST['short_description']) ? $_POST['short_description'] : '';
            if ($this->id) {
                $query = "UPDATE " . $this->table_name . " SET title = ?, subtitle = ?, slug = ?, is_published = ?, startdate = ?, detail = ?, youtube = ?, category = ?, tags = ?, comment = ?, imagealt = ?, imagetitle = ?, seo_title = ?, meta_desc = ?, short_description = ? WHERE id = ?";
                $stmt = $this->db_prepare($query);
                $stmt->bind_param('sssisssssssssssi', $this->title, $this->subtitle, $this->slug, $this->is_published, $this->startdate, $this->detail, $this->youtube, $this->category, $this->tags, $this->comment, $this->imagealt, $this->imagetitle, $this->seo_title, $this->meta_desc, $this->short_description, $this->id);

                if ($stmt->execute()) {
                    $file = $this->upload_file($this->image);

                    $stmt2 = $this->db_prepare("UPDATE " . $this->table_name . " SET image = ? WHERE id = ?");
                    $stmt2->bind_param("si", $file, $this->id);
                    $stmt2->execute();
                    $stmt2->close();

                    return true;
                }
                return false;
            } else {
                $query = "INSERT " . $this->table_name . " SET title = ?, subtitle = ?, slug = ?, is_published = ?, startdate = ?, image = ?, detail = ?, youtube = ?, category = ?, tags = ?, comment = ?, imagealt = ?, imagetitle = ?, seo_title = ?, meta_desc = ?, short_description = ?";
                $stmt = $this->db_prepare($query);
                $stmt->bind_param('sssissssssssssss', $this->title, $this->subtitle, $this->slug, $this->is_published, $this->startdate, $this->image, $this->detail, $this->youtube, $this->category, $this->tags, $this->comment, $this->imagealt, $this->imagetitle, $this->seo_title, $this->meta_desc, $this->short_description);

                if ($stmt->execute()) {
                    $id = $stmt->insert_id;
                    $file = $this->upload_file($this->image);

                    $stmt2 = $this->db_prepare("UPDATE " . $this->table_name . " SET image = ? WHERE id = ?")
                        ->bind_param("si", $file, $id)
                        ->execute();
                    $stmt2->close();

                    return true;
                }
                return false;
            }
        endif;
    }

    private function upload_file($filename)
    {
        if (isset($filename['image_large'])) {
            $location = $this->upload_location . $filename['image_large']['name'];
            $uploaded_url = BASE_URL . $this->upload_url_loc . $filename['image_large']['name'];

            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            if (in_array($file_extension, $this->valid_ext)) {
                if (move_uploaded_file($filename['image_large']['tmp_name'], $location)) {
                    if ( isset($filename) ){
                        $this->upload_file_resizer($filename['image_large']);
                    } 
                    return $uploaded_url;
                }
            }
            return false;
        }
    }

    private function upload_file_resizer($file)
    {
        $handle = new Upload($file);
        if ($handle->uploaded) {
            $handle->file_new_name_body   =  $file['image_large']['tmp_name'] . "_thumb";
            $handle->image_resize         = true;
            $handle->image_x              = 100;
            $handle->image_ratio_y        = true;
            $handle->process($this->upload_location);
            if ($handle->processed) {
                // echo 'image resized';
                $handle->clean();
            } else {
                echo 'error : ' . $handle->error;
            }
        }
    }
}
