<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Base_Controller
{
    public function index()
    {
        if ($this->getPost('UserName') && $this->getPost('Password') && $this->getPost('ConfirmPassword'))
        {
            $username       = $this->getPost('UserName');
            $password       = $this->getPost('Password');
            $confirmPass    = $this->getPost('ConfirmPassword');
            $password2      = $this->getPost('Password_2');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('UserName', 'Tài khoản', 'required|min_length[3]|is_unique[Account_Info.cAccName]|digitsLetters');
            $this->form_validation->set_rules('Password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('ConfirmPassword', 'Mật khẩu xác nhận', 'required|min_length[6]|matches[Password]');
            $this->form_validation->set_rules('captcha', 'Hình kiểm chứng', 'required|min_length[5]|validCaptcha');
            $this->form_validation->set_rules('Password_2', 'Mật Khẩu 2', 'required|min_length[6]');

            if ($this->form_validation->run() == TRUE)
            {
                $password2 = "654321";
                // Hash password
                $password  = strtoupper(md5($password));
                $password2 = strtoupper(md5($password2));

                // Insert data account
                $this->load->model('Account_model', 'Account');
                $registFlg = $this->Account->addUser($username, $password, $password2);

                if ($registFlg === true)
                {
                    // Get new account info
                    $user = $this->Account->getUserAuth($username, $password);

                    // Update new account info to session
                    $_SESSION['auth'] = json_encode($user);

                    // Gọi model Log (Quản lý giờ chơi và đồng cash)
                    $this->load->model('Log_model', 'Log');

                    // Lấy Ip đăng ký
//                    $userIp = $this->input->ip_address();

                    // Chuyển timezone về Việt Nam
                    date_default_timezone_set('Asia/Ho_Chi_Minh');

                    // Đăng ký giờ chơi lần đầu tặng 7 ngày chơi.
                    $today = date('Y-m-d H:i:s');
                    $this->Log->logRegistAccount($user['cAccName'], date('Y-m-d H:i:s', strtotime($today. ' + 7 days')));

                    $result = array(
                        'Code' => 0,
                        'ReturnUrl' => base_url() . 'Member',
                    );
                }
                else
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Có lỗi hệ thống, xin liên hệ CSKH.'
                    );
                }
            }
            else
            {
                $errors = $this->form_validation->error_array();
                $dispError = array_values($errors)[0];

                $result = array(
                    'Code' => -1,
                    'Message' => $dispError
                );
            }

            header('Content-Type: application/json');
            echo json_encode($result);
            // exit program
            return;
        }

        // Load view
        $data['template'] = array(
            'title' => 'Đăng ký',
            'formName' => 'formRegister'
        );
        $this->load->view('Account/register_view', $data);
//        redirect("http://volamchiton.info/open");
    }
}
