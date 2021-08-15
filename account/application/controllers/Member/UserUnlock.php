<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserUnlock extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->isLogin() === false) {
            $this->authRedirect('Login');
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
                                    Hệ thống đã gửi email đến địa chỉ <b>****' . substr( $userEmail, 4) .'</b>.<br>Hãy kiểm tra hộp mail để thực hiện bước tiếp theo.<br>
                                </div>
                                <hr>
                                <p>
                                    <button class="btn btn-primary modal-refresh"><i class="fa fa-check"></i> Đồng ý</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>';

        return $this->returnJson($returnHTML);
    }

    private function _getEmailTemplate($loginName, $urlVerify)
    {
        $this->load->library('T_MailTemplateParser');
        $fileMailTemplate = PUBLIC_DIR . 'mail/unlock_account.txt';
        $mailTemplate = new T_MailTemplateParser();
        $mailTemplate->loginName = $loginName;
        $mailTemplate->urlVerify = $urlVerify;
        $message = $mailTemplate->parse($fileMailTemplate);

        return $message;
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('captcha', 'Hình kiểm chứng', 'required|min_length[5]|validCaptcha');

        if ($this->form_validation->run() == TRUE)
        {
            // Get acct_id from session
            $acct_id = $this->userInfo['cAccName'];
            // Load model
            $this->load->model('Account_model', 'Account');
            // Get Account Info
            $userInfo = $this->Account->getAccountInfo($acct_id);

            if(empty($userInfo['cEMail']) == FALSE && strlen($userInfo['unlock']) > 0 && $userInfo['active_key'] == NULL)
            {
                // Gửi mail kích hoạt
                $this->load->library('email');
                // Get email config
                $config = mail_config();
                // Init email object
                $this->email->initialize($config);
                // Config mail to send
                $this->email->from(MAIL_SMTP_USER, APP_NAME);
                $this->email->to($userInfo['cEMail']);
                $this->email->subject('Mở khóa tài khoản');

                $urlVerify = base_url('Account/UnLockAccount') . '/username' . urlencode(trim($this->userInfo['cAccName'])). '/verifyCode' . urlencode($userInfo['unlock']);

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

                return $this->_getHTMLSuccess($userInfo['useremail']);
            }

        }

        // Load view
        $data['template'] = array(
            'title' => 'Mở Khóa Tài Khoản',
            'formName' => 'formUnLock'
        );
        $this->load->view('Member/unlock_view', $data);
    }

}
