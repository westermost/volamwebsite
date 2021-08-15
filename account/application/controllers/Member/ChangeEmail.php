<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class ChangeEmail extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Check user is Login
        if ($this->isLogin() === false) {
            $this->authRedirect('Login');
        }
    }

    public function index()
    {
        // Get acct_id from session
        $acct_id = $this->userInfo['cAccName'];

        $this->load->model('Account_model', 'Account');
        // Get Account Info
        $userInfo = $this->Account->getAccountInfo($acct_id);

        if ($this->getPost('Email'))
        {
            $newEmail = $this->getPost('Email');
            if (filter_var($newEmail, FILTER_VALIDATE_EMAIL) === false)
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Email không đúng định dạng'
                );
                return $this->returnJson($result);
            }

            // Khi member đã kích hoạt, nhập mail cũ trùng mail mới là không hợp lệ
            if (mb_strlen($userInfo['active_key']) <= 0 && strtolower($newEmail) == strtolower($userInfo['cEMail']) )
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Email cũ và mới trùng nhau'
                );
                return $this->returnJson($result);
            }

            // Tạo active key cho member
            $activeKey = active_key();

            // Thêm mới email vào db
            $this->Account->addEmail($acct_id, $newEmail, $activeKey);

            // Gửi mail kích hoạt
            $this->load->library('email');
            // Get email config
            $config = mail_config();
            // Init email object
            $this->email->initialize($config);
            // Config mail to send
            $this->email->from(MAIL_SMTP_USER, APP_NAME);
            $this->email->to($newEmail);
            $this->email->subject('Xác thực địa chỉ Email');

            $urlVerify = base_url('Account/VerifyEmail') . '/username' . urlencode(trim($this->userInfo['cAccName'])). '/verifyCode' . urlencode($activeKey);

            $message = $this->_getEmailTemplate($this->userInfo['cAccName'], $urlVerify);
            $this->email->message($message);

            // Bắt đầu gửi mail
            if ($this->email->send() == false)
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Gửi mail thất bại. Vui lòng thử lại hoặc liên hệ CSKH'
                );
                header('Content-Type: application/json');
                echo json_encode($result);
            }

            return $this->_getHTMLSuccess($newEmail);
        }

        // Thành viên đang lock tài khoản
        if (mb_strlen($userInfo['cEMail']) > 0 && mb_strlen($userInfo['unlock']) > 0)
        {
            $this->load->view('Member/unlock_view');
        }
        else
        {
            $this->load->view('Member/change_mail_view');
        }

    }

    private function _getHTMLSuccess($userEmail)
    {
        $returnHTML = '<div id="modalDialog" class="modal-dialog" style="width: 630px;">
                    <div id="modalContent" class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal"><span>×</span></button>
                            <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Thành công</h4>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="alert alert-success">
                                    Hệ thống đã gửi email đến địa chỉ <b>****' . substr($userEmail, 4) .'</b>.<br>Hãy kiểm tra hộp mail để thực hiện bước tiếp theo.<br>
                                </div>
                                <hr>
                                <p>
                                    <button class="btn btn-primary modal-refresh"><i class="fa fa-check"></i> Đồng ý</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>';
        header('Content-Type: application/json');
        echo json_encode($returnHTML);
        // exit program
        return;
    }

    private function _getEmailTemplate($loginName, $urlVerify)
    {
        $this->load->library('T_MailTemplateParser');
        $fileMailTemplate = PUBLIC_DIR . 'mail/verify_mail.txt';
        $mailTemplate = new T_MailTemplateParser();
        $mailTemplate->loginName = $loginName;
        $mailTemplate->urlVerify = $urlVerify;
        $message = $mailTemplate->parse($fileMailTemplate);

        return $message;
    }

}
