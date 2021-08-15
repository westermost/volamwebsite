<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPass extends Base_Controller
{
    public function index()
    {
        if ($this->getPost('UserName'))
        {
            $username = $this->getPost('UserName');

            $this->load->library('form_validation');
            $this->form_validation->set_rules('UserName', 'Tài khoản', 'required|min_length[3]|digitsLetters');
            $this->form_validation->set_rules('captcha', 'Hình kiểm chứng', 'required|min_length[5]|validCaptcha');

            if ($this->form_validation->run() == TRUE)
            {
                // Load model
                $this->load->model('Account_model', 'Account');

                $userEmail = $this->Account->getEmail($username);
                if (isset($userEmail['useremail']) == true && mb_strlen($userEmail['useremail']) >= 0)
                {
                    // Load email library
                    $this->load->library('email');
                    // Get email config
                    $config = mail_config();
                    // Init email object
                    $this->email->initialize($config);
                    // Config mail to send
                    $this->email->from(MAIL_SMTP_USER, APP_NAME);
                    $this->email->to($userEmail['useremail']);
                    $this->email->subject('Thay đổi mật khẩu');

                    // Tạo token
                    $token = active_key();
                    $username = trim($userEmail['loginName']);
                    // Update token vào database
                    $tokenFlg = $this->Account->updateToken($userEmail['acct_id'], $token);
                    if ($tokenFlg === false)
                    {
                        $result = array(
                            'Code' => -1,
                            'Message' => 'Thao tác thất bại. Vui lòng thử lại hoặc liên hệ CSKH'
                        );
                        return $this->returnJson($result);
                    }

                    $url = base_url('Account/ResetPass') . '?username=' . urlencode($username) . '&code=' . urlencode($token);
                    $message = $this->_getEmailTemplate($username, $url);
                    $this->email->message($message);

                    // Start send mail

                    if ($this->email->send() == false)
                    {
                        $result = array(
                            'Code' => -1,
                            'Message' => 'Gửi mail thất bại. Vui lòng thử lại hoặc liên hệ CSKH'
                        );
                    }
                    else
                    {
                        $result = $this->_getHTMLSuccess($userEmail);
                    }
                    return $this->returnJson($result);
                }
                else
                {
                    // Email is not exist
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Thao tác thất bại! Tài khoản chưa xác thực Email.'
                    );
                }
            }
            else
            {
                // Validate form error
                $errors = $this->form_validation->error_array();
                $dispError = array_values($array)[0];

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
            'title' => 'Quên mật khẩu',
            'formName' => 'formForgotPass'
        );
        $this->load->view('Account/forgot_pass_view', $data);
    }


    private function _getHTMLSuccess($userEmail)
    {
    	return '<div id="modalContent" class="modal-content">
	                        <div class="modal-header">
	                            <button class="close" data-dismiss="modal"><span>×</span></button>
	                            <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Thành công</h4>
	                        </div>
	                        <div class="modal-body">
	                            <div class="text-center">
	                                <div class="alert alert-success">
	                                    Hệ thống đã gửi email đến địa chỉ <b>****' . substr($userEmail['useremail'], 4) . '</b>.<br>Hãy kiểm tra hộp mail để thực hiện bước tiếp theo.<br>
	                                </div>
	                                <hr>
	                                 <p>
	                                    <a href="/" class="btn btn-info"><i class="fa fa-home"></i> Trang chủ</a>
	                                    <a href="'. base_url('Login') .'" class="btn btn-success"><i class="fa fa-lock"></i> Đăng nhập</a>
	                                 </p>
	                             </div>
	                         </div>
                        </div>';
    }

    private function _getEmailTemplate($username, $url)
    {
    	$this->load->library('T_MailTemplateParser');
    	$fileMailTemplate = PUBLIC_DIR . 'mail/forget_mail.txt';
    	$mailTemplate = new T_MailTemplateParser();
    	$mailTemplate->username = $username;
    	$mailTemplate->url      = $url;
    	$message = $mailTemplate->parse($fileMailTemplate);

    	return $message;
    }
}
