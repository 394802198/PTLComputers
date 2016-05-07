<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>Remarketing</title>
    <link rel="shortcut icon" type="image/ico" href="/resources/global/image/favicon.ico"/>
    <link rel="icon" type="image/ico" href="/resources/global/image/favicon.ico" />
    <link rel="stylesheet" href="/resources/global/bootstrap/css/bootstrap.min.css" type="text/css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/resources/global/js/html5shiv.min.js"></script>
    <script src="/resources/global/js/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/resources/global/bootstrap/css/skins/all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/resources/global/bootstrap/css/carousel.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/resources/global/css/toastr.min.css" rel="stylesheet" type="text/css" />
    <!-- Reset B3's original styles -->
    <link rel="stylesheet" href="/resources/remarketing/css/header-footer.css" rel="stylesheet" type="text/css" />
    
  </head>
<!-- NAVBAR
================================================== -->
  <body>
  
    <div class="navbar navbar-default navbar-static-top" role="navigation">
    	<div class="container">
    		<div class="navbar-header" style="margin:0;">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    			</button>
    		</div>
    		<?php if(!isset($_SESSION)) session_start(); if(isset($_SESSION['wholesaler'])) require 'header_loggon.php' ?>
    	</div>
    </div>
	    