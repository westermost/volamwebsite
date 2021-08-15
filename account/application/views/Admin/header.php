<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Võ Lâm Chí Tôn | <?= $template['title'] ?></title>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
    <link href="<?= public_url('css/common.css') ?>" rel="stylesheet"/>
    <link rel="icon" href="<?= public_url('images/logo.png') ?>">
<?php  if (!empty($template['datePicker']) && $template['datePicker'] === true): ?>
    <link href="<?= public_url('css/jquery.datetimepicker.css') ?>" rel="stylesheet"/>
<?php endif; ?>
    <script src="<?= public_url('js/jquery.min.js') ?>"></script>
</head>
<body>
    <div id="modalContainer" class="modal fade">
        <div id="modalDialog" class="modal-dialog" style="width: 630px;">
        </div>
    </div>

    <div id="wrapper" class="General">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span>
                                <img alt="image" class="img-circle" src="<?= public_url('images/logo.png') ?>" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs">
                                        <strong class="font-bold"><?php echo ($this->AdminInfo['Username']) != '' ? $this->AdminInfo['Username'] : 'Xin chào'  ?></strong>
                                    </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
<!--                                <li><a href="#">Profile</a></li>-->
                                <li class="divider"></li>
                                <li><a href="<?= base_url('Account/Logout') ?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            Cổ Long
                        </div>
                    </li>
                    <li id="report" class="">
                        <a href="#"><i class="fa fa-bar-chart"></i><span class="nav-label">Thống Kê</span></a>
                        <ul class="nav nav-second-level collapse">
<!--                            <li class=""><a href="--><?//= base_url('Admin/Reports/General') ?><!--">Tổng Hợp</a></li>-->
                            <li class=""><a href="<?= base_url('Admin/Reports/CashAdd') ?>">Nạp Tiền</a></li>
<!--                            <li class=""><a href="--><?//= base_url('Admin/Reports/WeeklyCCU') ?><!--">Weekly CCU</a></li>-->
                        </ul>
                    </li>
                    <li class="">
                        <a href="<?= base_url('Admin/Config') ?>"><i class="fa fa-cog"></i><span class="nav-label">Cấu Hình</span></a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('Admin/AddCash') ?>"><i class="fa fa-money"></i> <span class="nav-label">Nạp Tiền</span></a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('Admin/AddDay') ?>"><i class="fa fa-calendar"></i> <span class="nav-label">Nạp Ngày Chơi</span></a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('Admin/CashLog') ?>"><i class="fa fa-usd"></i> <span class="nav-label">Log Nạp Tiền</span></a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('Admin/CashLogDay') ?>"><i class="fa fa-book"></i> <span class="nav-label">Log Nạp Ngày Chơi</span></a>
                    </li>
                    <li class="">
                        <a href="<?= base_url('Admin/AddCashEvent') ?>"><i class="fa fa-money"></i> <span class="nav-label">Nạp Xu Event</span></a>
                    </li>
<!--                    <li class="">-->
<!--                        <a href="--><?//= base_url('Admin/MemberVIP') ?><!--"><i class="fa fa-user"></i> <span class="nav-label">Members</span></a>-->
<!--                    </li>-->
<!--                    <li class="">-->
<!--                        <a href="--><?//= base_url('Admin/GiftItems') ?><!--"><i class="fa fa-diamond"></i> <span class="nav-label">Game Items</span></a>-->
<!--                    </li>-->
<!--                    <li class="">-->
<!--                        <a href="--><?//= base_url('Admin/GiftPacks') ?><!--"><i class="fa fa-gift"></i> <span class="nav-label">Gift Packs</span></a>-->
<!--                    </li>-->
<!--                    <li class="">-->
<!--                        <a href="--><?//= base_url('Admin/Gifts') ?><!--"><i class="fa fa-birthday-cake"></i> <span class="nav-label">Quà Tặng</span></a>-->
<!--                    </li>-->
<!--                    <li class="">-->
<!--                        <a href="--><?//= base_url('Admin/OnlineGift') ?><!--"><i class="fa fa-calendar"></i> <span class="nav-label">Online Nhận Quà</span></a>-->
<!--                    </li>-->
<!--                    <li class="">-->
<!--                        <a href="--><?//= base_url('Admin/SpecialGift') ?><!--"><i class="fa fa-star"></i> <span class="nav-label">Phần thưởng đặc biệt</span></a>-->
<!--                    </li>-->
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?= base_url('Account/Logout') ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
