<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>×</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;KHÓA TÀI KHOẢN</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Member/UserLockNow') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post" novalidate="novalidate">
            <div class="alert alert-info">
                Tài khoản sau khi <b>Khóa An Toàn</b> sẽ không thể thay đổi Email.<br>
                Sau khi khóa, bạn có thể mở khóa bằng email
                <ul>
                    <li>
                        Trong trường hợp không thể sử dụng Email,
                        xin hãy liên hệ bộ phận CSKH để đổi Email
                    </li>
                </ul>
            </div>
            <div id="formMessage" class="alert alert-danger hidden">
            </div>
            <div class="form-group has-feedback">
                <label class="col-sm-3 control-label">Nhập hình</label>
                <div class="col-sm-8">
                    <img id="captchaImg" src="<?= base_url('Home/Captcha') ?>" alt="Captcha Image">
                    <input class="form-control" id="captcha" maxlength="5" name="captcha" placeholder="Captcha Image" type="text" value="">
                    <i class="fa fa-check form-control-feedback"></i>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8 text-center">
                    <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN KHÓA</button>
                    <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    formVerifyCaptcha.initValidate();
</script>
