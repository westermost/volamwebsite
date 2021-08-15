<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;ĐỔI ĐỊA CHỈ EMAIL</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Member/ChangeEmail') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
                    <div id="formMessage" class="alert alert-danger hidden"></div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label" for="Email">Email</label>
                        <div class="col-sm-8">
                            <input class="form-control" data-val="true" data-val-email="The Email field is not a valid e-mail address." data-val-required="Email không được để trống" id="Email" name="Email" placeholder="Email" type="email" value="" />
                            <i class="fa fa-envelope form-control-feedback"></i>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 control-label">Nhập hình</label>
                        <div class="col-sm-8">
                            <img id="captchaImg" src="/Home/Captcha" alt="Captcha Image" />
                            <input class="form-control" id="captcha" maxlength="5" name="captcha" placeholder="Captcha Image" type="text" value="" />
                            <i class="fa fa-check form-control-feedback"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8 text-center">
                            <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                            <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>" />
                        </div>
                    </div>
        </form>
    </div>
</div>
<script>
    formChangeEmail.initValidate();
</script>
