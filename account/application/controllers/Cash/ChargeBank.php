<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChargeBank extends Base_Controller
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
        $data['template'] = array(
            'title' => 'Chuyển Khoản Ngân Hàng',
            'activeSide' => 'chargeBank',
        );
        $this->load->view('Cash/charge_bank_view', $data);
    }
}
