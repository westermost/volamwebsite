<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <div class="page-block center-block">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Error 404<span class="text-default">!!!</span></h2>
                                <h4>Tài liệu bạn cần không tồn tại trên hệ thống.</h4>
                                <hr />
                                <form class="form-inline" role="form">
                                    <div class="form-group">
                                        <input class="form-control" style="width: 320px" id="search" placeholder="Tìm kiếm...">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                                <hr />
                                <div class="horizontal-links">
                                    <h5>Hoặc truy cập vào các mục sau đây</h5>
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="#"><i class="fa fa-user"></i> Tài khoản</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-usd"></i> Thanh toán</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-gamepad"></i> Hoạt động</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-question-circle"></i> Hỏi đáp</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
