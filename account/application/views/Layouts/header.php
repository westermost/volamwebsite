<!DOCTYPE html>
<html>
<head>
    <title><?= isset($template['title']) ? $template['title'] : 'Đăng nhập' ?> - <?php echo APP_NAME ?></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo APP_DESCRIPTION ?>">
    <meta name="keywords" content="<?php echo APP_KEYWORDS ?>">
    <meta name="author" content="<?php echo APP_AUTHOR ?>">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo public_url('css/style.css') ?>" rel="stylesheet"/>
    <link rel="icon" href="<?php echo public_url('images/logo.png') ?>">
    <!-- Javascript -->
    <script src="<?php echo public_url('js/jquery.min.js') ?>"></script>
    <script src="<?php echo public_url('js/modernizr.js') ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="front no-trans" >
<div class="scrollToTop">
    <i class="fa fa-arrow-up"></i>
</div>

<div class="header-top">
    <div class="container" >
        <div class="row">
            <div class="col-xs-2 col-sm-8">
                <div class="header-top-first clearfix">
                    <ul class="social-links clearfix hidden-xs">
                        <li class="googleplus"><a target="_blank" href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="googleplus"><a target="_blank" href="<?php echo APP_FACEBOOK ?>"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li class="googleplus"><a href="mailto:<?php echo APP_EMAIL ?>"><i class="fa fa-envelope"></i> <?php echo APP_EMAIL ?></a></li>
                    </ul>
                    <div class="social-links hidden-lg hidden-md hidden-sm">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
                            <ul class="dropdown-menu dropdown-animation">
                                <li class="googleplus"><a target="_blank" href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                                <li class="googleplus"><a target="_blank" href="<?php echo APP_FACEBOOK ?>"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <li class="googleplus"><a href="mailto:<?php echo APP_EMAIL ?>"><i class="fa fa-envelope"></i> <?php echo APP_EMAIL ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-10 col-sm-4">
                <div class="header-top-second clearfix">
                    <div class="header-top-dropdown">
                        <ul class="social-links clearfix">
                            <?php if (isset($this->userInfo) && count($this->userInfo) > 0): ?>
                                <li class="googleplus"><a href="<?php echo base_url('Member/Profile') ?>"><i class="fa fa-user"></i> <b><?= $this->userInfo['loginName'] ?></b></a></li>
                                <li class="googleplus"><a href="<?php echo base_url('Account/Logout') ?>"><i class="fa fa-sign-out"></i> Thoát</a></li>
                            <?php else: ?>
                                <li class="googleplus"><a href="<?php echo base_url('Register') ?>"><i class="fa fa-user-plus"></i> Đăng ký</a></li>
                                <li class="googleplus"><a href="<?php echo base_url('Login') ?>"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal starts -->
<div id="modalContainer" class="modal fade">
    <div id="modalDialog" class="modal-dialog" style="width: 630px;">
    </div>
</div>
<!-- Modal ends -->

<div class="page-wrapper">
    <header class="header fixed clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="header-left clearfix">
                        <div class="logo">
                            <a href="<?php echo base_url('Member') ?>"><img id="logo" src="<?php echo public_url('images/logo.png') ?>" alt="Logo"></a>
                        </div>
                        <div class="site-slogan">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="header-right clearfix">
                        <div class="main-navigation animated">
                            <nav class="navbar navbar-default" role="navigation">
                                <div class="container-fluid">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainMenuBar">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="collapse navbar-collapse" id="mainMenuBar">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li>
                                                <a href="<?= base_url('Member') ?>"><i class="fa fa-user"></i> Tài khoản</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('Cash') ?>"><i class="fa fa-usd"></i> Thanh toán</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('Game') ?>"><i class="fa fa-gamepad"></i> Download</a>
                                            </li>
                                            <li>
                                                <a href="http://volamchiton.info/diendan"><i class="fa fa-comment-o"></i> Diễn Đàn</a>
                                            </li>
                                            <li>
                                                <a href="<?= base_url('Home/Support') ?>"><i class="fa fa-question-circle"></i> Hỏi đáp</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
