<div class="page-block center-block">
    <h2 class="title"><i class="fa fa-user"></i> Quản l&#253; T&#224;i khoản</h2>
    <hr>
    <div class="row">
        <aside class="col-md-3 hidden-sm hidden-xs">
            <div class="sidebar">
                <div class="separator"></div>
                <div class="block clearfix">
                    <nav>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="<?= $template['activeSide'] == 'home' ? 'active' : '' ?>">
                                <a href="<?= base_url('Member') ?>"><i class="fa fa-home"></i> Home</a>
                            </li>
                            <li class="<?= $template['activeSide'] == 'profile' ? 'active' : '' ?>">
                                <a href="<?= base_url('Member/Profile') ?>"><i class="fa fa-file-text"></i> Hồ sơ</a>
                            </li>
                            <li class="<?= $template['activeSide'] == 'character' ? 'active' : '' ?>">
                                <a href="<?= base_url('Member/Character') ?>"><i class="fa fa-user-plus"></i> Nhân vật</a>
                            </li>
                            <li class="<?= $template['activeSide'] == 'code' ? 'active' : '' ?>">
                                <a href="<?= base_url('Member/CodeKm') ?>"><i class="fa fa-user-plus"></i> Nhập code</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>
