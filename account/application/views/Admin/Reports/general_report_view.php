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
                    <div class="col-md-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>General Report</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    <a class="close-link"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="text-center">
                                    <?php if ($isLastestLog == false): ?>
                                    <a href="<?= base_url('/Admin/Reports/General?ReportDate=' . $newerWeekDate) ?>"><i class="fa fa-chevron-left"></i> MỚI HƠN</a> |
                                    <?php endif; ?>
                                    <?php if ($isOldestLog == false): ?>
                                    <a href="<?= base_url('/Admin/Reports/General?ReportDate=' . $olderWeekDate) ?>">CŨ HƠN <i class="fa fa-chevron-right"></i></a>
                                    <?php endif; ?>
                                </div>
                                <div class="m-t-sm">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <th>Date</th>
                                            <th>Reg Users</th>
                                            <th>Unique IPs</th>
                                            <th>Paid Users</th>
                                            <th>Revenue</th>
                                            <th>ARPPU</th>
                                        </tr>
                                        <?php if (isset($dataLog) && count($dataLog) > 0): ?>
                                        <?php foreach($dataLog as $date => $log): ?>
                                        <tr>
                                            <td><?= date('Y-m-d', strtotime($date)) ?></td>
                                            <td><?= isset($log['RegUsers']) ? $log['RegUsers'] : 0 ?></td>
                                            <td><?= isset($log['UniqueIPs']) ? $log['UniqueIPs'] : 0 ?></td>
                                            <td><?= isset($log['PaidUsers']) ? $log['PaidUsers'] : 0 ?></td>
                                            <td><?= isset($log['Total']) ? number_format($log['Total']) : 0 ?></td>
                                            <td><?= number_format(@($log['Total']/$log['PaidUsers'])) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="6">Chưa có dữ liệu</td>
                                        </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('Admin/footer') ?>
