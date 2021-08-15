<?php $this->load->view('Admin/header.php') ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-10">
        <h2><?= $template['title'] ?></h2>
    </div>
    <div class="col-sm-2">
    </div>
</div>
<div class="wrapper wrapper-content">
    <br /><br />
    <div class="row">
        <div class="col-md-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Last Online Time</th>
                    <th>Total Cash</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($MemberList) == false && count($MemberList) > 0): ?>
                    <?php foreach($MemberList as $item): ?>
                        <tr class="">
                            <td><?php echo $item['acct_id']; ?></td>
                            <td><?= $item['loginName'] ?></td>
                            <td><?= $item['useremail'] ?></td>
                            <td><?= $item['phone'] ?></td>
                            <td><?= $item['disconnect_time'] ?></td>
                            <td><?= $item['CountCard'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('Admin/footer') ?>
