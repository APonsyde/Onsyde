<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="TLB Media Pvt Ltd">
<meta name="description" content="Sport brands, reviews and recommendations for the Indian fan">
<meta name="keywords" content="onsyde, sport, review, reviews, sports, brand">
<link rel="shortcut icon" href="<?php echo base_url('resources/theme/images/favicon.ico'); ?>">
<title>
    <?php
      if (isset($title) && $title == 'Home') {
          echo 'Your Teammate for Sports Reviews';
      } else {
          echo PROJECT_NAME . isset($title) ? " / " . $title : "";
      }
    ?>
</title>
<link rel="stylesheet" href="<?php echo base_url('resources/theme/css/bootstrap.min.css'); ?>">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
<link href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('resources/theme/css/themify-icons.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('resources/theme/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('resources/theme/plugins/jquery-file-upload/css/jquery.fileupload.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('resources/theme/plugins/jquery-file-upload/css/jquery.fileupload-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('resources/theme/plugins/daterangepicker/daterangepicker.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/theme/plugins/jquery-confirm/jquery-confirm.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/theme/plugins/swiper/swiper.min.css'); ?>" />
<link href="<?php echo base_url('resources/theme/css/set1.css'); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('resources/theme/css/style.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('resources/theme/css/custom.css'); ?>">
<script src="<?php echo base_url('resources/theme/js/jquery-3.2.1.min.js'); ?>"></script>
<script>
	var SITE_URL = "<?php echo site_url(); ?>";
</script>