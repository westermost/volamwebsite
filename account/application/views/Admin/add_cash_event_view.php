<?php $this->load->view('Admin/header.php') ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-10">
                    <h2><?= $template['title'] ?></h2>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Nạp tiền Trực tiếp (BANKING)</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    <a class="close-link"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <form action="<?= base_url('Admin/AddCashEvent') ?>" autocomplete="off" class="form-horizontal" id="addCashForm" method="post">
                                    <div id="formMessage" class="<?php echo isset($_SESSION['Information']) ? $_SESSION['Information'] : 'alert alert-danger hidden'?>">
                                        <?php
                                            if(empty($_SESSION['Information']) == false)
                                            {
                                                if($_SESSION['Information'] == 'alert alert-success')
                                                {
                                                    echo '
                                                        <ul>
                                                            <li>Đã nạp thành công</li>
                                                        </ul>
                                                    ';
                                                }
                                                else if($_SESSION['Information'] == 'alert alert-danger')
                                                {
                                                    echo '
                                                    <ul>
                                                        <li>'. $_SESSION['Mess'] .'</li>
                                                    </ul>
                                                ';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="UserName">Account</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" id="UserName" name="UserName" placeholder="Tài Khoản Đăng Nhập Của Người Chơi" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="Cash">Số tiền (VND)</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" placeholder="0" id="Cash" name="Cash" type="number" value="10000" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6 text-center">
                                            <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('Admin/footer') ?>
