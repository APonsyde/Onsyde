<?php

class Upload_model extends CI_Model {

	public function thumbnail($source, $target, $width = 500, $height = 500)
	{
		$config = [
			'image_library' => 'gd2',
			'source_image' => $source,
			'new_image' => $target,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '_'.$width.'_'.$height,
			'width' => $width,
			'height' => $height
		];

		$this->load->library('image_lib', $config);

		if(!$this->image_lib->resize())
		{
			$response = [
        		'success' => FALSE,
        		'message' => $this->upload->display_errors()
        	];
		}
		else
		{
			$response = [
        		'success' => TRUE,
        		'message' => 'Thumbnail created successfully'
        	];
		}

		$this->image_lib->clear();
		return $response;
	}

	public function insert_file($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	public function insert_multiple_files($table, $data)
	{
		return $this->db->insert_batch($table, $data);
	}

	public function get_file($table, $id)
	{
		$this->db->where('id', $id);
		return $this->db->get_where($table)->row_array();
	}

	public function delete_file($table, $id, $folder)
	{
		$file = $this->get_file($table, $id);

		if(!empty($file))
		{
			@unlink(FCPATH . $folder . "/" . $file['image']);

			$file_data = explode(".", $file['image']);
			$files = preg_grep('~^'.$file_data[0].'~', scandir(FCPATH . $folder . "/thumb/"));

			if(!empty($files))
			{
				foreach ($files as $f)
				{
					@unlink(FCPATH . $folder . "/thumb/" . $f);
				}
			}
		}

		$this->db->where('id', $id);
		return $this->db->delete($table);
	}
}