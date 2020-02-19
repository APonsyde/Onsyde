<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Blog_model');
        $this->load->model('Podcast_model');
    }

    public function blogs()
    {
        $this->authenticate();

        $filters = $this->input->get();

        $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['blogs'] = $this->Blog_model->get_all_blogs(null, null, $filters);
		$data['count'] = $this->Blog_model->count_all_blogs($filters);
		$data['pagination'] = pagination(site_url('admin/content/blogs'), $data['count'], ROWS_PER_LISTING);

        $data['tab'] = 'blogs';
        $data['title'] = 'List all blogs';
        $data['_view'] = 'admin/content/blogs';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function podcasts()
    {
        $this->authenticate();

        $filters = $this->input->get();

        $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['podcasts'] = $this->Podcast_model->get_all_podcasts(null, null, $filters);
		$data['count'] = $this->Podcast_model->count_all_podcasts($filters);
		$data['pagination'] = pagination(site_url('admin/content/podcasts'), $data['count'], ROWS_PER_LISTING);

        $data['tab'] = 'podcasts';
        $data['title'] = 'List all podcasts';
        $data['_view'] = 'admin/content/podcasts';
        $this->load->view('front/layout/basetemplate', $data);
    }

    public function add($type = null)
    {
        $this->authenticate();

        if(!in_array($type, ['blog', 'podcast']))
        {
            redirect('admin/dashboard');
            exit;
        }

        $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
        $this->form_validation->set_rules('image', 'Image', 'callback_file_check[["image", "image"]]');

        if($type == 'blog')
        	$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
    	else
        	$this->form_validation->set_rules('url', 'URL', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if($this->form_validation->run())
        {
            $upload = $this->upload($type.'s');

            if($upload['success'])
            {
                $data = $this->input->post();
                $data['image'] = $upload['data']['file_name'];

	        	if($type == 'blog')
	                $result = $this->Blog_model->add($data);
	            else
	                $result = $this->Podcast_model->add($data);

                if($result)
                {
                    $this->session->set_flashdata('success_message', ucfirst($type).' added successfully');
                    redirect('admin/content/'.$type.'s');
                    exit;
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'Some error occured while adding the '.$type);
                    redirect('admin/content/'.$type.'s');
                    exit;
                }
            }
            else
            {
                $this->session->set_flashdata('error_message', $upload['message']);
                redirect('admin/content/'.$type.'s');
                exit;
            }
        }
        else
        {
            $data['tab'] = $type.'s';
	        $data['title'] = 'Add new '.$type;
	        $data['_view'] = 'admin/content/add';
	        $this->load->view('front/layout/basetemplate', $data);
        }
    }

    public function edit($type = null, $id = 0)
    {
        $this->authenticate();

        if(!in_array($type, ['blog', 'podcast']))
        {
            redirect('admin/dashboard');
            exit;
        }

        if($type == 'blog')
        {
        	$data['blog'] = $this->Blog_model->get_blog_by_id($id);

	        if(empty($data['blog']))
	        {
	            $this->session->set_flashdata('error_message', 'Blog not found');
	            redirect('admin/content/blogs');
	            exit;
	        }
        }
        else
        {
        	$data['podcast'] = $this->Podcast_model->get_podcast_by_id($id);

	        if(empty($data['podcast']))
	        {
	            $this->session->set_flashdata('error_message', 'Podcast not found');
	            redirect('admin/content/podcasts');
	            exit;
	        }
        }

        $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
        $this->form_validation->set_rules('image', 'Image', 'callback_file_check[["image", "image", false]]');

        if($type == 'blog')
        	$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
    	else
        	$this->form_validation->set_rules('url', 'URL', 'required|xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if($this->form_validation->run())
        {
            $data = $this->input->post();

            $upload = $this->upload($type.'s');

            if($upload['success'])
            {
                $data['image'] = $upload['data']['file_name'];
            }

        	if($type == 'blog')
                $result = $this->Blog_model->update($id, $data);
            else
                $result = $this->Podcast_model->update($id, $data);

            if($result)
            {
                $this->session->set_flashdata('success_message', ucfirst($type).' updated successfully');
                redirect('admin/content/'.$type.'s');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while updating the '.$type);
                redirect('admin/content/'.$type.'s');
                exit;
            }
        }
        else
        {
            $data['tab'] = $type.'s';
	        $data['title'] = 'Edit '.$type;
	        $data['_view'] = 'admin/content/edit';
	        $this->load->view('front/layout/basetemplate', $data);
        }
    }

    private function upload($folder)
    {
        $config['upload_path']          = FCPATH.'uploads/'.$folder.'/images/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['encrypt_name']         = TRUE;
        $config['file_ext_tolower']     = TRUE;

        if(!is_dir($config['upload_path']))
        {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('image'))
        {
            $response = [
                'success' => FALSE,
                'message' => $this->upload->display_errors()
            ];
        }
        else
        {
            $data = $this->upload->data();

            $response = [
                'success' => TRUE,
                'message' => 'Uploaded successfully',
                'data' => [
                    'file_name' => $data['file_name']
                ]
            ];
        }

        return $response;
    }

    public function file_check($post, $params)
    {
        $data = json_decode($params);

        if(isset($data[2]) && $data[2] == false)
        {
            return TRUE;
        }

        $allowed_mime_type_arr = get_allowed_formats($data[1]);
        $mime = get_mime_by_extension($_FILES[$data[0]]['name']);

        if(isset($_FILES[$data[0]]['name']) && $_FILES[$data[0]]['name']!= "")
        {
            if(in_array($mime, $allowed_mime_type_arr))
            {
                return true;
            }
            else
            {
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file');
                return false;
            }
        }
        else
        {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload');
            return false;
        }
    }
}