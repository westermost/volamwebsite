<?php $this->load->view('Admin/header.php') ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-10">
                    <h2><?= $template['title'] ?></h2>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                            <a href="<?= base_url('Admin/AddGiftPack') ?>" class="btn btn-md btn-default btn-primary modal-opener"><i class="fa fa-plus"></i> Thêm mới
                            </a>
                            <a href="<?= base_url('Admin/CheckCode') ?>" class="btn btn-md btn-default btn-warning modal-opener"><i class="fa fa-search"></i> Check Code</a>
                        <br /><br /><br />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên gói</th>
                                    <th>Tổng số</th>
                                    <th>Còn lại</th>
                                    <th>Tạo bởi</th>
                                    <th>Tạo lúc</th>
                                    <th>Duyệt bởi</th>
                                    <th>Duyệt lúc</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (empty($giftPacks) == false && count($giftPacks) > 0): ?>
                            <?php foreach($giftPacks as $pack): ?>
                                <tr>
                                    <td><?= $pack['pack_id'] ?></td>
                                    <td><?= $pack['pack_name'] ?></td>
                                    <td><?= $pack['total'] ?></td>
                                    <td><?= is_null($pack['remains']) ? $pack['total'] : $pack['remains'] ?></td>
                                    <td><?= $pack['created_by'] ?></td>
                                    <td><?= $pack['created_at'] ?></td>
                                    <td><?= $pack['approved_by'] ?></td>
                                    <td><?= $pack['approved_at'] ?></td>
                                    <td>
                                        <a href="<?= base_url('Admin/AddGiftPackDetail' . '/' . $pack['pack_id'] ) ?>" class="btn btn-md btn-default btn-info modal-opener"><i class="fa fa-search"></i></a>
                                        <?php if (is_null($pack['approved_at']) && mb_strlen($pack['approved_at']) <= 0): ?>
                                        <a href="<?= base_url('Admin/EditGiftPack' . '/' . $pack['pack_id'] ) ?>" class="btn btn-md btn-default btn-warning modal-opener"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('Admin/DelGiftPack' . '/' . $pack['pack_id'] ) ?>" class="btn btn-md btn-default btn-danger modal-opener"><i class="fa fa-close"></i></a
                                        <?php else: ?>
                                        <a href="<?= base_url('Admin/DownGiftCodes' . '/' . $pack['pack_id'] ) ?>" class="btn btn-md btn-default btn-success"><i class="fa fa-download"></i></a>
                                        <?php endif; ?>

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
