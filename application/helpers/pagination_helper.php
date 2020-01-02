<?php

function pagination($url, $rowscount, $per_page, $type = 'admin')
{
    $ci = & get_instance();
    $config = array();
    $config["base_url"] = $url;
    $config["total_rows"] = $rowscount;
    $config["per_page"] = $per_page;

    if($type == 'front')
        _get_front_config($config);
    else
        _get_admin_config($config);

    $ci->pagination->initialize($config);
    return $ci->pagination->create_links();
}

function _get_front_config(&$config)
{
    $config['full_tag_open'] = '<ul>';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li class="m-1">';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="m-1 active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['next_tag_open'] = '<li class="m-1">';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li class="m-1">';
    $config['prev_tag_close'] = '</li>';
    $config['first_link'] = '&lt;&lt;';
    $config['first_tag_open'] = '<li class="m-1">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = '&gt;&gt;';
    $config['last_tag_open'] = '<li class="m-1">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = '&gt;';
    $config['prev_link'] = '&lt;';
    $config['reuse_query_string'] = TRUE;
    $config['enable_query_strings'] = TRUE;
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 'page';
}

function _get_admin_config(&$config)
{
    $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="m-0 pagination pagination-separate pagination-curved">';
    $config['full_tag_close'] = '</ul></nav>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['first_link'] = '←&nbsp;&nbsp;&nbsp;First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['last_link'] = 'Last&nbsp;&nbsp;&nbsp;→';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['next_link'] = 'Next&nbsp;&nbsp;&nbsp;→';
    $config['prev_link'] = '←&nbsp;&nbsp;&nbsp;Previous';
    $config['reuse_query_string'] = TRUE;
    $config['enable_query_strings'] = TRUE;
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 'page';
    $config['attributes'] = array('class' => 'page-link');
}