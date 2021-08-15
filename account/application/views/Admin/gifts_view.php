<?php $this->load->view('Admin/header') ?>
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
                        <div class="col-sm-2"><a href="<?= base_url('Admin/AddGift') ?>" class="btn btn-md btn-default btn-block btn-primary modal-opener"><i class="fa fa-plus"></i> Thêm mới</a></div>
                        <br /><br /><br />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã vật phẩm</th>
                                    <th>Tên vật phẩm</th>
                                    <th>Phân lọai</th>
                                    <th>Điểm thưởng</th>
                                    <th>Số lượng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (empty($gifts) == false && count($gifts) > 0): ?>
                            <?php foreach($gifts as $item): ?>
                                <tr class="">
                                    <td><?= $item['ID'] ?></td>
                                    <td><?= $item['gift_id'] ?></td>
                                    <td><?= $item['Name'] ?></td>
                                    <td>
                                    <?php
                                        if ($item['gift_type'] == 1)
                                            $type = 'Trợ Thủ';
                                        elseif  ($item['gift_type'] == 2)
                                            $type = 'Thú Cưỡi';
                                        elseif ($item['gift_type'] == 0)
                                            $type = 'Vật phẩm';
                                        else
                                            $type = '';
                                        echo $type;
                                    ?>
                                    </td>
                                    <td><?= $item['Point'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>
                                        <a href="<?= base_url('Admin/EditGift' . '/' . $item['ID'] ) ?>" class="btn btn-md btn-default btn-info modal-opener"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('Admin/DelGift' . '/' . $item['ID'] ) ?>" class="btn btn-md btn-default btn-danger modal-opener"><i class="fa fa-close"></i></a>
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
