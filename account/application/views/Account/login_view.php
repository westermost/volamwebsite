<?php $this->load->view('Layouts/header.php'); ?>
	<div class="main-container">
		<div class="container" style="margin-top: 20px">
			<div class="row">
				<div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
					<div class="form-block center-block">
						<h2 class="title"><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Đăng nhập</h2>
						<hr />
						<form action="<?php echo base_url('Login'); ?>" autocomplete="off" class="form-horizontal" id="mainForm" method="post">
							<div id="formMessage" class="alert alert-danger hidden">
							<!-- Show validate message here -->
        					</div>

        					<div class="form-group has-feedback">
        						<label class="col-sm-3 control-label" for="UserName">T&#224;i khoản</label>
        						<div class="col-sm-8">
        							<input class="form-control" data-val="true" data-val-length="Tài khoản phải có tối thiểu 3 ký tự." data-val-length-max="16" data-val-length-min="3" data-val-required="Tài khoản không được để trống" id="UserName" maxlength="16" name="UserName" placeholder="User Name" type="text" value="" />
                					<i class="fa fa-user form-control-feedback"></i>
                					<input type="hidden" name="ReturnURL" value="<?= $returnUrl ?>">
        						</div>
        					</div>
        					<div class="form-group has-feedback">
					            <label class="col-sm-3 control-label" for="Password">Mật khẩu</label>
					            <div class="col-sm-8">
					                <input class="form-control" data-val="true" data-val-required="Mật khẩu không được để trống" id="Password" maxlength="60" name="Password" placeholder="Password" type="password" />
					                <i class="fa fa-lock form-control-feedback"></i>
					            </div>
					        </div>
					        <div class="form-group">
					            <div class="col-sm-offset-3 col-sm-8">
					                <div class="checkbox">
					                    <label>
					                        <input data-val="true" data-val-required="The Ghi nhớ đăng nhập field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true" /><input name="RememberMe" type="hidden" value="false" />
					                        Ghi nhớ đăng nhập
					                    </label>
					                </div>
					            </div>
					        </div>
					        <div class="form-group">
					            <div class="col-sm-offset-3 col-sm-8 text-center">
					                <button type="submit" class="btn btn-default btn-block"><i class="fa fa-lock"></i>&nbsp;&nbsp;<b>ĐĂNG NHẬP</b></button>
					                <img id="submitWait" style="display:none;" src="<?php echo public_url('images/loading6.gif') ?>" />
					            </div>
					        </div>
					        <div class="form-group">
					            <div class="col-sm-offset-3 col-sm-8 text-right">
					                <a href="<?= base_url('Register') ?>" class="btn btn-gray btn-sm" title="Đăng ký tài khoản mới">Đăng ký mới</a>
					                <a href="<?= base_url('ForgotPass') ?>" class="btn btn-gray btn-sm" title="Đặt lại mật khẩu">Quên mật khẩu?</a>
					            </div>
					        </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('Layouts/footer.php'); ?>
