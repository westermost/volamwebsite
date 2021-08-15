<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->isLogin() !== false)
        {
            redirect(base_url('Member'));
        }
    }

    /**
     * Main execute function
     */
    public function index()
    {
        $returnUrl = $this->getQuery('ReturnUrl');
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
                // Hash password to MD5 uper key
                $password = strtoupper(md5($password));

                /* Check user login */
                $this->load->model('Account_model', 'Account');
                $user = $this->Account->getUserAuth($username, $password);

                if (empty($user) === false && count($user) > 0)
                {
                    // $user = unset($user['password_hash']);
                    // Check remember
                    $rememberMe = (int) $this->getPost('RememberMe');
                    if ($rememberMe >= 1)
                    {
                        $this->session->set_userdata('auth', json_encode($user));
                    }
                    elseif ($rememberMe == 0)
                    {
                        $_SESSION['auth'] = json_encode($user);
                    }

                    if ($this->getPost('ReturnURL') && mb_strlen($this->getPost('ReturnURL')) > 0)
                    {
                        $returnUrl = $this->getPost('ReturnURL');
                        $result = array(
                            'Code' => 0,
                            'ReturnUrl' => base_url() . $returnUrl,
                        );
                    }
                    else
                    {
                        $result = array(
                            'Code' => 0,
                            'ReturnUrl' => base_url() . 'Member',
                        );
                    }
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
        $data['returnUrl'] = $returnUrl;
        $data['template'] = array(
            'title' => 'Đăng nhập',
            'formName' => 'formLogin',
        );
        // Load view
        $this->load->view('Account/login_view', $data);
    }
}
