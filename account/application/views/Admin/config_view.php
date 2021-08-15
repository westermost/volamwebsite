<?php $this->load->view('Admin/header.php') ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-10">
                    <h2>Cấu Hình</h2>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab1"><i class="fa fa-envelope"></i> Email</a></li>
<!--                                <li><a data-toggle="tab" href="#tab2"><i class="fa fa-credit-card"></i> Cổng thanh toán</a></li>-->
<!--                                <li><a data-toggle="tab" href="#tab3"><i class="fa fa-cog"></i> Cấu hình chung</a></li>-->
<!--                                <li><a data-toggle="tab" href="#tab4"><i class="fa fa-gift"></i> Quà Tặng</a></li>-->
                            </ul>
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane fade in active" style="margin-top:15px;">
                                    <br>
                                    <form action="<?= base_url('Admin/Config/email') ?>" autocomplete="off" class="form-horizontal" id="mailForm" method="post">
                                        <div id="formMessage" class="alert alert-danger hidden"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="emailProtocol">Protocol</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="emailProtocol" name="emailProtocol" disabled="true">
                                                    <option value="smtp">SMTP</option>
                                                    <option value="sendmail">sendmail</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="emailHost">Host</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" data-val="true" data-val-required="Host không được để trống" id="emailHost" name="emailHost" value="<?= MAIL_SMTP_HOST ?>" type="text" disabled/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="emailPort">Port</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" data-val="true" data-val-required="Port không được để trống" id="emailPort" name="emailPort" value="465" type="text" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="email">Email</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="Email không được để trống" id="Email" name="Email" placeholder="Email address" type="email" value="<?= MAIL_SMTP_USER ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="emailPass">Password</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="emailPass" name="emailPass" placeholder="Email password" type="password" value="<?= MAIL_SMTP_PASS ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6 text-center">
                                                <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                                <img id="submitWait" style="display:none" src="/Assets/img/loading6.gif" />
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="tab2" class="tab-pane fade" style="margin-top:15px;">
                                    <form action="<?= base_url('Admin/Config/charge') ?>" autocomplete="off" class="form-horizontal" id="chargeForm" method="post">
                                        <div id="formMessage" class="alert alert-danger hidden"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="MerchantID">MerchantID</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" data-val="true" data-val-required="Merchant ID không được để trống" placeholder="Vippay Merchant ID" id="MerchantID" name="MerchantID" value="<?= MERCHANT_ID ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="ApiUser">API User</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" data-val="true" data-val-required="API User không được để trống" id="ApiUser" name="ApiUser" placeholder="Vippay API User" value="<?= API_USER ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="ApiPass">API Password</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="ApiPass" name="ApiPass" placeholder="Vippay API Password" type="password" value="<?= API_PASS ?>" />
                                            </div>
                                        </div>
                                        <hr >
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="MerchantID_2">MerchantID 2 (API)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" data-val="true" data-val-required="Merchant ID không được để trống" placeholder="Vippay Merchant ID" id="MerchantID_2" name="MerchantID_2" value="<?= MERCHANT_ID_2 ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="ApiUser_2">API User 2 (API)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" data-val="true" data-val-required="API User không được để trống" id="ApiUser_2" name="ApiUser_2" placeholder="Vippay API User" value="<?= API_USER_2 ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="ApiPass_2">API Password 2 (API)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="ApiPass_2" name="ApiPass_2" placeholder="Vippay API Password" type="password" value="<?= API_PASS_2 ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6 text-center">
                                                <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="tab3" class="tab-pane fade" style="margin-top:15px;">
                                    <form action="<?= base_url('Admin/Config/general') ?>" autocomplete="off" class="form-horizontal" id="generalConfigForm" method="post">
                                        <div id="formMessage" class="alert alert-danger hidden"></div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="Bonus">Khuyến mãi</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="Bonus" name="Bonus" placeholder="Khuyến mãi" value="<?= BONUS ?>" type="number" />
                                            </div>
                                        </div>
<!--                                        <div class="form-group has-feedback">-->
<!--<!--                                            <label class="col-sm-3 control-label" for="ItemID">Item ID</label>-->-->
<!--                                            <div class="col-sm-6">-->
<!--                                                <input class="form-control hidden" id="ItemID" name="ItemID"  value="--><?//= ITEMID ?><!--" type="number" />-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6 text-center">
                                                <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="tab4" class="tab-pane fade" style="margin-top:15px;">
                                    <form action="<?= base_url('Admin/Config/giftdaily') ?>" autocomplete="off" class="form-horizontal" id="giftDailyConfigForm" method="post">
                                        <div id="formMessage" class="alert alert-danger hidden"></div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="DailyGiftITEMID">Item ID</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="DailyGiftITEMID" name="DailyGiftITEMID"  value="<?= DailyGiftITEMID ?>" type="number" />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="ItemType">Loại Vật Phẩm</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="ItemType" name="ItemType">
                                                    <option value="">--- Chọn loại vật phẩm ---</option>
                                                    <option value="0" <?php if(ItemType == 0) echo "selected" ?> >Vật phẩm</option>
                                                    <option value="1" <?php if(ItemType == 1) echo "selected" ?> >Trợ thủ</option>
                                                    <option value="2" <?php if(ItemType == 2) echo "selected" ?> >Thú cưỡi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="ItemName">Tên Vật Phẩm</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="ItemName" name="ItemName" placeholder="Tên Vật Phẩm" value="<?= ItemName ?>" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label class="col-sm-3 control-label" for="Quality">Số Lượng</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="Quality" name="Quality" placeholder="Số Lượng Vật Phẩm" value="<?= Quality ?>" type="number" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6 text-center">
                                                <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('Admin/footer') ?>
