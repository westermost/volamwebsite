<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPass extends Base_Controller
{
    public function index()
    {

        if ($this->getPost('Password') && $this->getPost('ConfirmPassword') && $this->getPost('captcha'))
        {

            $userName   = $this->getPost('UserName');
            $code       = $this->getPost('Code');
            $password   = $this->getPost('Password');
            $confPass   = $this->getPost('ConfirmPassword');
            $captcha    = $this->getPost('captcha');

            if (mb_strlen($userName) <= 0 || mb_strlen($code) <= 0)
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Không thể đặt lại mật khẩu, xin kiểm tra và thử lại sau.'
                );
                return $this->returnJson($result);
            }

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('ConfirmPassword', 'Mật khẩu xác nhận', 'required|min_length[6]|matches[Password]');
            $this->form_validation->set_rules('captcha', 'Hình kiểm chứng', 'required|min_length[5]|validCaptcha');

            if ($this->form_validation->run() == TRUE)
            {
                $this->load->model('Account_model', 'Account');

                // Check username and token code
                $checkFlg = $this->Account->checkResetPassword($userName, $code);
                if ($checkFlg === false)
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Không thể đặt lại mật khẩu, xin kiểm tra và thử lại sau.'
                    );
                    return $this->returnJson($result);
                }

                // Hash password
                $newPassword = $this->hashPassword($password);
                $changepassFlg = $this->Account->changePassword($checkFlg['acct_id'], $newPassword, $code);
                $this->Account->updateToken($checkFlg['acct_id'], null);
                if($changepassFlg == TRUE)
                {
                    session_destroy();
                    $result = $this->_getHTMLSuccess();
                }
                else
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Không thể đặt lại mật khẩu, xin kiểm tra và thử lại sau.'
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
            return $this->returnJson($result);
        }

        $userName = $this->getQuery('username');
        $code     = $this->getQuery('code');

        $data['userName'] = $userName;
        $data['code']     = $code;
        // Load view
        $data['template'] = array(
            'title' => 'Đặt lại mật khẩu',
            'formName' => 'formResetPass'
        );
        $this->load->view('Account/reset_pass_view', $data);
    }

    private function _getHTMLSuccess()
    {
        return '<div id="modalContent" class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal"><span>×</span></button>
                        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Thành công</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="alert alert-success">
                                Thiết lập mật khẩu thành công, hãy chọn ĐĂNG NHẬP để tiếp tục.
                            </div>
                            <hr>
                            <p>
                                <a href="/" class="btn btn-info"><i class="fa fa-home"></i> Trang chủ</a>
                                <a href="' . base_url('Login') .'" class="btn btn-success"><i class="fa fa-lock"></i> Đăng nhập</a>
                            </p>
                        </div>
                    </div>
                </div>';
    }
}
