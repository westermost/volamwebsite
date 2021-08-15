<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <?php $this->load->view('Cash/sidebar.php'); ?>
                            <div class="col-md-9">
                                <form action="<?= base_url('Cash/ChargePhone') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
                                <div class="alert alert-info">
                                    <ul>
                                        <li>Mỗi Kim Nguyên Bảo trị giá 10 VNĐ</li>
                                        <li>Kim Nguyên Bảo được dùng chung cho các nhân vật cùng tài khoản</li>
                                    </ul>
                                </div>
                                <div id="formMessage" class="alert alert-danger hidden">
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="CardType">Loại thẻ</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="CardType" name="CardType">
                                            <option value="">--- Chọn loại thẻ ---</option>
                                            <option value="1">Thẻ Viettel</option>
                                            <option value="2">Thẻ Mobifone</option>
                                            <option value="3">Thẻ Vinaphone</option>
                                            <!-- <option value="4">Thẻ Gate</option>
                                            <option value="11">Thẻ Zing</option>
                                            <option value="14">Thẻ OnCash</option>
                                            <option value="17">Thẻ Megacard</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-sm-3 control-label" for="CardSeri">Số seri thẻ</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" data-val="true" data-val-regex="The field Số seri thẻ must match the regular expression &#39;([0-9]{8,32})&#39;." data-val-regex-pattern="([0-9]{8,32})" id="CardSeri" maxlength="16" name="CardSeri" placeholder="Card Seri" type="text" value="" />
                                        <i class="fa fa-credit-card form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-sm-3 control-label" for="CardCode">M&#227; thẻ c&#224;o</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" data-val="true" data-val-regex="The field Mã thẻ cào must match the regular expression &#39;([0-9]{8,32})&#39;." data-val-regex-pattern="([0-9]{8,32})" id="CardCode" maxlength="16" name="CardCode" placeholder="Card Code" type="text" value="" />
                                        <i class="fa fa-lock form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-sm-3 control-label">Nhập hình</label>
                                    <div class="col-sm-8">
                                        <img id="captchaImg" src="<?= base_url('Home/Captcha') ?>" alt="Captcha Image" />
                                        <input class="form-control" id="captcha" maxlength="5" name="captcha" placeholder="Captcha Image" type="text" value="" />
                                        <i class="fa fa-check form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-8 text-center">
                                        <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-usd"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                        <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>" />
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
