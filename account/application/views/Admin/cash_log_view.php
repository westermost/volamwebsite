<?php $this->load->view('Admin/header.php') ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-10">
        <h2><?= $template['title'] ?></h2>
    </div>
    <div class="col-sm-2">
    </div>
</div>
<div class="wrapper wrapper-content">
<!--    <div class="col-sm-2"><a href="--><?//= base_url('Admin/MemberVIP') ?><!--" class="btn btn-md btn-warning btn-block btn-warning"><i class="fa fa-plus"></i> VIP Members</a></div>-->
    <br /><br /><br />
    <div class="row">
        <div class="col-md-12">

            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                <thead>
                <tr>
                    <th>Tài Khoản</th>
                    <th>Người Nạp</th>
                    <th>Nguồn Nạp</th>
                    <th>Số Tiền</th>
                    <th>Ngày Nạp</th>
                    <th>Trạng Thái</th>
                </tr>
                </thead>
                <tbody>
                <?php  if (empty($CashLogs) == false && count($CashLogs) > 0): ?>
                    <?php foreach($CashLogs as $item): ?>
                        <tr class="">
                            <td><?= $item['cAccName'] ?></td>
                            <td><?= $item['Admin'] ?></td>
                            <td><?= $item['TypeCard'] ?></td>
                            <td><?= number_format($item['MoneyCard']) ?></td>
                            <td><?= $item['DateCreated'] ?></td>
                            <td>
                                <?php
                                    if($item['Status'] == 1)
                                    {
                                       echo '<span class="label label-success">Thành công</span>';
                                    }
                                    else{
                                        echo '<span class="label label-warning">Thất bại</span>';
                                    }
                                ?>
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
