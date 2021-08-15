<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberVIP extends Base_Controller
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
        $this->load->model('Account_model', 'Account');
        $data['MemberList'] = $this->Account->getAccountInfo_VIP();
        $data['SortByCard'] = 5;

        $data['template'] = array(
            'title' => 'Vip Members',
            'useDataTable' => true
        );
        // Load view
        $this->load->view('Admin/member_vip_view', $data);
    }
}