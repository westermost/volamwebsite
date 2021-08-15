<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller {

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
        $this->load->model('Account_model', 'Account');

        // Lấy ra thông tin thành viên
        $userInfo = $this->Account->getAccountInfo($this->userInfo['cAccName']);

        $accountStatus = 'locked';
        if ((empty($userInfo['cEMail']) && mb_strlen($userInfo['cEMail']) <= 0) || mb_strlen($userInfo['active_key'] > 0))
        {
            $accountStatus = 'notVerify';
        }
        elseif (empty($userInfo['unlock']) == false && mb_strlen($userInfo['unlock']) > 0)
        {
            $accountStatus = 'safety';
        }

        $data['accountStatus'] = $accountStatus;
//        $data['accountStatus'] = "safety";
        $data['template'] = array(
            'title' => 'Quản lý tài khoản',
            'activeSide' => 'home',
        );

        $this->load->view('Member/home_view', $data);
    }


}
