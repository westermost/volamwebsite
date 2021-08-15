<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChargeLog extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->isLogin() === false)
        {
            $this->authRedirect('Login');
        }
    }
    public function index()
    {
//        // Get acct_id from session
////        $acct_id = $this->userInfo['acct_id'];
////        // Load Model xử lý
////        $this->load->model('Log_model', 'Log');
////        //Get Log nạp thẻ
////        $data['LogCard'] = $this->Log->getCashLog($acct_id);

        $data['template'] = array(
            'title' => 'Lịch sử nạp thẻ',
            'activeSide' => 'chargeLog',
        );
        // Load View
        $this->load->view('Cash/charge_log_view', $data);
    }
}
