<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Base_Controller
{
    const MIN_DIGIT_1 = 3;
    const MIN_DIGIT_2 = 6;
    const API_REG = 'choi68';

    public function index()
    {
        if ($this->input->method() != 'post')
        {
            return redirect(base_url('Errors'));
        }
        // Get data from request
        $username       = $this->getPost('UserName');
        $password       = $this->getPost('Password');
        $confirmPass    = $this->getPost('ConfirmPassword');

        // Execute validate
        $eRet = $this->_initValidate($username, $password, $confirmPass);
        if (!empty($eRet))
        {
            return $this->returnJson($eRet);
        }

        /* Execute register */
        // Hash password
        $password = $this->hashPassword($password);

        // Insert data
        $this->load->model('Account_model', 'Account');

        $registFlg = $this->Account->addUser($username, $password, self::API_REG);
        if ($registFlg === true)
        {
            // Get new account info
            $user = $this->Account->getUserAuth($username, $password);

            // Ghi log reg account
            $this->load->model('Log_model', 'Log');
            $userIp = $this->input->ip_address();
            // Chuyển timezone về Việt Nam
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $this->Log->logRegistAccount($user['acct_id'], $userIp, date('Y-m-d H:i:s'));

            $eRet = ['Code' => 50, 'Message' => 'Đăng ký thành công.'];
        }
        else
        {
            $eRet = ['Code' => -1, 'Message' => 'Có lỗi hệ thống, xin liên hệ CSKH.'];
        }

        return $this->returnJson($eRet);
    }

    /* Validation */
    private function _initValidate($username, $password, $confirmPass)
    {
        // Check username required
        if (mb_strlen($username) <= 0)
        {
            return ['Code' => 101, 'Message' => 'Yêu cầu nhập Tài khoản.'];
        }

        // Check password required
        if (mb_strlen($password) <= 0)
        {
            return ['Code' => 102, 'Message' => 'Yêu cầu nhập Mật khẩu.'];
        }

        // Check confirm password required
        if (mb_strlen($confirmPass) <= 0)
        {
            return ['Code' => 103, 'Message' => 'Yêu cầu nhập Mật khẩu xác nhận.'];
        }

        // Check username < 3 digit
        if (mb_strlen($username) < self::MIN_DIGIT_1)
        {
            return ['Code' => 104, 'Message' => 'Yêu cầu nhập tối thiểu '.self::MIN_DIGIT_1.' ký tự.'];
        }

        // Check password < 6 digit
        if (mb_strlen($password) < self::MIN_DIGIT_2 || mb_strlen($confirmPass) < self::MIN_DIGIT_2)
        {
            return ['Code' => 105, 'Message' => 'Yêu cầu nhập tối thiểu '.self::MIN_DIGIT_2.' ký tự.'];
        }

        // Check user is digits letters
        if (!preg_match('/^[A-Za-z][a-zA-Z0-9\._-]+$/i', $username))
        {
            return ['Code' => 106, 'Message' => 'Yêu cầu bắt đầu với chữ cái, tiếp theo là các ký tự không dấu.'];
        }

        // Check password match with confirm password
        if ($password != $confirmPass)
        {
            return ['Code' => 107, 'Message' => 'Mật khẩu xác nhận không khớp.'];
        }

        // Check username is unique
        $this->load->library('form_validation');
        $this->form_validation->set_rules('UserName', 'Tài khoản', 'is_unique[Account.loginName]');

        if ($this->form_validation->run() == FALSE)
        {
            return ['Code' => 108, 'Message' => 'Tài khoản không hợp lệ hoặc đã được sử dụng, xin chọn lại.'];
        }

        return array();
    }
}
