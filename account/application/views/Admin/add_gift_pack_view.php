<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>×</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;TẠO GIFT PACK MỚI</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Admin/AddGiftPack') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
                <div id="formMessage" class="alert alert-danger hidden"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="PackName">Tên gói</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Tên gói giftcode không được để trống" id="PackName" name="PackName" placeholder="Tên gói giftcode" type="text"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="TotalCode">Số lượng</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Số lượng giftcode không được để trống" id="TotalCode" name="TotalCode" placeholder="Số lượng giftcode của gói" type="text" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8 text-center">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-md btn-block btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-md btn-block btn-warning" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;&nbsp;HỦY BỎ</button>
                        </div>
                        <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>" />
                    </div>
                </div>
            </form>
    </div>
</div>
<script>
    formGiftPack.initValidate();
</script>
