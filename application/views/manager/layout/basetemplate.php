<?php

$this->load->view('manager/layout/header');

if(isset($_view))
	$this->load->view($_view);

$this->load->view('manager/layout/footer');
