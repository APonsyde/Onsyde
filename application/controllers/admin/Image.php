<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends AdminController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sort_model');
	}

	public function crop()
	{
		$relative_image = FCPATH.str_replace(site_url(), "", $this->input->get('image'));

		if(file_exists($relative_image))
		{
			$this->form_validation->set_rules('base64', 'Image', 'required');
			$this->form_validation->set_message('required', '%s is required');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

			if($this->form_validation->run())
			{
				$data = $this->input->post();
				$result = base64_to_image($data['base64'], $relative_image);

				if($result)
				{
					$this->session->set_flashdata('success_message', 'Image cropped successfully');
					redirect('image/crop?image='.$this->input->get('image'));
					exit;
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Some error occured while cropping the image');
					redirect('image/crop?image='.$this->input->get('image'));
					exit;
				}
			}
			else
			{
				$data['thumb'] = $this->input->get('image');
				$data['image'] = get_original_image_url($this->input->get('image'));
				$data['tab'] = 'tournaments';
				$data['title'] = 'Update Tournament Cashback';
				$data['_view'] = 'admin/image/crop';
				$this->load->view('admin/layout/basetemplate', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Image not found');
			redirect('dashboard');
			exit;
		}
	}

}