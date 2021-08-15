<?php $this->load->view('Admin/header.php') ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-10">
                    <h2><?= $template['title'] ?></h2>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <?php if ($this->session->flashdata('GiftOnlineMsg')): ?>
                <?php $msg = $this->session->flashdata('GiftOnlineMsg'); ?>
                <div id="formMessage" class="alert alert-<?= $msg['Type'] ?>"><?= $msg['Message'] ?></div>
                <?php endif; ?>
                <div class="row">
                    <form action="<?= base_url('Admin/OnlineGift') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="Point">Mốc nạp tháng</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="Point" placeholder="Mốc nạp trong tháng" value="<?= ONLINE_GIFT_POINT ?>" type="number"/>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-block btn-info"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Save</button>
                            </div>
                        </div>
                    </form>
                    <br />
                    <?php for($iii = 1; $iii <= 24; $iii++): ?>
                        <?php
                            if (isset($onlineGift[$iii]) && count($onlineGift[$iii]) > 0)
                            {
                                $giftItem = $onlineGift[$iii];
                            }
                            else
                            {
                                $giftItem = array();
                            }
                        ?>
                    <form action="<?= base_url('Admin/OnlineGift/Edit' . '/' . $iii) ?>" autocomplete="off" class="form-horizontal" id="onlineEventForm<?= $iii ?>" method="post">
                    <!-- Ngày <?= $iii ?>  -->
                    <div class="form-group">
                        <label class="col-sm-1 control-label">Ngày <?= $iii ?></label>
                        <label class="col-sm-1 control-label">Normal</label>
                        <div class="col-sm-2">
                            <input class="form-control" name="ItemID_1" placeholder="Mã vật phẩm" value="<?= getValue($giftItem, 'ItemID1') ?>" type="number"/>
                            <br/>
                            <input class="form-control" name="ItemName_1" placeholder="Tên vật phẩm" value="<?= getValue($giftItem, 'ItemName1') ?>" type="text"/>
                        </div>
                        <div class="col-sm-2">
                            <input class="form-control" name="Quantity_1" placeholder="Số lượng" value="<?= getValue($giftItem, 'Quantity1') ?>" type="number"/>
                            <br>
                            <select class="form-control gift-item-dropdown" id="ItemType_1" name="ItemType_1">
                                <option value="">--- Phân loại ---</option>
                                <option value="0" <?= (strval(getValue($giftItem, 'ItemType1')) === '0') ? 'selected' : '' ?> >Vật phẩm</option>
                                <option value="1" <?= (getValue($giftItem, 'ItemType1') == 1) ? 'selected' : '' ?> >Trợ thủ</option>
                                <option value="2" <?= (getValue($giftItem, 'ItemType1') == 2) ? 'selected' : '' ?> >Thú cưỡi</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <?php if (getValue($giftItem, 'Image1') != ''): ?>
                                <img src="<?= public_url('images/items/' . getValue($giftItem, 'Image1')) . '?t=' . rand_number() ?>" />
                            <?php else: ?>
                                <img src="<?= public_url('images/items/item_na.png') ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-3">
                            <input class="form-control" name="Image_1" placeholder="Hình ảnh" type="file"/>
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" onclick="updateOnlineEventNormal(<?= $iii ?>)" class="btn btn-sm btn-block btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Save</button>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-offset-1 col-sm-1 control-label">Đạt mốc</label>
                        <div class="col-sm-2">
                            <input class="form-control" name="ItemID_2" placeholder="Mã vật phẩm" value="<?= getValue($giftItem, 'ItemID2') ?>" type="number"/>
                            <br>
                            <input class="form-control" name="ItemName_2" placeholder="Tên vật phẩm" value="<?= getValue($giftItem, 'ItemName2') ?>" type="text"/>
                        </div>
                        <div class="col-sm-2">
                            <input class="form-control" name="Quantity_2" placeholder="Số lượng" value="<?= getValue($giftItem, 'Quantity2') ?>" type="number"/>
                            <br>
                            <select class="form-control gift-item-dropdown" id="ItemType_2" name="ItemType_2">
                                <option value="">--- Phân loại ---</option>
                                <option value="0" <?= (strval(getValue($giftItem, 'ItemType2')) === '0') ? 'selected' : '' ?> >Vật phẩm</option>
                                <option value="1" <?= (getValue($giftItem, 'ItemType2') == 1) ? 'selected' : '' ?> >Trợ thủ</option>
                                <option value="2" <?= (getValue($giftItem, 'ItemType2') == 2) ? 'selected' : '' ?> >Thú cưỡi</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <?php if (getValue($giftItem, 'Image2') != ''): ?>
                                <img src="<?= public_url('images/items/' . getValue($giftItem, 'Image2')) . '?t=' . rand_number() ?>" />
                            <?php else: ?>
                                <img src="<?= public_url('images/items/item_na.png') ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-3">
                            <input class="form-control" name="Image_2" placeholder="Hình ảnh" type="file"/>
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" onclick="updateOnlineEventSpecial(<?= $iii ?>)" class="btn btn-sm btn-block btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Save</button>
                        </div>
                    </div>
                    </form>
                    <hr />
                    <!-- End ngày <?= $iii ?> -->
                    <?php endfor; ?>
                </div>
            </div>
<?php $this->load->view('Admin/footer') ?>
