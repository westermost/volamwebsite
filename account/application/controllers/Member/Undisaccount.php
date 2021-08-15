<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Undisaccount extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        // Check user is Login
        if ($this->isLogin() === false)
        {
            $this->authRedirect('Login');
        }
    }

    public function index()
    {
        // Get acct_id from session
        $acct_id = $this->userInfo['cAccName'];
        // Load Model
        $this->load->model('Account_model', 'Account');
        // Get Account Info
        $data['AccountInfo'] = $this->Account->getAccountInfo($acct_id);

        // giải kẹt
        $flg = $this->Account->getUnDisAccount($acct_id);

        if($flg == true)
        {
            $data["active"] = "success";
        }
        else
        {
            $data["active"] = "fail";
        }

        $data['template'] = array(
            'title' => 'Hồ Sơ',
            'activeSide' => 'profile',
        );

        //  Load View
        $this->load->view('Member/undisaccount_view', $data);
    }
}