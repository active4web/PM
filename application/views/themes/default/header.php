<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">
        <title><?=config_item('site_title')?><?=(isset($page_title))?' | '.$page_title:'';?></title>
        <meta name="description" content="<?=(isset($page_description) && $page_description!='' )?$page_description:config_item('site_description');?>" />
        <meta name="keywords" content="<?=(isset($page_keywords) && $page_keywords!='' )?$page_keywords:config_item('site_keywords');?>" />
        <meta name="robots" content="all, index, follow"/>
		<meta name="googlebot" content="all, index, follow" />
        <meta property="og:title" content="<?if(isset($og_title) && $og_title !=''){echo $og_title;}elseif(isset($page_title) && $page_title !=''){ echo $page_title;}else{echo config_item('site_title');}?>"/>
        <meta property="og:description" content="<?=(isset($page_description) && $page_description!='' )?$page_description:config_item('site_description');?>"/>
		<meta property="og:site_name" content="<?=config_item('site_name')?>"/>
		<meta property="og:type" content="websites"/>
		<meta property="og:image" content="<?php if(isset($og_image) && $og_image!=''){echo $og_image;}else{ echo base_url().'images/logo.png'; } ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />

        <link href="<?php echo base_url(); ?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ; ?>assets/css/fontawesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ; ?>assets/css/styles.css" rel="stylesheet">

        <script src="<?php echo base_url() ; ?>assets/js/jquery.min.js"></script>
        


   </head>
   <body>
    <div class="wrapper">


    <header>
        <nav class="navbar navbar-default">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">H-Cart</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Products</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>Shopping Cart</span></a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span>$ Currency</span> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">$ US Dollar</a></li>
                    <li><a href="#">Egypt Pound</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <span class="hidden-xs hidden-sm hidden-md">My Account</span> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Register</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container -->
        </nav>
    </header>

    <div class="container">