<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turf extends ManagerController 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Turf_model');
		$this->load->model('Email_model');
		$this->load->model('Booking_model');
	}

	public function listing()
	{
		$this->authenticate(current_url());

		$filters = $this->input->get();
		$filters['manager_id'] = $this->manager['id'];

		$offset = ($this->input->get('page')) ? $this->input->get('page') : 0;
		$data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);
		$data['count'] = $this->Turf_model->count_all_turfs($filters);
		$data['total'] = $this->Turf_model->count_all_turfs();
		$data['inactive'] = $this->Turf_model->count_all_turfs(['inactive' => 1]);
		$data['pagination'] = pagination(site_url('manager/turf/listing'), $data['count'], ROWS_PER_LISTING);

		$date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
		$timestamp = strtotime($date);
		$day = date('l', $timestamp);

		foreach ($data['turfs'] as $key => $turf)
		{
        	$data['turfs'][$key]['slots'] = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
        	$data['turfs'][$key]['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);
		}

		$data['tab'] = 'turfs';
		$data['subtab'] = 'list';
		$data['title'] = 'Turf Listing';
		$data['_view'] = 'manager/turf/listing';
		$this->load->view('manager/layout/basetemplate', $data);
	}

	public function create()
	{
		$this->authenticate(current_url());

		$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
		$this->form_validation->set_rules('latitude', 'Latitude', 'xss_clean');
		$this->form_validation->set_rules('longitude', 'Longitude', 'xss_clean');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
		$this->form_validation->set_rules('alternate_number', 'Alternate number', 'xss_clean');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

        if($this->form_validation->run())
        {
        	$data = $this->input->post();
        	$data['manager_id'] = $this->manager['id'];

            $result = $this->Turf_model->add($data);

            if($result)
            {
            	$intervals = time_intervals(0, 86400, 60 * 30, 'h:i a');
            	$this->Turf_model->add_slots($result, $intervals);

                $this->session->set_flashdata('success_message', 'Turf has been created');
                redirect('manager/turf/listing');
                exit;
            }
            else
            {
                $this->session->set_flashdata('error_message', 'Some error occured while creating the turf');
                redirect('manager/turf/create');
                exit;
            }
        }
        else
        {
			$data['tab'] = 'turfs';
			$data['subtab'] = 'create';
			$data['title'] = 'Create Turf';
			$data['_view'] = 'manager/turf/create';
			$this->load->view('manager/layout/basetemplate', $data);
		}
	}

	public function edit($id = 0)
	{
		$this->authenticate(current_url());

		$data['turf'] = $this->Turf_model->get_turf_by_id($id);

		if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
		{
			$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
			$this->form_validation->set_rules('latitude', 'Latitude', 'xss_clean');
			$this->form_validation->set_rules('longitude', 'Longitude', 'xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
			$this->form_validation->set_rules('alternate_number', 'Alternate number', 'xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
	        	$data = $this->input->post();
	            $result = $this->Turf_model->update($id, $data);

	            if($result)
	            {
	                $this->session->set_flashdata('success_message', 'Turf has been updated');
	                redirect('manager/turf/listing');
	                exit;
	            }
	            else
	            {
	                $this->session->set_flashdata('error_message', 'Some error occured while updating the turf');
	                redirect('manager/turf/edit/'.$id);
	                exit;
	            }
	        }
	        else
	        {
				$data['tab'] = 'turfs';
				$data['subtab'] = 'list';
				$data['title'] = 'Create Turf';
				$data['_view'] = 'manager/turf/edit';
				$this->load->view('manager/layout/basetemplate', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Turf not found');
            redirect('manager/turf/listing');
            exit;
		}
	}

	public function gallery($id = 0)
	{
		$this->authenticate(current_url());

		$data['turf'] = $this->Turf_model->get_turf_by_id($id);

		if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
		{
			$data['images'] = $this->Turf_model->get_turf_images($id);

			$data['tab'] = 'turfs';
			$data['subtab'] = 'list';
			$data['title'] = 'Upload Turf Images';
			$data['_view'] = 'manager/turf/gallery';
			$this->load->view('manager/layout/basetemplate', $data);
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Turf not found');
            redirect('manager/turf/listing');
            exit;
		}
	}

	public function slots($id = 0)
	{
		$this->authenticate(current_url());

		$data['turf'] = $this->Turf_model->get_turf_by_id($id);

		if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
		{
			$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'required|xss_clean');
			$this->form_validation->set_rules('latitude', 'Latitude', 'required|xss_clean');
			$this->form_validation->set_rules('longitude', 'Longitude', 'required|xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
			$this->form_validation->set_rules('alternate_number', 'Alternate number', 'xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
	        	$data = $this->input->post();
	            $result = $this->Turf_model->update($id, $data);

	            if($result)
	            {
	                $this->session->set_flashdata('success_message', 'Turf has been updated');
	                redirect('manager/turf/listing');
	                exit;
	            }
	            else
	            {
	                $this->session->set_flashdata('error_message', 'Some error occured while updating the turf');
	                redirect('manager/turf/edit/'.$id);
	                exit;
	            }
	        }
	        else
	        {
				$days = get_days();

				foreach ($days as $key => $day)
				{
	        		$data['days'][$day]['slots'] = $this->Turf_model->get_all_turf_slots($id, $day);
				}

				$data['tab'] = 'turfs';
				$data['subtab'] = 'list';
				$data['title'] = 'Manage Turf Slots';
				$data['_view'] = 'manager/turf/slots';
				$this->load->view('manager/layout/basetemplate', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Turf not found');
            redirect('manager/turf/listing');
            exit;
		}
	}

	public function slot_manage()
	{
		$this->authenticate(current_url());

		$post = $this->input->post();

		$data['turf'] = $this->Turf_model->get_turf_by_id($post['turf_id']);

		if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
		{
			$slot_data = [];
			$slot_ids = explode(",", $post['slot_ids']);

			foreach ($slot_ids as $key => $slot_id)
			{
				$slot_data[] = [
					'id' => $slot_id,
					'price' => $post['amount']
				];
			}

			$this->Turf_model->update_slots_batch($slot_data, 'id');

			$data['slots'] = $this->Turf_model->get_all_turf_slots($post['turf_id'], $post['day']);

			$html = $this->load->view('manager/turf/_slot', ['data' => $data, 'day' => $post['day']], true);
			echo $html;
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Turf not found');
            redirect('manager/turf/listing');
            exit;
		}
	}

	public function messaging($id = 0)
	{
		$this->authenticate(current_url());

		$data['turf'] = $this->Turf_model->get_turf_by_id($id);

		if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
		{
			$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
	        	$data = $this->input->post();
	        	$players = $this->Booking_model->get_all_booking_players(null, null, ['turf_id' => $id]);

	        	if(!empty($players))
	        	{
	        		$users = [];

	        		foreach ($players as $player)
	        		{
	        			$users[] = [
	        				'name' => $player['full_name'],
	        				'email' => $player['email']
	        			];
	        		}

	                $subject = PROJECT_NAME.' - Turf Booking!';
	                $message = str_replace("\r\n", "<br>", $data['message']);

	                $this->Email_model->notify($users, $subject, $message);
	            }

                $this->session->set_flashdata('success_message', 'Players have been notified');
                redirect('manager/turf/messaging/'.$id);
                exit;
	        }
	        else
	        {
				$date = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d');
		        $timestamp = strtotime($date);
		        $day = date('l', $timestamp);

	            $data['turf']['slots'] = $this->Turf_model->get_all_turf_slots($id, $day);
	            $data['turf']['booked_slots'] = $this->Turf_model->get_all_turf_booked_slots($id, $day, $date);
	            $data['turf']['available_slots'] = $this->Turf_model->get_all_turf_slots($id, $day);


	            foreach ($data['turf']['available_slots'] as $key => $slot)
	            {
	            	foreach ($data['turf']['booked_slots'] as $bkey => $booked_slot)
	            	{
	            		if($slot['id'] == $booked_slot['id'])
	            		{
	            			unset($data['turf']['available_slots'][$key]);
	            		}
	            	}
	            }

	            $time_slot = null;
                $prev_slot = null;

                if(!empty($data['turf']['available_slots']))
                {
                	$data['turf']['available_slots'] = array_values($data['turf']['available_slots']);

	                foreach ($data['turf']['available_slots'] as $key => $slot)
	                {
	                    if($key == 0 && $slot['price'])
	                    {
	                        $time_slot .= $slot['time'];
	                    }
	                    else
	                    {
	                    	$prev_slot_end_price = $prev_slot['price'];
	                        $prev_slot_end_time = date("h:i a", strtotime('+30 minutes', strtotime($prev_slot['time'])));

	                        if(($prev_slot_end_time !== $slot['time'] || $prev_slot_end_price !== $slot['price']) && $prev_slot_end_price)
	                        {
	                            $time_slot .= " to ". $prev_slot_end_time . " - Rs " . $prev_slot_end_price . " /-\r\n";
	                        }

	                        if(($prev_slot_end_time !== $slot['time'] || $prev_slot_end_price !== $slot['price']) && $slot['price'])
                            {
                            	$time_slot .= $slot['time'];
                            }
	                    }

	                    $prev_slot = $slot;
	                }

	                $last = end($data['turf']['available_slots']);

	                if($last['price'])
                    {
	                	$time_slot .=  " to " . date("h:i a", strtotime('+30 minutes', strtotime($last['time']))) . " - Rs " . $last['price'] . " /-";
	                }
	            }

	            $message = "";
	            $message .= "Turf : ".$data['turf']['name']."\r\nAddress : ".$data['turf']['address']."\r\n\r\n";
	            $for = ($date == date('Y-m-d')) ? 'today' : $day.', '.date("jS M", $timestamp);
	            $message .= "Slots available for ".strtolower($for)." -\r\n".$time_slot;

	            $data['message'] = $message;

				$data['tab'] = 'turfs';
				$data['subtab'] = 'list';
				$data['title'] = 'Manage Turf Slots Messaging';
				$data['_view'] = 'manager/turf/messaging';
				$this->load->view('manager/layout/basetemplate', $data);
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Turf not found');
            redirect('manager/turf/listing');
            exit;
		}
	}
}
