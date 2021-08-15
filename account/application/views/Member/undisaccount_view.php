<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;THÀNH CÔNG</h4>
    </div>
    <div class="modal-body">
        <div class="text-center">
            <?php if ($active == 'success'): ?>
                <div class="alert alert-success">
                    Giải kẹt nhân vật thành công
                </div>
                <hr />
                <p>
                    <a class="btn btn-primary" href="<?= base_url('Login') ?>"><i class="fa fa-check"></i> Đồng ý</a>
                </p>
            <?php else: ?>
                <div class="alert alert-warning">
                    Giải kẹt thất bại server đang gặp sự cố vui long thông báo cho admin
                </div>
                <hr />
                <p>
                    <a class="btn btn-primary" href="<?= base_url('Login') ?>"><i class="fa fa-check"></i> Đồng ý</a>
                </p>
            <?php endif ?>
        </div>
    </div>
</div>

