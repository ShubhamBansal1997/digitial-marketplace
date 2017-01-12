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
<?php $_SESSION['ts_error_img'] = ''; } elseif(isset($_SESSION['ts_error_file']) && $_SESSION['ts_error_file'] != '') { ?>
    <div class="ts_message_popup ts_popup_error">
      <p class="ts_message_popup_text"> <?php echo $_SESSION['ts_error_file'];?> </p>
    </div>
<?php $_SESSION['ts_error_file'] = ''; } elseif(isset($_SESSION['ts_success']) && $_SESSION['ts_success'] != '') { ?>
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
				<li><a href="<?php echo $basepath;?>backend">My Board</a></li>
				<li><a>Products</a>
				    <ul>
				        <li><a href="<?php echo $basepath;?>backend/categories">Categories</a></li>
				        <li><a href="<?php echo $basepath;?>backend/sub_categories">Sub Categories</a></li>
				        <li><a href="<?php echo $basepath;?>products/add_products_1">Add Products</a></li>
				        <li><a href="<?php echo $basepath;?>products/manage_products">Manage Products</a></li>
				    </ul>
				</li>
				<li><a>Users</a>
				    <ul>
				        <li><a href="<?php echo $basepath;?>backend/users">Users List</a></li>
				        <li><a data-toggle="modal" data-target="#addnewuser">Add User</a></li>
				    </ul>
				</li>
				<li><a>Vendor Manager</a>
				    <ul>
				        <li><a href="<?php echo $basepath;?>backend/vendor_management">T &amp; C</a></li>
				        <?php if($this->ts_functions->getsettings('marketplace','typevendor') == 'multi') { ?>
                            <li><a href="<?php echo $basepath;?>backend/vendor_list">List</a></li>
                        <?php } ?>

				    </ul>
				</li>
				<li><a>Email Section</a>
				    <ul>
				        <li><a href="<?php echo $basepath;?>backend/email_integrations">Integrations</a></li>
				        <li><a href="<?php echo $basepath;?>backend/email_list">List</a></li>
				        <li><a href="<?php echo $basepath;?>backend/email_templates">Templates</a></li>
				    </ul>
				</li>
				<li><a href="<?php echo $basepath;?>backend/testimonials">Testimonials</a></li>
				<li><a href="<?php echo $basepath;?>backend/compliance_pages">Pages</a></li>
				<li><a href="<?php echo $basepath;?>backend/portalrevenue">Plan Settings</a></li>
				<li><a>Transactions</a>
				    <ul>
				        <li><a href="<?php echo $basepath;?>backend/transaction_history">Payment Transactions</a></li>
				        <li><a href="<?php echo $basepath;?>backend/statements">Sales Statements</a></li>
				    </ul>
				</li>
				<li><a href="<?php echo $basepath;?>backend/social_login">Social Login</a></li>
				<li><a href="<?php echo $basepath;?>backend/discount_coupon">Discount Coupon</a></li>
				<li><a>Settings</a>
				    <ul>
				    	<li><a href="<?php echo $basepath;?>settings/account_access">Account Access Settings</a></li>
				        <li><a href="<?php echo $basepath;?>settings/payment">Payment Settings</a></li>
				        <li><a href="<?php echo $basepath;?>settings/texts">Text Settings</a></li>
				        <li><a href="<?php echo $basepath;?>settings/websites">Website Settings</a></li>
				        <li><a href="<?php echo $basepath;?>settings/menus">Menu Settings</a></li>
				    </ul>
				</li>
				<li><a>Appearance</a>
				    <ul>
				        <li><a href="<?php echo $basepath;?>backend/tp_themes">Themes</a></li>
				        <li><a href="<?php echo $basepath;?>backend/tp_headers">Header Menu</a></li>
				    </ul>
				</li>

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
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 login_section">
				<div class="th_user_login">
					<a href="<?php echo $basepath;?>" class="btn theme_btn orange_btn">preview site</a>
					<div class="user_login_detail">
						<h5 class="user_name"><a>Hi,<span><?php echo $this->session->userdata['ts_uname']; ?></span></a></h5>
						<div class="th_user_profile">
							<ul>
                                <li><a data-toggle="modal" data-target="#changepassword"><i class="fa fa-key" aria-hidden="true"></i>Password</a></li>
                                <li><a href="<?php echo $basepath;?>home/logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                            </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- top header section -->

	<!-- Modal -->
<div class="modal fade change_password theme_modal" id="changepassword" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
            <div class="col-lg-3 col-md-3">
                <label>Old Password</label>
            </div>
            <div class="col-lg-6 col-md-6">
                <input type="password" class="form-control pwd_validate" id="old_pwd"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-3">
                <label>New Password</label>
            </div>
            <div class="col-lg-6 col-md-6">
                <input type="password" class="form-control pwd_validate" id="new_pwd"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-3">
                <label>Confirm New Password</label>
            </div>
            <div class="col-lg-6 col-md-6">
                <input type="password" class="form-control pwd_validate" id="confirm_new_pwd"/>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" onclick="admin_change_password();" class="btn theme_btn">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Add user STARTS -->

<div class="modal fade change_password theme_modal" id="addnewuser" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New User</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
      
        <div class="form-group">
            <div class="col-lg-3 col-md-3">
                <label>User Name</label>
            </div>
            <div class="col-lg-6 col-md-6">
                <input type="text" class="form-control addnewuser username" id="u_uname"/>
            </div>
        </div>
      
        <div class="form-group">
            <div class="col-lg-3 col-md-3">
                <label>Email</label>
            </div>
            <div class="col-lg-6 col-md-6">
                <input type="text" class="form-control addnewuser email" id="u_email"/>
            </div>
        </div>
      
        <div class="form-group">
            <div class="col-lg-3 col-md-3">
                <label>Password</label>
            </div>
            <div class="col-lg-6 col-md-6">
                <input type="password" class="form-control addnewuser pwd" id="u_pwd"/>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-lg-3 col-md-3">
                <label>User Type</label>
            </div>
            <div class="col-lg-6 col-md-6">
                <select id="u_accesslevel" class="form-control addnewuser">
                	<option value="2">User</option>
                	<option value="3">Vendor</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
			<div class="col-lg-3 col-md-3">
				<label>Send details to user</label>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="th_checkbox">
					<input type="checkbox" id="sendemail" value="1">
					<label for="sendemail"></label>
				</div>
			</div>
		</div>

      </div>
      <div class="modal-footer">
        <a onclick="addnewuser();" class="btn theme_btn">Submit  <i class="fa fa-spinner fa-spin addnew_wait hideme" aria-hidden="true"></i></a>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Add user ENDS -->
