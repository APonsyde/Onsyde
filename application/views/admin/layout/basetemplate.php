<?php

$this->load->view('admin/layout/header');

if(isset($_view))
	$this->load->view($_view);

$this->load->view('admin/layout/footer');
