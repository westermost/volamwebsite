<div class="page-block center-block">
    <h2 class="title"><i class="fa fa-usd"></i> Thanh toán</h2>
    <hr>
    <div class="row">
        <aside class="col-md-3 hidden-sm hidden-xs">
            <div class="sidebar">
                <div class="separator"></div>
                <div class="block clearfix">
                    <nav>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="<?= $template['activeSide'] == 'home' ? 'active' : '' ?>">
                                <a href="<?= base_url('Cash') ?>"><i class="fa fa-home"></i> Home</a>
                            </li>
<!--                           <li class="--><?//= $template['activeSide'] == 'charge' ? 'active' : '' ?><!--">-->
<!--                               <a href="--><?//= base_url('Cash/ChargePhone') ?><!--"><i class="fa fa-credit-card"></i> Nạp thẻ</a>-->
<!--                           </li>-->
                            <li class="<?= $template['activeSide'] == 'chargeBank' ? 'active' : '' ?>">
                                <a href="<?= base_url('Cash/ChargeBank') ?>"><i class="fa fa-bank"></i> Nạp Thẻ</a>
                            </li>
                            <li class="<?= $template['activeSide'] == 'chargeLog' ? 'active' : '' ?>">
                                <a href="<?= base_url('Cash/ChargeLog') ?>"><i class="fa fa-history"></i> Lịch sử</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>
