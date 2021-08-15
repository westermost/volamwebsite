<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends Base_Controller {

    public function index()
    {
        $data['template'] = array(
            'title' => 'Error 404',
        );
        $this->load->view('errors_view', $data);
    }

}
