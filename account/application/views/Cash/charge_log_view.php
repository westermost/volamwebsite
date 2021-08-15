<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <?php $this->load->view('Cash/sidebar.php'); ?>
                            <div class="col-md-9">
                                <ul class="pagination pull-right"><li class="disabled"><span>«</span></li><li class="active"><span>1</span></li><li class="disabled"><span>»</span></li></ul>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ngày giờ</th>
                                            <th>Loại thẻ</th>
                                            <th>Số seri</th>
                                            <th>Mệnh giá</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(empty($LogCard) == FALSE) {
                                        foreach ($LogCard as $info) {
                                        ?>
                                            <tr>
                                                <td><?php echo $info['DateCreated']; ?></td>
                                                <td><?php echo $info['TypeCard']; ?></td>
                                                <td><?php echo $info['SeriCard']; ?></td>
                                                <td><?php echo $info['InforCard']; ?></td>
                                                <td>
                                                    <?php
                                                        if ($info['Status'] == 1)
                                                        {
                                                            echo "Thành Công";
                                                        }
                                                        else
                                                        {
                                                            echo "Thất Bại";
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php }} ?>
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
