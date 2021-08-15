<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class WeeklyCCU extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->isAdminLogin() === false)
        {
            redirect(base_url('admincp'));
        }
    }

    public function index()
    {
        // Chuyển timezone về Việt Nam
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Load model Log
        $this->load->model('Log_model', 'Log');

        // Log được show đã là mới nhất chưa
        $isLastestLog   = true;
        $isOldestLog    = false;

        if ($this->getQuery('ReportDate'))
        {
            $ReportDate = $this->getQuery('ReportDate');

            // Kiểm tra ngày truyền vào có phải là ngày hợp lệ không
            $validDateVal = explode('-', $ReportDate);
            if (checkdate($validDateVal[1], $validDateVal[2], $validDateVal[0]) == false)
            {
                redirect(base_url('Admin/Reports/WeeklyCCU'));
            }

            // Lấy ngày ghi log cũ nhất
            $oldestLog = $this->Log->getLastestLog();

            // Kiểm tra có phải là tuần ghi log cuối cùng rồi không
            if (date('W', strtotime($oldestLog)) == date('W', strtotime($ReportDate)) && date('Y', strtotime($oldestLog)) == date('Y', strtotime($ReportDate)))
            {
                $isOldestLog = true;
            }

            // Kiểm tra có phải là tuần ghi log mới nhất hay không
            if (date('W') != date('W', strtotime($ReportDate)) && date('Y') == date('Y', strtotime($ReportDate)))
            {
                $isLastestLog = false;
            }
            // Lấy ra ngày đầu và cuối của tuần nhận được từ query string
            $dateWeek = weekStartEndByDate($ReportDate, 'Y-m-d');
        }
        else
        {
            // Lấy ra ngày đầu và cuối của tuần hiện tại
            $dateWeek = weekStartEndByDate(date('Y-m-d'), 'Y-m-d');
        }

        $startWeekDate  = $dateWeek['first_day_of_week'];
        $endWeekDate    = $dateWeek['last_day_of_week'];

        // Lấy tuần mới hơn, cũ hơn
        $newerWeekDate = str_replace('-', '/', $endWeekDate);
        $newerWeekDate = date('Y-m-d',strtotime($newerWeekDate . "+1 days"));

        $olderWeekDate = str_replace('-', '/', $startWeekDate);
        $olderWeekDate = date('Y-m-d',strtotime($olderWeekDate . "-2 days"));

        // Get logs CCU của tuần
        $dataLog = $this->Log->getWeeklyCCU($startWeekDate, $endWeekDate);

        $data['template'] = array(
            'title' => 'Weekly CCU',
        );
        $data['dataLog']        = $dataLog;
        $data['isLastestLog']   = $isLastestLog;
        $data['isOldestLog']    = $isOldestLog;
        $data['olderWeekDate']  = $olderWeekDate;
        $data['newerWeekDate']  = $newerWeekDate;

        // Load view
        $this->load->view('Admin/Reports/CCU_view', $data);
    }

}
