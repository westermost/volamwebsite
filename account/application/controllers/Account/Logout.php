<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Base_Controller
{

    public function index()
    {
        if (isset($this->AdminInfo) && count($this->AdminInfo) > 0)
        {
            session_destroy();
            return redirect(base_url('admincp'));
        }

        session_destroy();
        return redirect(base_url('Login'));
    }
}
