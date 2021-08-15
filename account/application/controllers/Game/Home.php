<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
//        if ($this->isLogin() === false)
////        {
////            $url = 'Login?ReturnUrl=Game';
////            $this->authRedirect($url);
////        }
    }

    public function index()
    {
        $data['template'] = array(
            'title' => 'Hoạt động in-game',
            'activeSide' => 'home'
        );
        $this->load->view('Game/home_view', $data);
    }
}
