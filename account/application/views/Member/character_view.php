<?php $this->load->view('Layouts/header.php'); ?>
<div class="main-container">
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                <?php $this->load->view('Layouts/aside.php'); ?>
                <div class="col-md-9">
                    <h4>Quản lý tài khoản</h4>
                    <br/>

                    <div class="row">
                        <div class="col-sm-3">
                            <b><label for="UserName">T&#224;i khoản</label></b>
                        </div>
                        <div class="col-sm-6">
                            <b><?php echo $AccountInfo['cAccName']; ?></b>
                            <hr />
                        </div>
                        <input name="accID" type="hidden" value="<?= $AccountInfo['iid']; ?>" />
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <b><label for="Date_End">Ngày hết hạn</label></b>
                        </div>
                        <div class="col-sm-6">
                            <b><?php echo $EndDate['dEndDate']; ?></b>
                            <hr />
                        </div>
                        <input name="accID" type="hidden" value="<?= $AccountInfo['iid']; ?>" />
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <b><label for="Date_End">Tiền Đồng Hiện Có</label></b>
                        </div>
                        <div class="col-sm-6">
                            <?php
                                if($EndDate['nExtPoint'] == null)
                                {
                                    echo '<b>0</b>';
                                }
                                else{
                                    echo '<b>'. number_format($EndDate['nExtPoint']) . '</b>';
                                }

                            ?>
                            <hr />
                        </div>
                        <input name="accID" type="hidden" value="<?= $AccountInfo['iid']; ?>" />
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <b><label for="Date_End">Mua Ngày Chơi</label></b>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= base_url('Member/MemberAddDay') ?>" class="btn btn-sm btn-default btn-block modal-opener">
                                <i class="fa fa-money"></i> Mua ngày chơi
                            </a>
                            <hr />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <b><label for="Date_End">Giải kẹt nhân vật</label></b>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?= base_url('Member/undisaccount') ?>" class="btn btn-sm btn-default btn-block modal-opener">
                                <i class="fa fa-unlock"></i> Giải kẹt tài khoản
                            </a>
                        </div>
                        <input name="accID" type="hidden" value="<?= $AccountInfo['iid']; ?>" />
                        <div class="col-sm-3">

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
