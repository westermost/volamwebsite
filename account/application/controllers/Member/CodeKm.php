<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeKm extends Base_Controller
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

    public function index()
    {
        // Load View
        $data['template'] = array(
            'title' => 'Nhập mã code khuyến mãi',
            'formName' => 'formChangePass',
            'activeSide' => 'code',
        );

        $this->load->view('Member/code_km_view', $data);
    }
}