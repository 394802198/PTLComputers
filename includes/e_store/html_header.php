<?php if( ! isset( $_SESSION ) ) session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo isset( $html_title ) ? $html_title : GLOBAL_SEO_TITLE ?></title>
    <meta name="description" content="<?php echo isset( $html_description ) ? $html_description : GLOBAL_SEO_DESCRIPTION; ?>" />
    <meta name="keywords" content="<?php echo isset( $html_keywords ) ? $html_keywords : GLOBAL_SEO_KEYWORDS; ?>" />
    <meta name="author" content="<?php echo GLOBAL_SEO_AUTHOR ?>" />
    <meta name="copyright" content="<?php echo GLOBAL_SEO_COPYRIGHT ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="shortcut icon" type="image/ico" href="<?php echo ROOT_PATH ?>/resources/e_store/image/favicon.ico"/>
    <link rel="icon" type="image/ico" href="<?php echo ROOT_PATH ?>/resources/e_store/image/favicon.ico" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/global/bootstrap/css/bootstrap.min.css" type="text/css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo ROOT_PATH ?>/resources/global/js/html5shiv.min.js"></script>
    <script src="<?php echo ROOT_PATH ?>/resources/global/js/respond.min.js"></script>
    <![endif]-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/global/bootstrap/css/skins/all.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/global/bootstrap/css/carousel.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/global/css/toastr.min.css" type="text/css" />
    <!-- Reset B3's original styles -->
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/resources/e_store/css/header-footer.css" type="text/css" />

    <style>
        ::-webkit-input-placeholder {
            font-size:12px;
            line-height:25px;
        }

        :-moz-placeholder { /* Firefox 18- */
            font-size:12px;
            line-height:25px;
        }

        ::-moz-placeholder {  /* Firefox 19+ */
            font-size:12px;
            line-height:25px;
        }

        :-ms-input-placeholder {
            font-size:12px;
            line-height:25px;
        }
    </style>

</head>
<!-- NAVBAR
================================================== -->

<body>
