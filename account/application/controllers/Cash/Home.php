<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->isLogin() === false)
        {
            $url = 'Login?ReturnUrl=Cash';
            $this->authRedirect($url);
        }
    }

    public function index()
    {
        $data['template'] = array(
            'title' => 'Thanh toán',
            'activeSide' => 'home',
        );
        $this->load->view('Cash/home_view.php', $data);
    }

}
