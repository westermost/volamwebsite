<div id="modalContent" class="modal-content">
    <div class="modal-header">
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Mua Ngày Chơi</h4>
    </div>
    <div class="modal-body">
        <form action="<?= base_url('Member/MemberAddDay') ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
            <div id="formMessage" class="alert alert-danger hidden"></div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="sel1">Số ngày nạp:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="Cash" name="Cash">
                        <option value="7">100 Đồng - 7 Ngày</option>
                        <option value="14">200 Đồng - 14 Ngày</option>
                        <option value="40">500 Đồng - 40 Ngày</option>
                        <option value="90">1000 Đồng - 90 Ngày</option>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6 text-center">
                    <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                    <img id="submitWait" style="display:none" src="<?= public_url('images/loading6.gif') ?>" />
                </div>
            </div>
        </form>
    </div>
</div>
