<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;ĐỔI MẬT KHẨU</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Member/ChangePass') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
            <div id="formMessage" class="alert alert-danger hidden"></div>
            <div class="form-group has-feedback">
                <label class="col-sm-3 control-label" for="OldPassword">Mật khẩu cũ</label>
                <div class="col-sm-8">
                    <input class="form-control" data-val="true" data-val-length="Mật khẩu cũ phải có tối thiểu 6 ký tự." data-val-length-max="60" data-val-length-min="6" data-val-required="Mật khẩu cũ không được để trống" id="OldPassword" maxlength="60" name="OldPassword" placeholder="Old Password" type="password" />
                    <i class="fa fa-lock form-control-feedback"></i>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label class="col-sm-3 control-label" for="NewPassword">Mật khẩu mới</label>
                <div class="col-sm-8">
                    <input class="form-control" data-val="true" data-val-length="Mật khẩu mới phải có tối thiểu 6 ký tự." data-val-length-max="60" data-val-length-min="6" data-val-required="Mật khẩu mới không được để trống" id="NewPassword" maxlength="60" name="NewPassword" placeholder="New Password" type="password" />
                    <i class="fa fa-lock form-control-feedback"></i>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label class="col-sm-3 control-label" for="ConfirmPassword">X&#225;c nhận</label>
                <div class="col-sm-8">
                    <input class="form-control" data-val="true" data-val-equalto="Mật khẩu và Xác nhận không khớp." data-val-equalto-other="*.NewPassword" id="ConfirmPassword" maxlength="60" name="ConfirmPassword" placeholder="Confirm Password" type="password" />
                    <i class="fa fa-lock form-control-feedback"></i>
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
    formChangePass.initValidate();
</script>
