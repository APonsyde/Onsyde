<?php

$this->load->view('front/layout/header');

if(isset($_view))
	$this->load->view($_view);

$this->load->view('front/layout/footer');
