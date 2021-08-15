<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>×</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;CHI TIẾT GIFT PACK</h4>
    </div>
    <div class="modal-body">
        <div class="gift-pack">
        <form action="<?= base_url('Admin/AddGiftPackDetail/Approve' . '/' . $giftPackInfo['pack_id']) ?>" autocomplete="off" class="form-inline" id="giftPackItem" method="post">
                <?php if (is_null($giftPackInfo['approved_at']) == false && mb_strlen($giftPackInfo['approved_at']) > 0): ?>
                    <div id="formMessage" class="alert alert-danger">
                        Gói GiftCode này đã được phê duyệt. Bạn sẽ không thể chỉnh sửa được.
                    </div>
                <?php else: ?>
                    <div id="formMessage" class="alert alert-danger hidden"></div>
                <?php endif; ?>
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
                        <?= is_null($giftPackInfo['remains']) ? $giftPackInfo['total'] : $giftPackInfo['remains'] ?>
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
                    <?php if (is_null($giftPackInfo['approved_at']) && mb_strlen($giftPackInfo['approved_at']) <= 0): ?>
                    <label class="col-sm-3" for="ItemGiftCode">Tặng phẩm</label>
                    <div class="col-sm-9">
                        <select class="form-control gift-item-dropdown" id="ItemType" name="ItemType">
                            <option value="">- Phân loại -</option>
                            <option value="0">Vật phẩm</option>
                            <option value="1">Trợ thủ</option>
                            <option value="2">Thú cưỡi</option>
                        </select>
                        <input type="text" class="form-control gift-item" id="ItemID" placeholder="Mã Item">
                        <input type="text" class="form-control gift-item" id="quantity" placeholder="Số lượng">
                        <button type="button" class="btn btn-sm btn-primary gift-item-btn" onclick="addGiftPackItem()"><i class="fa fa-plus"></i> Add</button>
                    </div>
                    <?php endif; ?>
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
                            <tr id="<?= $giftPackInfo['pack_id'] . '_' . $item['item_id'] ?>">
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
                                <td><button type="button" class="btn btn-sm btn-danger" <?php if (is_null($giftPackInfo['approved_at']) && mb_strlen($giftPackInfo['approved_at']) <= 0): ?> onclick="removeGiftPackItem(<?= $giftPackInfo['pack_id'] ?>, <?= $item['item_id'] ?>)" <?php endif; ?>><i class="fa fa-minus"></i></button></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <?php if (is_null($giftPackInfo['approved_at']) && mb_strlen($giftPackInfo['approved_at']) <= 0): ?>
                    <div class="col-sm-offset-2 col-sm-8 text-center">
                        <div class="col-sm-6">
                            <button type="button" onclick="openForm($('#giftPackItem').attr('action'))" class="btn btn-md btn-block btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Duyệt</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-md btn-block btn-warning modal-refresh"><i class="fa fa-close"></i>&nbsp;&nbsp;&nbsp;HỦY BỎ</button>
                        </div>
                        <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>" />
                    </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    formGiftPack.initValidate();
</script>
