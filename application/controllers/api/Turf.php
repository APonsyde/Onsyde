<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turf extends ApiController 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Turf_model');
		$this->load->model('Email_model');
		$this->load->model('Booking_model');
	}

	public function listing_post()
	{
		if($this->authenticate_token())
        {
			$filters = [];
			$filters['manager_id'] = $this->manager['id'];

			$data['turfs'] = $this->Turf_model->get_all_turfs(null, null, $filters);

			$date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
			$timestamp = strtotime($date);
			$day = date('l', $timestamp);

			foreach ($data['turfs'] as $key => $turf)
			{

				if($turf['image'])
					$data['turfs'][$key]['image'] = base_url('uploads/turfs/'.$turf['id'].'/gallery/'.$turf['image']);

	        	$slots = $this->Turf_model->get_all_turf_slots($turf['id'], $day);
	        	$booked_slots = $this->Turf_model->get_all_turf_booked_slots($turf['id'], $day, $date);

				$data['turfs'][$key]['booked_slots'] = (count($slots)) ? ceil((count($booked_slots)/count($slots))*100) : 0;

				foreach ($slots as $skey => $slot)
				{ 
		        	$booked = 0;
					foreach ($booked_slots as $booked_slot)
					{ 
						if($booked_slot['id'] == $slot['id'])
						{
							$booked = 1;
							break;
						}
					}

					$slots[$skey]['booked'] = $booked;
				}

				$data['turfs'][$key]['slots'] = $slots;
			}

			$response = [
                'success' => true,
                'message' => '',
                'data' => $data
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
		}
	}

	public function create_post()
	{
		if($this->authenticate_token())
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
	        	$data['manager_id'] = $this->manager['id'];

	            $result = $this->Turf_model->add($data);

	            if($result)
	            {
	            	$intervals = time_intervals(0, 86400, 60 * 30, 'h:i a');
	            	$this->Turf_model->add_slots($result, $intervals);

	            	$response = [
	                    'success' => true,
	                    'message' => 'Turf has been created'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
	            }
	            else
	            {
	            	$response = [
	                    'success' => false,
	                    'message' => 'Some error occured while creating the turf'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
	            }
	        }
	        else
	        {
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function edit_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('turf_id', 'Turf', 'required|xss_clean');
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
	        	$turf = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

	        	if(!empty($turf) && $turf['manager_id'] = $this->manager['id'])
	        	{
		        	$data = $this->input->post();
		            $result = $this->Turf_model->update($id, $data);

		            if($result)
		            {
		            	$response = [
		                    'success' => true,
		                    'message' => 'Turf has been updated'
		                ];

		                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
		            }
		            else
		            {
		            	$response = [
		                    'success' => false,
		                    'message' => 'Some error occured while updating the turf'
		                ];

		                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
		            }
		        }
		        else
		        {
		        	$response = [
	                    'success' => false,
	                    'message' => 'Turf not found'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
		        }
	        }
	        else
	        {
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function view_post()
	{
		if($this->authenticate_token())
        {

			$this->form_validation->set_rules('turf_id', 'Turf', 'required|xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
				$data['turf'] = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

				if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
				{
					$data['turf']['images'] = $this->Turf_model->get_turf_images($this->input->post('turf_id'));

					if(!empty($data['turf']['images']))
					{
						foreach ($data['turf']['images'] as $key => $image)
						{
							$data['turf']['images'][$key]['name'] = base_url('uploads/turfs/'.$data['turf']['id'].'/gallery/'.$image['name']);
						}
					}

					$all_days = [];
					$days = get_days();

					foreach ($days as $key => $day)
					{
		        		$all_days[$day] = $this->Turf_model->get_all_turf_slots($data['turf']['id'], $day);
					}

					if(!empty($all_days))
					{
						foreach ($all_days as $key => $value)
						{
							$data['turf']['days'][] = [
								'day' => $key,
								'slots' => $value
							];
						}
					}

					$date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
					$timestamp = strtotime($date);
					$day = date('l', $timestamp);

					$slots = $this->Turf_model->get_all_turf_slots($data['turf']['id'], $day);
		        	$booked_slots = $this->Turf_model->get_all_turf_booked_slots($data['turf']['id'], $day, $date);

					foreach ($slots as $skey => $slot)
					{ 
			        	$booked = 0;
						foreach ($booked_slots as $booked_slot)
						{ 
							if($booked_slot['id'] == $slot['id'])
							{
								$booked = 1;
								break;
							}
						}

						$slots[$skey]['booked'] = $booked;
					}

					$data['turf']['slots'] = $slots;

					$response = [
		                'success' => true,
		                'message' => '',
		                'data' => $data
		            ];

		            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
				else
				{
					$response = [
	                    'success' => false,
	                    'message' => 'Turf not found'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
			}
	        else
	        {
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function gallery_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('turf_id', 'Turf', 'required|xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
				$data['turf'] = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

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
					$response = [
	                    'success' => false,
	                    'message' => 'Turf not found'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
			}
	        else
	        {
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function slots_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('turf_id', 'Turf', 'required|xss_clean');
			$this->form_validation->set_rules('slots', 'Slots', 'required|xss_clean');
			$this->form_validation->set_rules('day', 'Day', 'required|xss_clean');
			$this->form_validation->set_rules('amount', 'Amount', 'required|is_numeric|xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
				$data['turf'] = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

				if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
				{
					$post = $this->input->post();

					$slot_data = [];
					$slot_ids = explode(",", $post['slots']);

					foreach ($slot_ids as $key => $slot_id)
					{
						$slot_data[] = [
							'id' => $slot_id,
							'price' => $post['amount']
						];
					}

					$this->Turf_model->update_slots_batch($slot_data, 'id');

	        		$slots = $this->Turf_model->get_all_turf_slots($data['turf']['id'], $post['day']);

					$data = [];
					$data['slots'] = $slots;

					$response = [
		                'success' => true,
		                'message' => 'Slot prices updated successfully',
		                'data' => $data
		            ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
				else
				{
					$response = [
	                    'success' => false,
	                    'message' => 'Turf not found'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
			}
	        else
	        {
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function slot_messaging_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('turf_id', 'Turf', 'required|xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
	        	$data['turf'] = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

				if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
				{
		        	$date = ($this->input->post('date')) ? $this->input->post('date') : date('Y-m-d');
			        $timestamp = strtotime($date);
			        $day = date('l', $timestamp);

		            $booked_slots = $this->Turf_model->get_all_turf_booked_slots($data['turf']['id'], $day, $date);
		            $available_slots = $this->Turf_model->get_all_turf_slots($data['turf']['id'], $day);


		            foreach ($available_slots as $key => $slot)
		            {
		            	foreach ($booked_slots as $bkey => $booked_slot)
		            	{
		            		if($slot['id'] == $booked_slot['id'])
		            		{
		            			unset($data['turf']['available_slots'][$key]);
		            		}
		            	}
		            }

		            $time_slot = null;
	                $prev_slot = null;

	                if(!empty($available_slots))
	                {
	                	$available_slots = array_values($available_slots);

		                foreach ($available_slots as $key => $slot)
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

		                $last = end($available_slots);

		                if($last['price'])
	                    {
		                	$time_slot .=  " - " . date("h:i a", strtotime('+30 minutes', strtotime($last['time'])));
		                }
		            }

		            $message = "";
		            $message .= "Turf : ".$data['turf']['name']."\r\nAddress : ".$data['turf']['address']."\r\n\r\n";
		            $for = ($date == date('Y-m-d')) ? 'today' : $day.', '.date("jS M", $timestamp);
		            $message .= "Slots available for ".strtolower($for)." -\r\n".$time_slot;

		            $response = [
	                    'success' => true,
	                    'message' => '',
	                    'data' => [
	                    	'message' => $message
	                    ]
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
				else
				{
					$response = [
	                    'success' => false,
	                    'message' => 'Turf not found'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
			}
	        else
	        {
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}

	public function slot_messaging_notify_post()
	{
		if($this->authenticate_token())
        {
			$this->form_validation->set_rules('turf_id', 'Turf', 'required|xss_clean');
			$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');

	        $this->form_validation->set_message('required', '%s is required');
	        $this->form_validation->set_error_delimiters('<div class="text-danger text-left"><small>', '</small></div>');

	        if($this->form_validation->run())
	        {
	        	$data['turf'] = $this->Turf_model->get_turf_by_id($this->input->post('turf_id'));

				if(!empty($data['turf']) && $data['turf']['manager_id'] = $this->manager['id'])
				{
		        	$post = $this->input->post();
		        	$players = $this->Booking_model->get_all_booking_players(null, null, ['turf_id' => $data['turf']['id']]);

		        	if(!empty($players))
		        	{
		        		$users = [];

		        		foreach ($players as $player)
		        		{
		        			if(!empty($player['email']))
		        			{
			        			$users[] = [
			        				'name' => $player['full_name'],
			        				'email' => $player['email']
			        			];
			        		}
		        		}

		        		if(!empty($users))
		        		{
			                $subject = PROJECT_NAME.' - Turf Booking!';
			                $message = str_replace("\r\n", "<br>", $post['message']);

			                $this->Email_model->notify($users, $subject, $message);
			            }
		            }

		            $response = [
	                    'success' => true,
	                    'message' => 'Players have been notified'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
				else
				{
					$response = [
	                    'success' => false,
	                    'message' => 'Turf not found'
	                ];

	                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
				}
			}
	        else
	        {
				$this->return_form_errors($this->form_validation->error_array());
			}
		}
	}
}
