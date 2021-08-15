<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Base_Controller
{
    public function index()
    {
        redirect(base_url('Member'));
    }
}
