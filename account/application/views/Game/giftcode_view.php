<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <?php $this->load->view('Game/sidebar.php'); ?>
                            <div class="col-md-9">
                                <h4>Gift-Code</h4>
                                <br>
                                <div class="alert alert-info">
                                    <p>
                                        GiftCode luôn chứa những phần quà giá trị và bất ngờ.<br />
                                        Nếu bạn đã được tặng GiftCode, hãy nhập mã vào ô dưới để nhận quà.
                                    </p>
                                    <form action="<?= base_url('Game/GiftCode') ?>" autocomplete="off" class="form-inline" id="miniForm" method="get">                    <div class="form-group">
                                            <div class="col-sm-12">
                                                <input class="form-control" id="Code" maxlength="40" name="Code" placeholder="Gift Code" style="width:360px;" type="text" value="" />
                                                <button class="btn btn-sm btn-default" type="submit">
                                                    <span class='fa fa-check'></span> Nhận Quà
                                                </button>
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
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
