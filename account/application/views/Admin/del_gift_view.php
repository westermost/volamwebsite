<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>×</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;CẬP NHẬT QUÀ TẶNG</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Admin/DelGift') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
                <div id="formMessage" class="alert alert-danger text-center">Bạn có chắc muốn xóa quà tặng này?</div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="ItemType">Phân loại</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="ItemType" name="ItemType" disabled>
                            <option value="">--- Chọn loại vật phẩm ---</option>
                            <option value="0" <?= (strval($giftInfo['gift_type']) === '0') ? 'selected' : '' ?> >Vật phẩm</option>
                            <option value="1" <?= ($giftInfo['gift_type'] == 1) ? 'selected' : '' ?> >Trợ thủ</option>
                            <option value="2" <?= ($giftInfo['gift_type'] == 2) ? 'selected' : '' ?> >Thú cưỡi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="ItemID">Mã vật phẩm</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Mã vật phẩm không được để trống" id="ItemID" name="ItemID" placeholder="Mã vật phẩm" type="text" value="<?= $giftInfo['gift_id'] ?>" disabled />
                        <input type="hidden" name="ID" value="<?= $giftInfo['ID'] ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="ItemName">Tên vật phẩm</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Tên vật phẩm không được để trống" id="ItemName" name="ItemName" placeholder="Tên vật phẩm" type="text" value="<?= $giftInfo['Name'] ?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="Point">Số điểm</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Số điểm không được để trống" id="Point" name="Point" placeholder="Số điểm nhận quà" type="text" value="<?= $giftInfo['Point'] ?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="quantity">Số lượng</label>
                    <div class="col-sm-8">
                        <input class="form-control" data-val="true" data-val-required="Số lượng không được để trống" id="quantity" name="quantity" placeholder="Số lượng vật phẩm" type="text" value="<?= $giftInfo['quantity'] ?>" disabled />
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
    formGift.initValidate();
</script>
