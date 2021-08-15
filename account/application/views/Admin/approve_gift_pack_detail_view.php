<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>×</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;CHI TIẾT GIFT PACK</h4>
    </div>
    <div class="modal-body">
        <div class="gift-pack">
        <form action="<?= base_url('Admin/AddGiftPackDetail') ?>" autocomplete="off" class="form-inline" id="giftPackItem" method="post">
                <div id="formMessage" class="alert alert-danger hidden"></div>
                <div class="row">
                    <label class="col-sm-3" for="PackName">Tên gói</label>
                    <div class="col-sm-8">
                        <?= $giftPackInfo['pack_name'] ?>
                        <input type="hidden" name="PackID" id="PackID" value="<?= $giftPackInfo['pack_id'] ?>">
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" for="TotalCode">Tổng số</label>
                    <div class="col-sm-8">
                        <?= $giftPackInfo['total'] ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 for="RemainCode">Còn lại</label>
                    <div class="col-sm-8">
                        <?= $giftPackInfo['remains'] ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" for="CreatedBy">Người tạo</label>
                    <div class="col-sm-8">
                        <?= $giftPackInfo['created_by'] ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" for="CreatedAt">Ngày tạo</label>
                    <div class="col-sm-8">
                        <?= $giftPackInfo['created_at'] ?>
                    </div>
                </div>
                <div class="row">
                    <table id="ItemGiftPack" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Phân loại</th>
                                <th>Mã vật phẩm</th>
                                <th>Tên vật phẩm</th>
                                <th>Số lượng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_null($giftPackItem) == false): ?>
                            <?php foreach($giftPackItem as $item): ?>
                            <tr id="<?= $giftPackInfo['pack_id'] . '_' . $item['item_id'] ?>" class="gift-item-disabled">
                                <?php
                                    if ($item['ItemType'] == 1)
                                        $type = 'Trợ Thủ';
                                    elseif  ($item['ItemType'] == 2)
                                        $type = 'Thú Cưỡi';
                                    else
                                        $type = 'Vật phẩm';
                                ?>
                                <td><?= $type ?></td>
                                <td><?= $item['ItemID'] ?></td>
                                <td><?= $item['ItemName'] ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div id="formInform" class="alert alert-warning text-center">
                    <p>Sau khi duyệt, không thể sửa thông tin</p>
                    <p>Bạn thực sự muốn duyệt vào tạo Giftcode?</p>
                </div>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8 text-center">
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-md btn-block btn-primary" onclick="onAjaxSubmit($('#giftPackItem'))"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Xác nhận</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-md btn-block btn-warning" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;&nbsp;&nbsp;HỦY BỎ</button>
                        </div>

                        <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    formGiftPack.initValidate();
</script>
