<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication
{
    public $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function check()
    {
        $remember = 0;
        if (isset($_SESSION['auth']) && empty($_SESSION['auth']) == false)
        {
            $authentication = $_SESSION['auth'];
        }
        else
        {
            $remember = 1;
            $authentication = $this->CI->session->userdata('auth');
        }

        if (isset($authentication) == false || empty($authentication))
        {
            return NULL;
        }

        $authentication = json_decode($authentication, TRUE);
        $this->CI->load->model('Account_model', 'Account');
        $user = $this->CI->Account->getUserAuth($authentication['cAccName'], $authentication['cPassWord']);

        if (isset($user) == false || count($user) <= 0)
        {
            if ($remember == 0)
            {
                unset($_SESSION['auth']);
            }
            else
            {
                $this->CI->session->unset_userdata('auth');
            }
            return NULL;
        }

        return $user;
    }

    public function checkAdmin()
    {
        $remember = 0;
        if (isset($_SESSION['authAdmin']) && empty($_SESSION['authAdmin']) == false)
        {
            $authentication = $_SESSION['authAdmin'];
        }
        else
        {
            $remember = 1;
            $authentication = $this->CI->session->userdata('authAdmin');
        }

        if (isset($authentication) == false || empty($authentication))
        {
            return NULL;
        }

        $authentication = json_decode($authentication, TRUE);
        $this->CI->load->model('Account_model', 'Account');
        $user = $this->CI->Account->getAdminAuth($authentication['Username'], $authentication['Password']);

        if (isset($user) == false || count($user) <= 0)
        {
            if ($remember == 0)
            {
                unset($_SESSION['authAdmin']);
            }
            else
            {
                $this->CI->session->unset_userdata('authAdmin');
            }
            return NULL;
        }

        return $user;
    }
}
