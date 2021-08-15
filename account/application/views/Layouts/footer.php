</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div style="padding-top:10px">
                    <i class="fa fa-user"></i> <a href="<?= base_url('Member') ?>">Tài khoản</a> |
                    <i class="fa fa-usd"></i> <a href="<?= base_url('Cash') ?>">Thanh toán</a> |
                    <i class="fa fa-gamepad"></i> <a href="http://volamchiton.info/diendan">Diễn Đàn</a> <br/>
                    Bản quyền: <?php echo APP_NAME ?> &copy; 2017<br />
                    <i class="fa fa-lock"></i> <a href="<?= base_url('Home/Policy') ?>">Chính sách Bảo mật</a> |
                    <i class="fa fa-group"></i> <a href="<?= base_url('Home/Terms') ?>">Điều khoản dịch vụ</a>
                </div>
            </div>
        </div>
    </div>
</footer>


    <script src="<?php echo public_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo public_url('js/jquery.appear.js') ?>"></script>
    <script src="<?php echo public_url('js/jquery.validate.min.js') ?>"></script>
    <script src="<?php echo public_url('js/jquery.form.min.js') ?>"></script>
    <script src="<?php echo public_url('js/main.js') ?>"></script>

    <?php if (isset($template['formName'])): ?>
    <script>
        <?= $template['formName'] ?>.initValidate();
    </script>
    <?php endif; ?>

    <?php if (isset($template['filter']) && $template['filter'] == true): ?>
    <script src="<?php echo public_url('js/filter.js') ?>"></script>
    <?php endif; ?>


    <?php $modelDialogMsg = $this->session->flashdata('modalDialog'); ?>
    <?php if (mb_strlen($modelDialogMsg) > 0): ?>
    <script>
        $("#modalDialog").html(<?= $modelDialogMsg ?>), $("#modalContainer").modal({
            keyboard: !0
        })
    </script>
    <?php endif; ?>
</body>
</html>
