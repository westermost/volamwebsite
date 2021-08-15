<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends Base_Controller
{
    public function index()
    {
        $data['template'] = array(
            'title' => 'Điều khoản dịch vụ',
        );
        $this->load->view('Home/terms_view', $data);
    }
}
