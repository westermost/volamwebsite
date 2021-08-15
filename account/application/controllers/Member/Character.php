<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Character extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Check user is Login
        if ($this->isLogin() === false)
        {
            $this->authRedirect('Login');
        }
    }

    /**
     * Main execute function
     */
    public function index()
    {
        // Get acct_id from session
        $acct_id = $this->userInfo['cAccName'];
        // Load Model
        $this->load->model('Account_model', 'Account');
        // Get Account Info
        $data['AccountInfo'] = $this->Account->getAccountInfo($acct_id);

        // Get ngày hết hạn
        $data['EndDate'] = $this->Account->getDateEndInfo($acct_id);

        // format ngày về định dạng VN.
        $data['EndDate']["dEndDate"] = date("d-m-Y H:m", strtotime( $data['EndDate']["dEndDate"]));

        $data['template'] = array(
            'title' => 'Nhân vật',
            'activeSide' => 'character',
        );
        // LOAD VIEW
        $this->load->view('Member/character_view', $data);
    }
}
