<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserLockNow extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->isLogin() === false) {
            $this->authRedirect('Login');
        }
    }

    private function _getHTMLSuccess()
    {

        $returnHTML = '
                <div id="modalContent" class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal"><span>×</span></button>
                        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Thành công</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="alert alert-success">
                                Tài khoản đã chuyển sang chế độ Khóa An Toàn.
                            </div>
                            <hr>
                            <p>
                                <button class="btn btn-primary modal-refresh"><i class="fa fa-check"></i> Đồng ý</button>
                            </p>
                        </div>
                    </div>
                </div>
            ';

        return $this->returnJson($returnHTML);
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

            // Tạo unLock key cho member
            $unLockKey = active_key();

            // Khi strlen của cột unlock khác NULL tức là đang Khóa
            // Thực hiện insert unlock vào cột unlock
            $errorFlg = $this->Account->addLock($acct_id, $unLockKey);
            if($errorFlg != FALSE)
            {
                return $this->_getHTMLSuccess();
            }
            else
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Vui lòng thử lại hoặc liên hệ CSKH'
                );
                return $this->returnJson($result);
            }
        }


        // Load view
        $data['template'] = array(
            'title' => 'Khóa Tài Khoản',
            'formName' => 'formlock'
        );
        $this->load->view('Member/lock_view', $data);
    }

}
