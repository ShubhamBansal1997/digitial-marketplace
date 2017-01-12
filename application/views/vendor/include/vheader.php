<!DOCTYPE html>
<html lang="en">
  <!--
<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title><?php echo $this->ts_functions->getsettings('sitetitle','text');?></title>
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
<link href="<?php echo $basepath;?>adminassets/css/admin_main.css" rel="stylesheet" type="text/css"/>
<!-- end theme style -->
<!-- favicon links -->
<link rel="shortcut icon" type="image/png" href="<?php echo $this->ts_functions->getsettings('favicon','url');?>" />
</head>
<!-- Header End -->
<!-- Body Start -->
<body>
<!-- wrapper start -->
<!--Message Popup Start-->
<?php if(isset($_SESSION['ts_error_img']) && $_SESSION['ts_error_img'] != '') { ?>
    <div class="ts_message_popup ts_popup_error">
      <p class="ts_message_popup_text"> <?php echo $_SESSION['ts_error_img'];?> </p>
    </div>
<?php $_SESSION['ts_error_img'] = ''; } ?>
<?php if(isset($_SESSION['ts_error_file']) && $_SESSION['ts_error_file'] != '') { ?>
    <div class="ts_message_popup ts_popup_error">
      <p class="ts_message_popup_text"> <?php echo $_SESSION['ts_error_file'];?> </p>
    </div>
<?php $_SESSION['ts_error_file'] = ''; } ?>
<?php if(isset($_SESSION['ts_success']) && $_SESSION['ts_success'] != '') { ?>
    <div class="ts_message_popup ts_popup_success">
      <p class="ts_message_popup_text"> <?php echo $_SESSION['ts_success'];?> </p>
    </div>
<?php $_SESSION['ts_success'] = ''; } ?>
<div class="ts_message_popup">
  <p class="ts_message_popup_text">

  </p>
</div>
<!--Message Popup End-->
<!-- header section -->
<header class="th_header">
	<nav class="th_menu">
		<div class="menu_toggle"><span></span><span></span><span></span></div>
		<div class="th_menu_container">
			<ul>
				<li><a href="<?php echo $basepath;?>vendorboard"><?php echo $this->ts_functions->getlanguage('vendorboardmenu','vendorboard','solo');?></a></li>
				<li><a><?php echo $this->ts_functions->getlanguage('prodmenu','vendorboard','solo');?></a>
				    <ul>
				        <li><a href="<?php echo $basepath;?>vendorboard/add_products_1"><?php echo $this->ts_functions->getlanguage('addproductsmenu','vendorboard','solo');?></a></li>
				        <li><a href="<?php echo $basepath;?>vendorboard/manage_products"><?php echo $this->ts_functions->getlanguage('manageproductsmenu','vendorboard','solo');?></a></li>
				    </ul>
				</li>
				<li><a href="<?php echo $basepath;?>vendorboard/sales_history"><?php echo $this->ts_functions->getlanguage('saleshistorymenu','vendorboard','solo');?></a></li>
				<li><a href="<?php echo $basepath;?>vendorboard/withdrawal"><?php echo $this->ts_functions->getlanguage('paymentreceivedmenu','vendorboard','solo');?></a></li>
				<li><a href="<?php echo $basepath;?>vendorboard/wallet_statement"><?php echo $this->ts_functions->getlanguage('walletmenu','vendorboard','solo');?></a></li>
			</ul>
		</div>
	</nav>
</header>
<!-- header section -->
<!-- content section start -->
<div class="th_main_wrapper">

    <!-- top header section -->
	<div class="th_top_header">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-3 logo_section">
				<a href="<?php echo $basepath;?>" class="logo_wrapper">
					<img src="<?php echo $this->ts_functions->getsettings('logo','url');?>" alt="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>" title="<?php echo $this->ts_functions->getsettings('sitetitle','text');?>"  >
				</a>
				</div>
				<?php
				    $currentWallet = $this->DatabaseModel->access_database('ts_wallet','select','',array('wallet_uid'=>$this->session->userdata['ts_uid']));
				?>
				<div class="col-lg-4 col-md-4 col-sm-5 wallet_section">
					<div class="th_wallet_section" style="color:white;">
						<span><a href="<?php echo $basepath;?>vendorboard/wallet_statement" style="color:white;"> <?php echo $this->ts_functions->getlanguage('wallettop','vendorboard','solo');?> : <b><?php echo $this->ts_functions->getsettings('portal','curreny').' ';?><?php echo empty($currentWallet) ? '0' : $currentWallet[0]['wallet_amount'];?></b> </a> </span>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 login_section">
				<div class="th_user_login">
					<div class="user_login_detail">
						<h5 class="user_name"><a href="<?php echo $basepath;?>dashboard"><?php echo $this->ts_functions->getlanguage('hi','vendorboard','solo');?>,<span><?php echo $this->session->userdata['ts_uname']; ?></span></a></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $vendorpage = 1;?>
	<!-- top header section -->
<input type="hidden" id="vendorpage" value="1">
