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
                                <h5>Báo cáo nạp tiền</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    <a class="close-link"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="text-center">
                                    <form action="<?= base_url('Admin/Reports/CashAdd') ?>" class="form-inline" method="get">
                                        <div class="form-group">
                                            <label>Từ ngày:</label> &nbsp;
                                            <input class="text-box single-line" data-val="true" data-val-date="The field BeginDate must be a date." id="BeginDate" name="BeginDate" readonly="true" style="max-width: 120px; display: inline" type="datetime" value="<?= date('Y-m-d', strtotime($startDate)) ?>" /> &nbsp;&nbsp;
                                            <label>Tới ngày:</label> &nbsp;
                                            <input class="text-box single-line" data-val="true" data-val-date="The field EndDate must be a date." id="EndDate" name="EndDate" readonly="true" style="max-width: 120px; display: inline" type="datetime" value="<?= date('Y-m-d', strtotime($endDate)) ?>" /> &nbsp;&nbsp;
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <hr />
                                <p class="sumvalue">
                                    <b>TỔNG SỐ TIỀN NHẬN = <?= number_format($total) ?> VNĐ</b><br />
                                </p>
                                <hr />
                                <p class="text-danger"><b>THẺ NGÂN HÀNG</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại giao dịch</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <tr>
                                        <td style="width:25%">DIRECT</td>
                                        <td style="width:25%"><?= $cashLogBank[1] ?></td>
                                        <td style="width:25%"><?= number_format($cashLogBank[0]) ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= $cashLogBank[1] ?></b></td>
                                        <td><b class="sumvalue"><?= number_format((int) $cashLogBank[0]) ?></b></td>
                                    </tr>
                                </table> <hr />
                                <p class="text-danger"><b>THẺ VINA</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại thẻ</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php if (isset($totalVina)): ?>
                                    <?php if (isset($cashLogVina['10000'])): ?>
                                    <tr>
                                        <td style="width:25%">10k</td>
                                        <td style="width:25%"><?= $cashLogVina['10000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(10000 * $cashLogVina['10000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogVina['20000'])): ?>
                                    <tr>
                                        <td style="width:25%">20k</td>
                                        <td style="width:25%"><?= $cashLogVina['20000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(20000 * $cashLogVina['20000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogVina['50000'])): ?>
                                    <tr>
                                        <td style="width:25%">50k</td>
                                        <td style="width:25%"><?= $cashLogVina['50000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(50000 * $cashLogVina['50000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogVina['100000'])): ?>
                                    <tr>
                                        <td style="width:25%">100k</td>
                                        <td style="width:25%"><?= $cashLogVina['100000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(100000 * $cashLogVina['100000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogVina['200000'])): ?>
                                    <tr>
                                        <td style="width:25%">200k</td>
                                        <td style="width:25%"><?= $cashLogVina['200000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(200000 * $cashLogVina['200000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogVina['500000'])): ?>
                                    <tr>
                                        <td style="width:25%">500k</td>
                                        <td style="width:25%"><?= $cashLogVina['500000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(500000 * $cashLogVina['500000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= isset($totalVina[1]) ? number_format($totalVina[1]) : 0 ?></b></td>
                                        <td><b class="sumvalue"><?= isset($totalVina[0]) ? number_format($totalVina[0]) : 0 ?></b></td>
                                    </tr>
                                </table> <hr />
                                <p class="text-danger"><b>THẺ MOBI</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại thẻ</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php if (isset($totalMobi)): ?>
                                    <?php if (isset($cashLogMobi['10000'])): ?>
                                    <tr>
                                        <td style="width:25%">10k</td>
                                        <td style="width:25%"><?= $cashLogMobi['10000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(10000 * $cashLogMobi['10000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogMobi['20000'])): ?>
                                    <tr>
                                        <td style="width:25%">20k</td>
                                        <td style="width:25%"><?= $cashLogMobi['20000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(20000 * $cashLogMobi['20000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogMobi['50000'])): ?>
                                    <tr>
                                        <td style="width:25%">50k</td>
                                        <td style="width:25%"><?= $cashLogMobi['50000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(50000 * $cashLogMobi['50000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogMobi['100000'])): ?>
                                    <tr>
                                        <td style="width:25%">100k</td>
                                        <td style="width:25%"><?= $cashLogMobi['100000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(100000 * $cashLogMobi['100000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogMobi['200000'])): ?>
                                    <tr>
                                        <td style="width:25%">200k</td>
                                        <td style="width:25%"><?= $cashLogMobi['200000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(200000 * $cashLogMobi['200000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogMobi['500000'])): ?>
                                    <tr>
                                        <td style="width:25%">500k</td>
                                        <td style="width:25%"><?= $cashLogMobi['500000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(500000 * $cashLogMobi['500000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= isset($totalMobi[1]) ? number_format($totalMobi[1]) : 0 ?></b></td>
                                        <td><b class="sumvalue"><?= isset($totalMobi[0]) ? number_format($totalMobi[0]) : 0 ?></b></td>
                                    </tr>
                                </table> <hr />
                                <p class="text-danger"><b>THẺ VIETTEL</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại thẻ</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php if (isset($totalViettel)): ?>
                                    <?php if (isset($cashLogViettel['10000'])): ?>
                                    <tr>
                                        <td style="width:25%">10k</td>
                                        <td style="width:25%"><?= $cashLogViettel['10000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(10000 * $cashLogViettel['10000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogViettel['20000'])): ?>
                                    <tr>
                                        <td style="width:25%">20k</td>
                                        <td style="width:25%"><?= $cashLogViettel['20000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(20000 * $cashLogViettel['20000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogViettel['50000'])): ?>
                                    <tr>
                                        <td style="width:25%">50k</td>
                                        <td style="width:25%"><?= $cashLogViettel['50000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(50000 * $cashLogViettel['50000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogViettel['100000'])): ?>
                                    <tr>
                                        <td style="width:25%">100k</td>
                                        <td style="width:25%"><?= $cashLogViettel['100000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(100000 * $cashLogViettel['100000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogViettel['200000'])): ?>
                                    <tr>
                                        <td style="width:25%">200k</td>
                                        <td style="width:25%"><?= $cashLogViettel['200000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(200000 * $cashLogViettel['200000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if (isset($cashLogViettel['500000'])): ?>
                                    <tr>
                                        <td style="width:25%">500k</td>
                                        <td style="width:25%"><?= $cashLogViettel['500000']['Quantity'] ?></td>
                                        <td style="width:25%"><?= number_format(500000 * $cashLogViettel['500000']['Quantity']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= isset($totalViettel[1]) ? number_format($totalViettel[1]) : 0 ?></b></td>
                                        <td><b class="sumvalue"><?= isset($totalViettel[0]) ? number_format($totalViettel[0]) : 0 ?></b></td>
                                    </tr>
                                </table>


                                <p class="text-danger"><b>THẺ GATE</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại thẻ</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php if (isset($totalGate)): ?>
                                        <?php if (isset($cashLogGate['10000'])): ?>
                                            <tr>
                                                <td style="width:25%">10k</td>
                                                <td style="width:25%"><?= $cashLogGate['10000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(10000 * $cashLogGate['10000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogGate['20000'])): ?>
                                            <tr>
                                                <td style="width:25%">20k</td>
                                                <td style="width:25%"><?= $cashLogGate['20000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(20000 * $cashLogGate['20000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogGate['50000'])): ?>
                                            <tr>
                                                <td style="width:25%">50k</td>
                                                <td style="width:25%"><?= $cashLogGate['50000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(50000 * $cashLogGate['50000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogGate['100000'])): ?>
                                            <tr>
                                                <td style="width:25%">100k</td>
                                                <td style="width:25%"><?= $cashLogGate['100000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(100000 * $cashLogGate['100000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogGate['200000'])): ?>
                                            <tr>
                                                <td style="width:25%">200k</td>
                                                <td style="width:25%"><?= $cashLogGate['200000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(200000 * $cashLogGate['200000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogGate['500000'])): ?>
                                            <tr>
                                                <td style="width:25%">500k</td>
                                                <td style="width:25%"><?= $cashLogGate['500000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(500000 * $cashLogGate['500000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= isset($totalGate[1]) ? number_format($totalGate[1]) : 0 ?></b></td>
                                        <td><b class="sumvalue"><?= isset($totalGate[0]) ? number_format($totalGate[0]) : 0 ?></b></td>
                                    </tr>
                                </table> <hr />

                                <p class="text-danger"><b>THẺ ZING</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại thẻ</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php if (isset($totalZing)): ?>
                                        <?php if (isset($cashLogZing['10000'])): ?>
                                            <tr>
                                                <td style="width:25%">10k</td>
                                                <td style="width:25%"><?= $cashLogZing['10000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(10000 * $cashLogZing['10000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogZing['20000'])): ?>
                                            <tr>
                                                <td style="width:25%">20k</td>
                                                <td style="width:25%"><?= $cashLogZing['20000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(20000 * $cashLogZing['20000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogZing['50000'])): ?>
                                            <tr>
                                                <td style="width:25%">50k</td>
                                                <td style="width:25%"><?= $cashLogZing['50000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(50000 * $cashLogZing['50000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogZing['100000'])): ?>
                                            <tr>
                                                <td style="width:25%">100k</td>
                                                <td style="width:25%"><?= $cashLogZing['100000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(100000 * $cashLogZing['100000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogZing['200000'])): ?>
                                            <tr>
                                                <td style="width:25%">200k</td>
                                                <td style="width:25%"><?= $cashLogZing['200000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(200000 * $cashLogZing['200000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogZing['500000'])): ?>
                                            <tr>
                                                <td style="width:25%">500k</td>
                                                <td style="width:25%"><?= $cashLogZing['500000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(500000 * $cashLogZing['500000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= isset($totalZing[1]) ? number_format($totalZing[1]) : 0 ?></b></td>
                                        <td><b class="sumvalue"><?= isset($totalZing[0]) ? number_format($totalZing[0]) : 0 ?></b></td>
                                    </tr>
                                </table> <hr />

                                <p class="text-danger"><b>THẺ ONCASH</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại thẻ</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php if (isset($totalOnCash)): ?>
                                        <?php if (isset($cashLogOnCash['10000'])): ?>
                                            <tr>
                                                <td style="width:25%">10k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['10000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(10000 * $cashLogOnCash['10000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['20000'])): ?>
                                            <tr>
                                                <td style="width:25%">20k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['20000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(20000 * $cashLogOnCash['20000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['50000'])): ?>
                                            <tr>
                                                <td style="width:25%">50k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['50000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(50000 * $cashLogOnCash['50000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['100000'])): ?>
                                            <tr>
                                                <td style="width:25%">100k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['100000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(100000 * $cashLogOnCash['100000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['200000'])): ?>
                                            <tr>
                                                <td style="width:25%">200k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['200000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(200000 * $cashLogOnCash['200000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['500000'])): ?>
                                            <tr>
                                                <td style="width:25%">500k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['500000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(500000 * $cashLogOnCash['500000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= isset($totalOnCash[1]) ? number_format($totalOnCash[1]) : 0 ?></b></td>
                                        <td><b class="sumvalue"><?= isset($totalOnCash[0]) ? number_format($totalOnCash[0]) : 0 ?></b></td>
                                    </tr>
                                </table> <hr />

                                <p class="text-danger"><b>THẺ MEGA</b></p>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Loại thẻ</th>
                                        <th>Giao dịch</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                    <?php if (isset($totalMega)): ?>
                                        <?php if (isset($cashLogOnCash['10000'])): ?>
                                            <tr>
                                                <td style="width:25%">10k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['10000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(10000 * $cashLogOnCash['10000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['20000'])): ?>
                                            <tr>
                                                <td style="width:25%">20k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['20000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(20000 * $cashLogOnCash['20000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['50000'])): ?>
                                            <tr>
                                                <td style="width:25%">50k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['50000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(50000 * $cashLogOnCash['50000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['100000'])): ?>
                                            <tr>
                                                <td style="width:25%">100k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['100000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(100000 * $cashLogOnCash['100000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['200000'])): ?>
                                            <tr>
                                                <td style="width:25%">200k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['200000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(200000 * $cashLogOnCash['200000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (isset($cashLogOnCash['500000'])): ?>
                                            <tr>
                                                <td style="width:25%">500k</td>
                                                <td style="width:25%"><?= $cashLogOnCash['500000']['Quantity'] ?></td>
                                                <td style="width:25%"><?= number_format(500000 * $cashLogOnCash['500000']['Quantity']); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td><b>TỔNG CỘNG</b></td>
                                        <td><b class="sumvalue"><?= isset($totalMega[1]) ? number_format($totalMega[1]) : 0 ?></b></td>
                                        <td><b class="sumvalue"><?= isset($totalMega[0]) ? number_format($totalMega[0]) : 0 ?></b></td>
                                    </tr>
                                </table> <hr />


                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php $this->load->view('Admin/footer') ?>
