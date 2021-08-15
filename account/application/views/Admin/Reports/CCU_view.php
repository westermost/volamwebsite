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
            <div class="text-center">
                <?php if ($isLastestLog == false): ?>
                <a href="<?= base_url('/Admin/Reports/WeeklyCCU?ReportDate=' . $newerWeekDate) ?>"><i class="fa fa-chevron-left"></i> MỚI HƠN</a> |
                <?php endif; ?>
                <?php if ($isOldestLog == false): ?>
                <a href="<?= base_url('/Admin/Reports/WeeklyCCU?ReportDate=' . $olderWeekDate) ?>">CŨ HƠN <i class="fa fa-chevron-right"></i></a>
                <?php endif; ?>
            </div>
            <br />
            <h3>Total</h3>
            <div class="flot-chart">
                <div id="chart0" class="flot-chart-content"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?= public_url('js/flotjs.js') ?>"></script>
    <script>
        <?php
            // Chuẩn bị data show chart
            $dataChart = '';
            if ($dataLog != NULL)
            {
                foreach ($dataLog as $log)
                {
                    $dataChart .= ',[' . strtotime($log['create_time']) * 1000 . ',' . $log['player_count'] . ']';
                }
                $dataChart = substr($dataChart, 1, strlen($dataChart));
            }
        ?>
        $(document).ready(function () {
            function showFlotChart(chartid, chartdata) {
                $.plot($(chartid), [{
                    data: chartdata,
                    label: "CCU"
                }], {
                    xaxes: [{
                        mode: 'time',
                        tickSize: [12, 'hour'],
                        timeformat: "%d/%m %H:%M",
                        timezone: "browser"
                    }],
                    legend: {
                        position: 'sw'
                    },
                    colors: ["#1ab394"],
                    grid: {
                        color: "#999999",
                        hoverable: true,
                        clickable: true,
                        tickColor: "#D4D4D4",
                        borderWidth: 0,
                        hoverable: true
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "%x %s = %y",
                        xDateFormat: "%d/%m %H:%M",
                    }
                });
            }
            showFlotChart("#chart0", [<?= $dataChart ?>]);
        });
    </script>
<?php $this->load->view('Admin/footer') ?>
