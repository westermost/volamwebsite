<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <?php $this->load->view('Game/sidebar.php'); ?>
                            <div class="col-md-9">
                                <h4>Phần thưởng</h4>
                                <p>Những phần quà tri ân dành cho các thành viên tích cực. Các mốc phần thưởng với những món quà giá trị.</p>
                                <br />
                                <?php if($this->session->flashdata('giftbox') != ''): ?>
                                <?php $flashdata = $this->session->flashdata('giftbox'); ?>
                                <?php if($flashdata['type'] == 'fail'): ?>
                                <div class="alert alert-danger">
                                    <p><?= $flashdata['message'] ?></p>
                                </div>
                                <?php endif; ?>
                                <?php endif;?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Quà tặng</th>
                                            <th scope="col">Mốc nạp</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_null($giftTarget) == false && count($giftTarget) > 0): ?>
                                            <?php foreach($giftTarget as $gift): ?>
                                            <tr>
                                                <td><?= $gift['Name'] ?></td>
                                                <td><?= $gift['Point'] ?> </td>
                                            <?php if(isset($totalCash) && $totalCash['CountCard'] >= $gift['Point']): ?>
                                                <?php if($gift['acct_id'] != '' && mb_strlen($gift['acct_id']) > 0): ?>
                                                <td style="color: green"><i class="fa fa-check"></i> Đã nhận</td>
                                                <?php else: ?>
                                                <td><span><a href="<?= base_url('Game/GiftBox/' . $gift['ID']) ?>"><i class="fa fa-gift"></i> Nhận Quà</a></span></td>
                                                <?php endif ?>
                                            <?php else: ?>
                                                <td style="color: #1a7bb9"><span><i class="fa fa-close"></i> Chưa đủ điều kiện</span></td>
                                            <?php endif; ?>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="3">Hiện chưa có phần thưởng nào</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <br><br>
                                <h4>Phần Thưởng Nạp Thẻ Hàng Ngày</h4>
                                <p>Nạp thẻ mệnh giá bất kỳ sẽ nhận được 1 thú con ngẫu nhiên trong Thương Thành.</p>
                                <br />
                                <?php if($this->session->flashdata('giftbox') != ''): ?>
                                    <?php $flashdata = $this->session->flashdata('giftbox'); ?>
                                    <?php if($flashdata['type'] == 'fail'): ?>
                                        <div class="alert alert-danger">
                                            <p><?= $flashdata['message'] ?></p>
                                        </div>
                                    <?php endif; ?>
                                <?php endif;?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Quà tặng</th>
                                        <th scope="col">Số Lượng</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <td><?php echo $giftDaily['itemName'] ?></td>
                                        <td><?php echo $giftDaily['quality'] ?></td>

                                            <?php
                                                if($checkDailyGift == false)
                                                {
                                                    echo " <td style=\"color: #1a7bb9\"><span><i class=\"fa fa-close\"></i> Chưa đủ điều kiện</span></td>";
                                                }
                                                elseif($checkDailyGift == TRUE)
                                                {
                                                    if($GiftDailyReceived == false)
                                                    {
                                                        echo "<td><a href='Gifts/giftDaily'><i class=\"fa fa-gift\"></i> Nhận quà</a></td>";
                                                    }
                                                    else
                                                    {
                                                        echo "<td style=\"color: green\"><i class=\"fa fa-check\"></i> Đã nhận</td>";
                                                    }
                                                }
                                            ?>

                                    </tbody>
                                </table>

                                <br><br>
                                <h4>Phần thưởng đặc biệt</h4>
                                <p>Phần thưởng đặc biệt đến với những người xứng đáng.</p>
                                <br />
                                <?php if($this->session->flashdata('specialGiftMsg') != ''): ?>
                                <?php $flashdata = $this->session->flashdata('specialGiftMsg'); ?>
                                <?php if($flashdata['type'] == 'fail'): ?>
                                <div class="alert alert-danger">
                                    <p><?= $flashdata['message'] ?></p>
                                </div>
                                <?php endif; ?>
                                <?php endif;?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tên vật phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($enabled == true): ?>
                                        <td><?= SG_ITEMNAME ?></td>
                                        <td><?= $ItemQuantity ?></td>
                                        <?php if ($received == true): ?>
                                             <td style="color: #1a7bb9"><span><i class="fa fa-close"></i> Chưa đủ điều kiện</span></td>
                                        <?php else: ?>
                                            <td><a href="<?= base_url('Game/Gifts/SpecialGift') ?>"><i class="fa fa-gift"></i> Nhận quà</a></td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td colspan="4">Nạp thẻ đều đặn để nhận những phần quà đặc biệt nhé!</td>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
