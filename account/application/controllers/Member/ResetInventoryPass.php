<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetInventoryPass extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Check user is Login
        if ($this->isLogin() === false) {
            $this->authRedirect('Login');
        }
    }

    private function _getEmailTemplate($username, $newPassword)
    {
        $this->load->library('T_MailTemplateParser');
        $fileMailTemplate = PUBLIC_DIR . 'mail/forget_inventory.txt';
        $mailTemplate = new T_MailTemplateParser();
        $mailTemplate->username = $username;
        $mailTemplate->newPass = $newPassword;
        $message = $mailTemplate->parse($fileMailTemplate);

        return $message;
    }

    private function _getHTMLSuccess($userEmail)
    {
        $returnHTML = '<div id="modalContent" class="modal-content">
	                        <div class="modal-header">
	                            <button class="close" data-dismiss="modal"><span>×</span></button>
	                            <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Thành công</h4>
	                        </div>
	                        <div class="modal-body">
	                            <div class="text-center">
	                                <div class="alert alert-success">
	                                    Hệ thống đã gửi email đến địa chỉ <b>****' . substr($userEmail['useremail'], 4) . '</b>.<br>Hãy kiểm tra hộp mail để thực hiện bước tiếp theo.<br>
	                                </div>
	                             </div>
	                         </div>
                        </div>';
        header('Content-Type: application/json');
        echo json_encode($returnHTML);
        // exit program
        return;
    }

    public function index()
    {
        // Get acct_id from session
        $acct_id = $this->userInfo['acct_id'];
        // Load model
        $this->load->model('Account_model', 'Account');
        // Get Account Info
        $userInfo = $this->Account->getAccountInfo($acct_id);

        if($this->getPost('Email'))
        {
            $email = $this->getPost('Email');

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Email không đúng định dạng'
                );
                return $this->returnJson($result);
            }

            // Lấy email của user đã xác thực so sánh có đúng không
            $userEmail = $this->Account->getEmail($userInfo['loginName']);
            if (isset($userEmail['useremail']) == true && mb_strlen($userEmail['useremail']) >= 0 && $userEmail['useremail'] == $email)
            {
                // Update random password
                $randPass = rand_pass();
                $randInvHash = $this->hashPassword($randPass);
                $flg = $this->Account->updateInventoryPass($acct_id, $randInvHash);

                // Check xem đã insert pass mới thành công hay chưa
                if($flg === true)
                {
                    // Load email library
                    $this->load->library('email');
                    // Get email config
                    $config = mail_config();
                    // Init email object
                    $this->email->initialize($config);
                    // Config mail to send
                    $this->email->from(MAIL_SMTP_USER, APP_NAME);
                    $this->email->to($userEmail);
                    $this->email->subject('Thay đổi mật khẩu hòm đồ');

                    $message = $this->_getEmailTemplate($userInfo['loginName'], $randPass);
                    $this->email->message($message);

                    // Start send mail
                    if ($this->email->send() == false)
                    {
                        $result = array(
                            'Code' => -1,
                            'Message' => 'Gửi mail thất bại. Vui lòng thử lại hoặc liên hệ CSKH'
                        );
                        header('Content-Type: application/json');
                        echo json_encode($result);
                    }
                    else
                    {
                        $this->_getHTMLSuccess($userEmail);
                    }
                    return;
                }
                else
                {
                    // Update false
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Thao tác thất bại! Vui lòng thử lại.'
                    );
                }
            }
            else
            {
                // Email is not exist
                $result = array(
                    'Code' => -1,
                    'Message' => 'Thao tác thất bại! Email không chính xác'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($result);
            // exit program
            return;
        }

        // Load view
        $data['template'] = array(
            'title' => 'Quên mật khẩu hòm đồ',
            'formName' => 'formResetInvPass'
        );
        $this->load->view('Member/change_inventory_pass_view', $data);
    }

}
