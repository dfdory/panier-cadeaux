<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
 
$options = array(
    'delete_type' => 'POST',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => 'panier_cadeau',
    'db_table' => 'images'
);

error_reporting(E_ALL | E_STRICT);

require('UploadHandler.php');
class CustomUploadHandler extends UploadHandler {

    protected function initialize() {
        $this->db = new mysqli(
            $this->options['db_host'],
            $this->options['db_user'],
            $this->options['db_pass'],
            $this->options['db_name']
        );
        parent::initialize();
        $this->db->close();
    }

    protected function handle_form_data($file, $index) {
        //$file->title = @$_REQUEST['title'][$index];
        //$file->description = @$_REQUEST['description'][$index];
		$file->id = $_POST['id'];
		 
		
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = parent::handle_file_upload(
            $uploaded_file, $name, $size, $type, $error, $index, $content_range
        );
		
        if (empty($file->error)) {
			$sql = "INSERT INTO `".$this->options['db_table']
						."` (`id_cadeau`, `lien`)"
						." VALUES ('$file->id','$file->name')";
            
            $query = $this->db->prepare($sql);
           /* $query->bind_param(
                'sisss',
                $file->type,
                $file->name,
                $file->id_projet,
                $file->id_annonce,
                $file->id_location
            );*/
            //$query->execute();
			$this->db->query($sql);
            $file->id = $this->db->insert_id;
			echo $this->db->error;
        }
        return $file;
    }

    protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sql = 'SELECT `id`, `id_cadeau`, `lien` FROM `'
                .$this->options['db_table'].'` WHERE `id`=?';
            $query = $this->db->prepare($sql);
            $query->bind_param('s', $file->id);
            $query->execute();
            $query->bind_result(
                $id,
                $id_cadeau,
                $lien
            );
            while ($query->fetch()) {
                $file->id = $id;
                $file->id_cadeau = $id_cadeau;
                $file->lien = $lien;
            }
        }
    }

    public function delete($print_response = true) {
        $response = parent::delete(false);
        foreach ($response as $name => $deleted) {
            if ($deleted) {
                $sql = "DELETE FROM `"
                    .$this->options['db_table']."` WHERE `lien` like '$name' ";
				
                $query = $this->db->prepare($sql);
               // $query->bind_param('s', $name);
               // $query->execute();
			   $this->db->query($sql);
			  
            }
        } 
        return $this->generate_response($response, $print_response);
    }

}

$upload_handler = new CustomUploadHandler($options);