<?php

function pr($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function lq()
{
    $ci =& get_instance();
    echo $ci->db->last_query();
    exit;
}

function convert_db_time($datetime, $format = "d/m/Y")
{
    return date($format, strtotime($datetime));
}

function otp()
{
    $otp = random_string('numeric', 6);
    if(substr($otp, 0, 1) == 0)
        $otp = rand(1, 9).substr($otp, 1);
    return $otp;
}

function check_field($value, $data)
{
    $ci =& get_instance();
    $params = explode(",", $data);

    if(!empty($params[2]))
    {
        $filters = explode("&", $params[2]);

        if(!empty($filters))
        {
            foreach ($filters as $key => $filter)
            {
                $f = explode("|", $filter);
                $ci->db->where($f[0], $f[1]);
            }
        }
    }

    $ci->db->where($params[1], $value);
    $row = $ci->db->get($params[0])->row_array();

    if(empty($row))
    {
        return TRUE;
    }
    else
    {
        $ci->form_validation->set_message('check_field', '%s is already used');
        return FALSE;
    }
}

function show_image($image, $params = null)
{
    if(isset($params['thumbnail']))
    {
        $image_data = explode(".", $image);
        $extension = end($image_data);
        $folders = explode("/", $image);
        $url = str_replace(end($folders), "", $image)."thumb/".str_replace(".".$extension, "", end($folders))."_".$params['thumbnail'].".".$extension;
    }
    else
    {
        $url = $image;
    }

    return $url;
}

function get_original_image_url($image)
{
    $image_data = explode(".", $image);
    $extension = end($image_data);
    $image = preg_replace( '/_[^_]*$/', '', $image);
    $image = preg_replace( '/_[^_]*$/', '', $image);
    $image = $image.".".$extension;
    $image_data = explode("/", $image);
    $allowed_data = array_diff($image_data, ['thumb']);
    return implode("/", $allowed_data);
}

function base64_to_image($base64_string, $output_file)
{
    $ifp = fopen($output_file, 'wb'); 
    $data = explode(',', $base64_string);
    fwrite($ifp, base64_decode($data[1]));
    fclose($ifp); 
    return $output_file; 
}

function get_allowed_formats($type)
{
    $allowed_types = [
        'image' => ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png']
    ];

    return isset($allowed_types[$type]) ? $allowed_types[$type] : [];
}

function show_price($amount)
{
    return number_format($amount, 2);
}

function sms($mobile, $message)
{
    $postData = array(
        'authkey' => MSG91_AUTH_KEY,
        'mobiles' => $mobile,
        'message' => urlencode($message),
        'sender' => MSG91_SENDER_ID,
        'route' => "4"
    );

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_FOLLOWLOCATION => true
    ));

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
}

function format_size_units($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function get_days()
{
    $days = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];

    return $days;
}

function get_play_in()
{
    $values = [
        'one_area' => 'One area',
        'two_three_areas' => 'Two to three areas',
        'anywhere' => 'I\'m okay traveling anywhere for a game'
    ];

    return $values;
}

function get_play_in_by_value($value)
{
    $values = get_play_in();
    return isset($values[$value]) ? $values[$value] : '-';
}

function get_prefer_to_play()
{
    $values = [
        'cricket' => 'Cricket',
        'football' => 'Football',
        'all' => 'Available for both'
    ];

    return $values;
}

function get_prefer_to_play_by_value($value)
{
    $values = get_prefer_to_play();
    return isset($values[$value]) ? $values[$value] : '-';
}

function get_prefer_to_play_good_as()
{
    $values = [
        'batsman' => 'Batsman',
        'bowler' => 'Bowler',
        'all_rounder' => 'All-rounder',
        'goalkeeper' => 'Goalkeeper',
        'defender' => 'Defender',
        'midfielder' => 'Midfielder',
        'striker' => 'Striker',
        'any' => 'Any preference, I just love to play!'
    ];

    return $values;
}

function get_prefer_to_play_good_as_by_value($value)
{
    $values = get_prefer_to_play_good_as();
    return isset($values[$value]) ? $values[$value] : '-';
}

function get_notified_for_games()
{
    $values = [
        'mornings' => 'Mornings',
        'evenings' => 'Evenings',
        'late_nights' => 'Late nights',
        'anytime' => 'Anytime, I am always ready for a game'
    ];

    return $values;
}

function get_notified_for_games_by_value($value)
{
    $values = get_notified_for_games();
    return isset($values[$value]) ? $values[$value] : '-';
}

function get_upcoming_days()
{
    $days = [];

    $m = date("m");
    $de = date("d");
    $y = date("Y");

    for($i = 0; $i <= 6; $i++)
    {
        $days[date('Y-m-d', mktime(0,0,0, $m, ($de+$i), $y))] = date('D, jS M', mktime(0,0,0, $m, ($de+$i), $y)); 
    }

    return $days;
}

function time_intervals($lower = 0, $upper = 86400, $step = 3600, $format = '')
{
    $times = array();

    if(empty($format)) {
        $format = 'g:i a';
    }

    foreach(range($lower, $upper, $step) as $increment) {
        $increment = gmdate('H:i', $increment);
        list($hour, $minutes) = explode(':', $increment);
        $date = new DateTime($hour . ':' . $minutes);
        $times[(string) $increment] = $date->format($format);
    }

    return $times;
}

function trim_text($text, $length = 250)
{
    return mb_strimwidth($text, 0, $length, "...");
}