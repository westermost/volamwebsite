<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>×</span></button>
        <h4><i class="fa fa-windows"></i> MỞ KHÓA TÀI KHOẢN</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Member/UserUnlock') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post" novalidate="novalidate">
            <div class="text-center">
                <div class="alert alert-warning">
                    Tài khoản của bạn hiện đang ở trạng thái <b>Khóa An Toàn</b>.<br>
                    Bạn không thể cập nhật các thông tin bảo mật.
                </div>

                <div class="form-group has-feedback">
                    <label class="col-sm-3 control-label">Nhập hình</label>
                    <div class="col-sm-8">
                        <img id="captchaImg" src="<?= base_url('Home/Captcha') ?>" alt="Captcha Image">
                        <input class="form-control" id="captcha" maxlength="5" name="captcha" placeholder="Captcha Image" type="text" value="">
                        <i class="fa fa-check form-control-feedback"></i>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8 text-center">
                        <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN MỞ KHÓA</button>
                        <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    formVerifyCaptcha.initValidate();
</script>
