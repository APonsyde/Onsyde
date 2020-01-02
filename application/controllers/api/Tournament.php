<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @package         Sports
* @subpackage      API
* @category        Player
* @author          Yohhan Dalvi
*/
class Tournament extends ApiController 
{

    function __construct()
    {
// Construct the parent class
        parent::__construct();
        $this->load->model('Player_model');
        $this->load->model('Email_model');
        $this->load->model('Device_model');
        $this->load->model('Tournament_model');
        $this->load->model('Team_model');
        $this->load->model('Sport_model');
    }

    public function listing_get()
    {
        if($this->authenticate_token())
        {
            $data['tournaments'] = $this->Tournament_model->get_all_tournaments();

            $response = [
                'success' => true,
                'message' => '',
                'data' => $data
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }

    public function listing_individual_players_get()
    {
        if($this->authenticate_token())
        {
            $data['individual_players'] = $this->Team_model->get_all_individual_players();

            $response = [
                'success' => true,
                'message' => '',
                'data' => $data
            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }

    public function add_individual_players_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_id', 'Tournament ID', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');


            if($this->form_validation->run())
            {
                $data = $this->input->post();
                $result = $this->Team_model->add_individual_players($data);

                if($result)
                { 
                    $response = [
                        'success' => true,
                        'message' => 'Individual players added successfully'
                    ];
                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Some error occured while adding the player'
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

    public function add_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_name', 'Tournament Name', 'required|xss_clean');
            $this->form_validation->set_rules('sports_id', 'Sport', 'required|xss_clean');
            $this->form_validation->set_rules('ground_id', 'Ground', 'required|xss_clean');
            $this->form_validation->set_rules('total_team', 'Total Team', 'required|xss_clean');
            $this->form_validation->set_rules('person_per_team', 'Person per team', 'required|xss_clean');
            $this->form_validation->set_rules('valid_from_date', 'From Date', 'required');
            $this->form_validation->set_rules('valid_to_date', 'To Date', 'required');
            $this->form_validation->set_rules('detailing', 'Detailing', 'xss_clean');
            $this->form_validation->set_rules('rules', 'Detailing', 'xss_clean');
            $this->form_validation->set_rules('tournament_images', 'Image', 'xss_clean');


            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');


            if($this->form_validation->run())
            {
                $data = $this->input->post();
                $tournament_data['approved'] = 1;
                $result = $this->Tournament_model->add($data);
                if($result)
                { 
                    $response = [
                        'success' => true,
                        'message' => 'Tournament added successfully'

                    ];
                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Some error occured while adding the Tournament'
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
            $this->form_validation->set_rules('tournament_name', 'Tournament Name', 'required|xss_clean');
            $this->form_validation->set_rules('sports_id', 'Sport', 'required|xss_clean');
            $this->form_validation->set_rules('ground_id', 'Ground', 'required|xss_clean');
            $this->form_validation->set_rules('total_team', 'Total Team', 'required|xss_clean');
            $this->form_validation->set_rules('person_per_team', 'Person per team', 'required|xss_clean');
            $this->form_validation->set_rules('valid_from_date', 'From Date', 'required');
            $this->form_validation->set_rules('valid_to_date', 'To Date', 'required');
            $this->form_validation->set_rules('detailing', 'Detailing', 'xss_clean');
            $this->form_validation->set_rules('rules', 'Detailing', 'xss_clean');
            $this->form_validation->set_rules('tournament_images', 'Image', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $data = $this->input->post();
                unset($data['tournament_id']);
                $result = $this->Tournament_model->update($this->input->post('tournament_id'), $data);
                if($result)
                { 
                    $response = [
                        'success' => true,
                        'message' => 'Tournament updated successfully'

                    ];
                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $response = [
                        'success' => false,
                        'message' => 'Some error occured while updating the Tournament'
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
            $this->form_validation->set_rules('tournament_id', 'Tournament', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required.');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $result = $this->Tournament_model->get_tournament_by_id($this->input->post('tournament_id'));

                if($result)
                { 
                    $registered_slots = $this->Tournament_model->get_tournament_registered_slots($this->input->post('tournament_id'), $result['person_per_team']);
                    $max_slots = $result['total_team'] * $result['person_per_team'];

                    $result['team_registration'] = false;
                    $result['player_registration'] = false;

                    if(($max_slots - $registered_slots) > $result['person_per_team'])
                        $result['team_registration'] = true;

                    if($registered_slots < $max_slots)
                        $result['player_registration'] = true;

                    $response = [
                        'success' => true,
                        'message' => 'Tournament detailing',
                        'data' => [
                            'tournament' => $result
                        ]

                    ];
                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $data = [
                        'success' => false,
                        'message' => 'Tournament not found'

                    ];

                    $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }

            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function search_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_id', 'Tournament Id', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required.');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $data = $this->input->post();

                $result = $this->Tournament_model->get_all_tournaments($this->input->post('tournament_id'), $data);
                if($result)
                { 
                    $response = [
                        'success' => true,
                        'message' => 'Tournament detailing',
                        'data' => [
                            'tournament' => $result
                        ]

                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $data = [
                        'success' => false,
                        'message' => 'Tournament not found'

                    ];

                    $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }

            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function rules_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_id', 'Tournament Id', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required.');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $data = $this->input->post();

                $result = $this->Tournament_model->get_tournament_by_id($this->input->post('tournament_id'));

                if($result)
                { 
                    $all_rules = $this->Sport_model->get_all_sport_rules(['sport_id' => $result['sports_id']]);
                    $tournament_rules = $this->Tournament_model->get_tournament_rules($this->input->post('tournament_id'));
                    $rules = [];

                    foreach ($tournament_rules as $tournament_rule) {
                        $rule_str = "";
                        foreach ($all_rules as $rule) {
                            if($tournament_rule['sport_rule_id'] == $rule['id']) {
                                $values = @json_decode($tournament_rule['value']);
                                $rule_data = explode("{}", $rule['name']);
                                foreach ($rule_data as $key => $rd) {
                                    $rule_str .= $rd;
                                    if(!empty($values[$key]))
                                        $rule_str .= $values[$key];
                                }
                            }
                        }
                        $rules[] = [
                            'value' => $rule_str
                        ];
                    }

                    $response = [
                        'success' => true,
                        'message' => 'Tournament rules',
                        'data' => [
                            'rules' => $rules
                        ]

                    ];
                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $data = [
                        'success' => false,
                        'message' => 'Tournament not found'

                    ];

                    $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }

            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function create_team_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_id', 'Tournament Id', 'required|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
            $this->form_validation->set_rules('logo', 'Logo', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required.');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $data = $this->input->post();

                $tournament = $this->Tournament_model->get_tournament_by_id($this->input->post('tournament_id'));

                if($tournament)
                {
                    $registered_slots = $this->Tournament_model->get_tournament_registered_slots($this->input->post('tournament_id'), $tournament['person_per_team']);
                    $max_slots = $tournament['total_team'] * $tournament['person_per_team'];

                    if(($max_slots - $registered_slots) > $tournament['person_per_team'])
                    {
                        $team = $this->Team_model->add($data);

                        $response = [
                            'success' => true,
                            'message' => 'Team created successfully'

                        ];

                        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'message' => 'Team registrations have been closed'

                        ];

                        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                    }
                }
                else
                {
                    $data = [
                        'success' => false,
                        'message' => 'Tournament not found'

                    ];

                    $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function join_team_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_id', 'Tournament Id', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required.');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $data = $this->input->post();

                $tournament = $this->Tournament_model->get_tournament_by_id($this->input->post('tournament_id'));

                if($tournament)
                {
                    $registered_slots = $this->Tournament_model->get_tournament_registered_slots($this->input->post('tournament_id'), $tournament['person_per_team']);
                    $max_slots = $tournament['total_team'] * $tournament['person_per_team'];

                    if($registered_slots < $max_slots)
                    {
                        $data['player_id'] = $this->player['id'];
                        $team = $this->Team_model->add_individual_players($data);

                        $response = [
                            'success' => true,
                            'message' => 'Joined tournament successfully'

                        ];

                        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                    }
                    else
                    {
                        $response = [
                            'success' => false,
                            'message' => 'The individual registrations have been closed'

                        ];

                        $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
                    }
                }
                else
                {
                    $data = [
                        'success' => false,
                        'message' => 'Tournament not found'

                    ];

                    $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function logos_get()
    {
        if($this->authenticate_token())
        {
            $logos = [
                [
                    'id' => '1.png',
                    'image' => base_url('resources/front/images/logos/1.png')
                ],
                [
                    'id' => '2.png',
                    'image' => base_url('resources/front/images/logos/2.png')
                ]
            ];

            $response = [
                'success' => true,
                'message' => 'Logos',
                'data' => [
                    'logos' => $logos
                ]

            ];

            $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK);
        }
    }

    public function contacts_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_id', 'Tournament Id', 'required|xss_clean');
            $this->form_validation->set_rules('contact', 'Contacts', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required.');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $data = $this->input->post();

                $registered_contacts = [];
                $unregistered_contacts = [];

                $contacts = @json_decode($data['contact'], true);

                if(!empty($contacts))
                {
                    foreach ($contacts as $key => $contact)
                    {
                        $number = substr($contact['number'], -10);
                        $player = $this->Player_model->get_player_by_params(['mobile' => $number]);

                        if(!empty($player))
                            $registered_contacts[] = $contact;
                        else
                            $unregistered_contacts[] = $contact;
                    }
                }

                $response = [
                    'success' => true,
                    'message' => 'Contact listing',
                    'data' => [
                        'registered' => $registered_contacts,
                        'unregistered' => $unregistered_contacts
                    ]

                ];

                $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }

    public function invite_post()
    {
        if($this->authenticate_token())
        {
            $this->form_validation->set_rules('tournament_id', 'Tournament Id', 'required|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
            $this->form_validation->set_rules('number', 'Number', 'required|xss_clean');

            $this->form_validation->set_message('required', '%s is required.');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if($this->form_validation->run())
            {
                $data = $this->input->post();

                $tournament = $this->Tournament_model->get_tournament_by_id($this->input->post('tournament_id'));

                if($tournament)
                {
                    $mobile = substr($data['number'], -10);
                    $message = "You have been by invited by ".$this->player['full_name']." to join the ".$tournament['tournament_name']." tournament - Download the GoSports app!";
                    sms("+91".$mobile, $message);

                    $response = [
                        'success' => true,
                        'message' => 'Invite sent successfully'

                    ];

                    $this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $data = [
                        'success' => false,
                        'message' => 'Tournament not found'

                    ];

                    $this->response($data, \Restserver\Libraries\REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->return_form_errors($this->form_validation->error_array());
            }
        }
    }
}