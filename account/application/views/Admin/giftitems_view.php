<?php $this->load->view('Admin/header.php') ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-10">
                    <h2><?= $template['title'] ?></h2>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="col-sm-2"><a href="<?= base_url('Admin/AddGiftItem') ?>" class="btn btn-md btn-default btn-block btn-primary modal-opener"><i class="fa fa-plus"></i> Thêm mới</a></div>
        <br /><br /><br />
                <div class="row">
                    <div class="col-lg-12">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã vật phẩm</th>
                                    <th>Tên vật phẩm</th>
                                    <th>Phân lọai</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (empty($itemGiftCodes) == false && count($itemGiftCodes) > 0): ?>
                            <?php foreach($itemGiftCodes as $item): ?>
                                <tr class="">
                                    <td><?= $item['ID'] ?></td>
                                    <td><?= $item['ItemID'] ?></td>
                                    <td><?= $item['ItemName'] ?></td>
                                    <td>
                                    <?php
                                        if ($item['ItemType'] == 1)
                                            $type = 'Trợ Thủ';
                                        elseif  ($item['ItemType'] == 2)
                                            $type = 'Thú Cưỡi';
                                        else
                                            $type = 'Vật phẩm';

                                        echo $type;
                                    ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('Admin/EditGiftItem' . '/' . $item['ID'] ) ?>" class="btn btn-md btn-default btn-info modal-opener"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('Admin/DelGiftItem' . '/' . $item['ID'] ) ?>" class="btn btn-md btn-default btn-danger modal-opener"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
<?php $this->load->view('Admin/footer') ?>
