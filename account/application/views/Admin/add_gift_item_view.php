<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>×</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;TẠO GIFT ITEM MỚI</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Admin/AddGiftItem') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
                <div id="formMessage" class="alert alert-danger hidden"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="ItemType">Phân loại</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="ItemType" name="ItemType">
                            <option value="">--- Chọn loại vật phẩm ---</option>
                            <option value="0">Vật phẩm</option>
                            <option value="1">Trợ thủ</option>
                            <option value="2">Thú cưỡi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="ItemID">Mã vật phẩm</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Mã vật phẩm không được để trống" id="ItemID" name="ItemID" placeholder="Mã vật phẩm" type="text"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="ItemName">Tên vật phẩm</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Tên vật phẩm không được để trống" id="ItemName" name="ItemName" placeholder="Tên vật phẩm" type="text" />
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
    formGiftItem.initValidate();
</script>
