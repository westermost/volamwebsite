<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckUserName extends Base_Controller
{
    public function index()
    {
        $this->load->model('Account_model', 'Account');
        if ($this->getPost('username'))
        {
            $userName = $this->getPost('username');
            $user = $this->Account->getUserName($userName);
            if (empty($user) && count($user) <= 0)
            {
                echo json_encode(true);
                return true;
            }
            else
            {
                echo json_encode(false);
                return false;
            }
        }
        return;
    }
}
