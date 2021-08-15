            <div class="footer">
                <div class="pull-right">
                    Võ Lâm Chí Tôn - Trang quản trị hệ thống
                </div>
                <div>
                    <strong>Copyright</strong> LongLH9
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= public_url('js/bootstrap.min.js') ?>"></script>

    <!-- Jquery Form -->
    <script src="<?= public_url('js/jquery.validate.min.js') ?>"></script>
    <script src="<?= public_url('js/jquery.form.min.js') ?>"></script>

    <!-- DataTables JavaScript -->
    <script src="<?= public_url('js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= public_url('js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?= public_url('js/dataTables.responsive.js') ?>"></script>

    <!-- Template JavaScript -->
    <script src="<?= public_url('js/inspinia.js') ?>"></script>

    <!-- Application JavaScript -->
    <script src="<?= public_url('js/admin.js') ?>"></script>

<?php  if (!empty($template['datePicker']) && $template['datePicker'] === true): ?>
<script src="<?= public_url('js/jquery.datetimepicker.min.js') ?>"></script>
    <script>
        $(document).ready(function () {
            $('#BeginDate').datetimepicker({
                format: 'Y-m-d',
                timepicker: false
            });
            $('#EndDate').datetimepicker({
                format: 'Y-m-d',
                timepicker: false
            });
        });
    </script>
<?php endif; ?>

    <?php  if (!empty($template['useDataTable']) && $template['useDataTable'] === true): ?>
        <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                "order": [[ <?php
                            if(isset($SortByCard) == TRUE) {
                                echo $SortByCard;
                            }
                            elseif (isset($SortByDate) == TRUE){
                                echo $SortByDate;
                            }else{
                                echo 0;
                            }

                    ?>, "desc" ]],
                "language": {
                    "lengthMenu": "Hiển thị  _MENU_",
                    "zeroRecords": "Không có dữ liệu phù hợp với giá trị cần tìm",
                    "info": "Trang _PAGE_ / _PAGES_",
                    "search": "Tìm kiếm: ",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": ""
                },
            });
        });
        </script>
    <?php endif; ?>
</body>
</html>
