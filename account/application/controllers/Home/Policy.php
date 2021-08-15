<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends Base_Controller
{
    public function index()
    {
        $data['template'] = array(
            'title' => 'Chính sách bảo mật',
        );
        $this->load->view('Home/policy_view', $data);
    }
}
