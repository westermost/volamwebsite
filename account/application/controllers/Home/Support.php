<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends Base_Controller
{
    public function index()
    {
        $data['template'] = array(
            'title' => 'Hỏi đáp',
            'filter' => true
        );
        $this->load->view('Home/support_view', $data);
    }
}
