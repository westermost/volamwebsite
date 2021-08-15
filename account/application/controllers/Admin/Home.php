<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
       if ($this->isAdminLogin() !== false)
       {
           redirect(base_url('Admin/Config'));
       }
    }

    public function index()
    {
        if ($this->getPost('UserName') && $this->getPost('Password'))
        {
            // Get data from request
            $username = $this->getPost('UserName');
            $password = $this->getPost('Password');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('UserName', 'Tài khoản', 'required|min_length[3]|digitsLetters');
            $this->form_validation->set_rules('Password', 'Mật khẩu', 'required|min_length[6]');

            if ($this->form_validation->run() == TRUE)
            {
                // Hash password
                $password = strtoupper(md5($password));

                /* Check user login */
                $this->load->model('Account_model', 'Account');
                $user = $this->Account->getAdminAuth($username, $password);
                if (empty($user) === false && count($user) > 0)
                {
                    // Check remember
                    $rememberMe = (int) $this->getPost('RememberMe');
                    if ($rememberMe >= 1)
                    {
                       $this->session->set_userdata('authAdmin', json_encode($user));
                    }
                    elseif ($rememberMe == 0)
                    {
                        $_SESSION['authAdmin'] = json_encode($user);
                    }

                    $result = array(
                        'Code' => 0,
                        'ReturnUrl' => base_url() . 'Admin/config',
                    );
                }
                else
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Đăng nhập thất bại, hãy kiểm tra Tài khoản và Mật khẩu.'
                    );
                }

                header('Content-Type: application/json');
                echo json_encode($result);
            }
            return;
        }

        $data['template'] = array(
            'title' => 'Đăng nhập',
            'formName' => 'formLogin',
        );
        // Load view
        $this->load->view('Admin/login_view', $data);
//        redirect(base_url('Admin/Config'));
    }
}
