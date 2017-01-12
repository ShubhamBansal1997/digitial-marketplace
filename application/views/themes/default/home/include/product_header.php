<!DOCTYPE html>
<html lang="en">
<!-- Header Start -->
<head>
<meta charset="utf-8" />
<title><?php echo $productdetails[0]['prod_name'];?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />

<meta content="<?php echo $productdetails[0]['prod_name'];?>" property="og:title">

<meta content="website" property="og:type">

<meta content="<?php echo $basepath;?>item/<?php echo $productName.$productdetails[0]['prod_uniqid'];?>" property="og:url">
<meta content="<?php echo $basepath;?>repo/images/<?php echo $productdetails[0]['prod_image'];?>" property="og:image">
<meta content="<?php echo substr(strip_tags($productdetails[0]['prod_description']),0,150).' ...';?>" property="og:description">

<meta content="<?php echo $productdetails[0]['prod_name'];?>" property="og:site_name">

<meta name="description"  content="<?php echo substr(strip_tags($productdetails[0]['prod_description']),0,150).' ...';?>"/>
<meta name="keywords" content="<?php echo $productdetails[0]['prod_tags'];?>">
<meta name="author" content="<?php echo $this->ts_functions->getsettings('siteauthor','text');?>"/>
<meta name="MobileOptimized" content="320">

<!-- Main css -->
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/fonts.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/bootstrap.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/font-awesome.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/animate.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/owl.carousel.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/sceen_popup.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/color.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/style.css" media="screen"/>
<link rel="stylesheet" href="<?php echo $basepath;?>themes/default/css/responsive.css" media="screen"/>

<!-- favicon links -->
<link rel="shortcut icon" type="image/png" href="<?php echo $this->ts_functions->getsettings('favicon','url');?>" />
</head>
