<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ALL | E_STRICT);
require(APPPATH.'/libraries/UploadHandler.php');

class Upload extends ManagerController {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Sort_model');
		$this->load->model('Upload_model');
		$this->load->model('Turf_model');
	}

	public function turf($id = 0)
	{
		$this->authenticate(current_url());

        $options = [
            'upload_dir' => FCPATH.'uploads/turfs/'.$id.'/gallery/', 
            'upload_url' => base_url('uploads/turfs/'.$id.'/gallery/'), 
            'script_url' => site_url('manager/upload/delete?type=turf_gallery&table=turf_images&id='.$id)
        ];

        $upload_handler = new UploadHandler($options);

        $file_data = [
            'turf_id' => $id,
            'name' => $upload_handler->get_response()['files'][0]->name,
            'original_name' => $_FILES['files']['name'][0],
            'size' => $_FILES['files']['size'][0]
        ];

        $this->Upload_model->insert_file('turf_images', $file_data);
	}

	public function delete()
	{
        $id = $this->input->get('id');
        $table = $this->input->get('table');
        $file = $this->input->get('file');
        $type = $this->input->get('type');

        switch ($type) {
            case 'turf_gallery':
                $options = [
                    'upload_dir' => FCPATH.'uploads/turfs/'.$id.'/gallery/', 
                    'upload_url' => base_url('uploads/turfs/'.$id.'/gallery/'), 
                    'script_url' => site_url('manager/upload/delete?type=turf_gallery&table=turf_images&id='.$id)
                ];
                $params = [
                    'turf_id' => $id,
                    'name' => $file
                ];
                break;
            
            default:break;
        }

        $upload_handler = new UploadHandler($options);

        $this->Upload_model->delete_file_by_params($table, $params);
	}

}