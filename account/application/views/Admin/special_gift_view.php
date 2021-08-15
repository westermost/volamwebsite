<?php $this->load->view('Admin/header') ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-10">
                    <h2><?= $template['title'] ?></h2>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="wrapper wrapper-content">
                <?php if ($this->session->flashdata('informMsg')): ?>
                <?php $informMsg = $this->session->flashdata('informMsg'); ?>
                <div class="alert alert-<?= $informMsg['type'] == 'success' ? $informMsg['type'] : 'danger' ?>" role="alert">
                <?= $informMsg['message']; ?>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-lg-12">
                      <form action="<?= base_url('Admin/SpecialGift') ?>" autocomplete="off" class="form-horizontal" id="frmSpecialGift" method="post">
                          <div id="formMessage" class="alert alert-danger hidden"></div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label" for="cbxEnable">Kích hoạt</label>
                              <div class="col-sm-6">
                                  <input style="margin-top: 10px" type="checkbox" id="cbxEnable" name="cbxEnable" <?= SG_ENABLE == true ? 'checked' : '' ?> />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label" for="calendar">Ngày hoạt động</label>
                              <div class="col-sm-6">
                                  <input class="text-box single-line" data-val="true" data-val-date="Ngày hoạt động phải là ngày tháng." id="BeginDate" name="BeginDate" readonly="true" style="background-color: #eee; cursor: not-allowed;" type="datetime" value="<?= SG_CALENDAR == '' ? date('Y-m-d') : date('Y-m-d', strtotime(SG_CALENDAR)) ?>" disabled />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label" for="ItemID">ID vật phẩm</label>
                              <div class="col-sm-6">
                                  <input class="form-control" data-val="true" data-val-required="ID vật phẩm không được để trống" id="ItemID" name="ItemID" value="<?= SG_ITEMID ?>" type="number" disabled />
                              </div>
                          </div>
                          <div class="form-group has-feedback">
                              <label class="col-sm-3 control-label" for="ItemName">Tên vật phẩm</label>
                              <div class="col-sm-6">
                                  <input class="form-control" data-val="true" data-val-required="Tên vật phẩm không được để trống" id="ItemName" name="ItemName" placeholder="Tên vật phẩm" type="text" value="<?= SG_ITEMNAME ?>" disabled />
                              </div>
                          </div>

                          <div class="form-group has-feedback">
                              <label class="col-sm-3 control-label" for="ChargeRate">Tỉ lệ quy đổi</label>
                              <div class="col-sm-6">
                                  <input class="form-control" data-val="true" data-val-required="Tỉ lệ quy đổi không được để trống" id="ChargeRate" name="ChargeRate" placeholder="Tỉ lệ quy đổi" type="text" value="<?= SG_RATE ?>" />
                              </div>
                          </div>
                          <div class="form-group has-feedback">
                              <label class="col-sm-3 control-label" for="ChargeRate">Số lượng Record</label>
                              <div class="col-sm-6">
                                  <input class="form-control" data-val="true" data-val-required="Số lượng Record không được để trống" id="RecordRate" name="RecordRate" placeholder="RecordRate" type="number" min="1" value="<?= RECORD_RATE ?>" />
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-6 text-center">
                                  <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                  <img id="submitWait" style="display:none" src="/Assets/img/loading6.gif" />
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
<script>
  $(document).ready(function(){
    var cbxEnable = <?= SG_ENABLE == true ? 'true' : 'false' ?>;
    if (cbxEnable == true)
    {
        $('#BeginDate').removeAttr('disabled');
        $('#BeginDate').removeAttr('style');
        $('#ItemID').removeAttr('disabled');
        $('#ItemName').removeAttr('disabled');
        $('#ItemType').removeAttr('disabled');
    }
    $('#cbxEnable').on('change', function(){
        if (this.checked) {
            $('#BeginDate').removeAttr('disabled');
            $('#BeginDate').removeAttr('style');
            $('#ItemID').removeAttr('disabled');
            $('#ItemName').removeAttr('disabled');
            $('#ItemType').removeAttr('disabled');
        } else {
            $('#BeginDate').attr('disabled', true);
            $('#BeginDate').css('background-color', '#eee');
            $('#BeginDate').css('cursor', 'not-allowed');
            $('#ItemID').attr('disabled', true);
            $('#ItemName').attr('disabled', true);
            $('#ItemType').attr('disabled', true);
        }
    });
  });
</script>
<?php $this->load->view('Admin/footer') ?>
