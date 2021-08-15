<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class CashLog extends Base_Controller
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
        $this->load->model('Log_model', 'Log');
        $data['CashLogs'] = $this->Log->getCashLogList();

        $count = count($data['CashLogs']);
        for($i = 0; $i < $count; $i++)
        {
            // format ngày về định dạng VN.
            $data['CashLogs'][$i]["DateCreated"] = date("d-m-Y H:m", strtotime($data['CashLogs'][$i]["DateCreated"]));
        }

        $data['SortByDate'] = 4; // Sort theo cột thứ bao nhiêu từ 0 -> n
        $data['template'] = array(
            'title' => 'Log nạp tiền',
            'useDataTable' => true
        );
        // Load view
        $this->load->view('Admin/cash_log_view', $data);
    }
}
