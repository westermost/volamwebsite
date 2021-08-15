<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <?php $this->load->view('Game/sidebar.php'); ?>
                            <div class="col-md-9">
                                <h4>Online nhận quà</h4>
                                <p>Điểm danh hằng ngày để nhận những phần quà thú vị.</p>
                                <p>Nạp đến lên đến <strong><?= ONLINE_GIFT_POINT ?></strong> để nhận những phần giá trị hơn.</p>
                                <br>
                                <?php if($this->session->flashdata('online') != ''): ?>
                                <?php $flashdata = $this->session->flashdata('online'); ?>
                                <?php if($flashdata['type'] == 'fail'): ?>
                                <div class="alert alert-danger">
                                    <p><?= $flashdata['message'] ?></p>
                                </div>
                                <?php endif; ?>
                                <?php endif;?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Ngày</th>
                                        <th scope="col" width="12%">Hình ảnh</th>
                                        <th scope="col">Tên vật phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php for($iii = 1; $iii <= 24; $iii++): ?>
                                            <?php if ($isEligible == true): ?>
                                                <tr>
                                                    <?php if(isset($onlineGift[$iii]['ItemName2']) && $onlineGift[$iii]['ItemName2'] != ''): ?>
                                                        <td><span class="online-item"><?= $iii ?></span></td>
                                                    <?php else: ?>
                                                        <td><?= $iii ?></td>
                                                    <?php endif; ?>
                                                    <?php if ($todayReceived == true && $dayReceived == $iii): ?>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td style="color: green"><i class="fa fa-check"></i> Đã nhận</td>
                                                    <?php else: ?>
                                                        <?php if (isset($onlineGift[$iii]['Image2']) && $onlineGift[$iii]['Image2'] != ''): ?>
                                                        <td><img src="<?= public_url('images/items/' . $onlineGift[$iii]['Image2']) . '?t=' . rand_number() ?>" /></td>
                                                        <?php else: ?>
                                                        <td>-</td>
                                                        <?php endif; ?>
                                                        <?php if(isset($onlineGift[$iii]['ItemName2']) && $onlineGift[$iii]['ItemName2'] != ''): ?>
                                                            <td><span class="online-item"><?= $onlineGift[$iii]['ItemName2'] ?></span></td>
                                                        <?php else: ?>
                                                            <td>-</td>
                                                        <?php endif; ?>
                                                        <?php if(isset($onlineGift[$iii]['Quantity2']) && $onlineGift[$iii]['Quantity2'] != ''): ?>
                                                            <td><span class="online-item"><?= $onlineGift[$iii]['Quantity2'] ?></span></td>
                                                        <?php else: ?>
                                                            <td>-</td>
                                                        <?php endif; ?>
                                                        <?php if ($iii < $dayReceived): ?>
                                                        <td style="color: green"><i class="fa fa-check"></i> Đã nhận</td>
                                                        <?php elseif ($iii == $dayReceived): ?>
                                                            <td><span class="online-item"><a href="<?= base_url('Game/OnlineEvent/Receive' . '/' . $iii . '/2') ?>"><i class="fa fa-gift"></i> Nhận quà</a></span></td>
                                                        <?php else: ?>
                                                        <td style="color: #1a7bb9"><span class="online-item">Chưa đủ điều kiện</span></td>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    <?php if(isset($onlineGift[$iii]['ItemName1']) && $onlineGift[$iii]['ItemName1'] != ''): ?>
                                                        <td><span class="online-item"><?= $iii ?></span></td>
                                                    <?php else: ?>
                                                        <td><?= $iii ?></td>
                                                    <?php endif; ?>
                                                    <?php if ($todayReceived == true && $dayReceived == $iii): ?>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td style="color: green"><i class="fa fa-check"></i> Đã nhận</td>
                                                    <?php else: ?>
                                                        <?php if (isset($onlineGift[$iii]['Image1']) && $onlineGift[$iii]['Image1'] != ''): ?>
                                                        <td><img src="<?= public_url('images/items/' . $onlineGift[$iii]['Image1']) . '?t=' . rand_number() ?>" /></td>
                                                        <?php else: ?>
                                                        <td>-</td>
                                                        <?php endif; ?>
                                                        <?php if(isset($onlineGift[$iii]['ItemName1']) && $onlineGift[$iii]['ItemName1'] != ''): ?>
                                                            <td><span class="online-item"><?= $onlineGift[$iii]['ItemName1'] ?></span></td>
                                                        <?php else: ?>
                                                            <td>-</td>
                                                        <?php endif; ?>
                                                        <?php if(isset($onlineGift[$iii]['Quantity1']) && $onlineGift[$iii]['Quantity1'] != ''): ?>
                                                            <td><span class="online-item"><?= $onlineGift[$iii]['Quantity1'] ?></span></td>
                                                        <?php else: ?>
                                                            <td>-</td>
                                                        <?php endif; ?>
                                                        <?php if ($iii < $dayReceived): ?>
                                                        <td style="color: green"><i class="fa fa-check"></i> Đã nhận</td>
                                                        <?php elseif ($iii == $dayReceived): ?>
                                                            <td><span class="online-item"><a href="<?= base_url('Game/OnlineEvent/Receive' . '/' . $iii . '/1') ?>"><i class="fa fa-gift"></i> Nhận quà</a></span></td>
                                                        <?php else: ?>
                                                        <td style="color: #1a7bb9"><span class="online-item">Chưa đủ điều kiện</span></td>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endfor; ?>
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
