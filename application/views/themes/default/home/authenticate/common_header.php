<!DOCTYPE html>
<html lang="en">
<!-- Header Start -->
<head>
<meta charset="utf-8" />
<title><?php echo $this->ts_functions->getlanguage($name_of_page,'title','solo'); ?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />

<meta content="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" property="og:title">

<meta content="website" property="og:type">

<meta content="<?php echo $basepath;?>" property="og:url">
<meta content="<?php echo $this->ts_functions->getsettings('logo','url');?>" property="og:image">
<meta content="<?php echo $this->ts_functions->getsettings('seodescr','text');?>" property="og:description">

<meta content="<?php echo $this->ts_functions->getsettings('sitename','text');?>" property="og:site_name">

<meta name="description"  content="<?php echo $this->ts_functions->getsettings('seodescr','text');?>"/>
<meta name="keywords" content="<?php echo $this->ts_functions->getsettings('metatags','text');?>">
<meta name="author" content="<?php echo $this->ts_functions->getsettings('siteauthor','text');?>"/>
<meta name="MobileOptimized" content="320">
<!--srart theme style -->
<!-- favicon links -->
<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
<link rel="icon" type="image/ico" href="favicon.ico" />
<!-- Main css -->
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/fonts.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/bootstrap.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/font-awesome.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/animate.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/color.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/style.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/responsive.css" media="screen"/>
<!-- end theme style -->
<!-- favicon links -->
<link rel="shortcut icon" type="image/png" href="<?php echo $this->ts_functions->getsettings('favicon','url');?>" />
</head>

<!-- Header End -->
<body>

<!--Preloader Start-->
<div id="preloader">
  <div id="status">
  	<img src="<?php echo $this->ts_functions->getsettings('preloader','url');?>" alt="loading" />
  </div>
</div>
<!--Preloader End-->

<!--Message Popup Start-->
<?php if(isset($this->session->userdata['ts_loginstatus'])) { ?>
<div class="ts_message_popup ts_popup_error">
  <p class="ts_message_popup_text">
  <?php echo $this->session->userdata['ts_loginstatus'] == 'Inactive' ? $this->ts_functions->getlanguage('activateerror','message','solo') : $this->ts_functions->getlanguage('blockederror','message','solo') ; ?>
  </p>
</div>
<?php } else { ?>
<div class="ts_message_popup">
  <p class="ts_message_popup_text">

  </p>
</div>
<?php } ?>
<!--Message Popup End-->


<!-- Login Section Start -->
<div class="ts_login_page ts_toppadder100">
	<div class="ts_bg_overlay"></div>
	<div class="container">
		<div class="row">

			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="ts_login_form">
					<div class="ts_login_form_logo ts_toppadder10 ts_bottompadder30">
						<a href="<?php echo $basepath;?>"><img src="<?php echo $this->ts_functions->getsettings('logo','url');?>"  class="img-responsive" alt="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" title="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>"> </a>
					</div>
