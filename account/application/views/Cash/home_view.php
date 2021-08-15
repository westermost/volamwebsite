<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <?php $this->load->view('Cash/sidebar.php'); ?>
                            <div class="col-md-9">
                                <div class="row grid-space-10">
<!--                                   <div class="col-sm-4">-->
<!--                                       <div class="box-style-2">-->
<!--                                           <div class="icon-container default-bg">-->
<!--                                               <a href="--><?//=  base_url('Cash/ChargePhone') ?><!--"><i class="fa fa-credit-card"></i></a>-->-->
<!--                                           </div>-->
<!--                                           <div class="body">-->
<!--                                               <h2>Nạp thẻ</h2>-->
<!--                                               <p>Nạp Kim Nguyên Bảo sử dụng các loại thẻ Vina, Mobi, Viettel.</p>-->
<!--                                               <a href="--><?//= base_url('Cash/ChargePhone') ?><!--" class="link"><span>Xem thêm</span></a>-->-->
<!--                                           </div>-->
<!--                                       </div>-->
<!--                                   </div>-->
                                    <div class="col-sm-4">
                                        <div class="box-style-2">
                                            <div class="icon-container default-bg">
                                                <a href="<?= base_url('Cash/ChargeBank') ?>"><i class="fa fa-money"></i></a>
                                            </div>
                                            <div class="body">
                                                <h2>Nạp Thẻ</h2>
                                                <p>Nạp Kim Nguyên Bảo sử dụng thẻ ATM nội địa hoặc các thẻ Tín dụng Quốc tế, MOMO.</p>
                                                <a href="<?= base_url('Cash/ChargeBank') ?>" class="link"><span>Nạp ngay</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="box-style-2">
                                            <div class="icon-container default-bg">
                                                <a href="<?= base_url('Cash/ChargeLog') ?>"><i class="fa fa-history"></i></a>
                                            </div>
                                            <div class="body">
                                                <h2>Lịch sử</h2>
                                                <p>Tra cứu lịch sử các giao dịch nạp Kim Nguyên Bảo của bạn.</p>
                                                <a href="<?=  base_url('Cash/ChargeLog') ?>" class="link"><span>Xem thêm</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
