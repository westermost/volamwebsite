<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangePass extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Check user is Login
        if ($this->isLogin() === false)
        {
            $this->authRedirect('Login');
        }
    }

    public function index()
    {
        if($this->getPost('OldPassword') && $this->getPost('NewPassword') && $this->getPost('ConfirmPassword'))
        {
            $oldPassword        = $this->getPost('OldPassword');
            $newPassword        = $this->getPost('NewPassword');
            $confirmPassword    = $this->getPost('ConfirmPassword');

            if ($newPassword != $oldPassword && $newPassword == $confirmPassword)
            {
                // Get acct_id from session
                $acct_id = $this->userInfo['cAccName'];
                // Hash password
                $oldPassword        = strtoupper(md5($oldPassword));
                $newPassword        = strtoupper(md5($newPassword));

                // Load model
                $this->load->model('Account_model');

                // Check password correct
                $checkPass = $this->Account_model->checkPasswordCorrect($acct_id, $oldPassword);

                if($checkPass == TRUE)
                {
                    // Update password
                    $changepassFlg = $this->Account_model->changePassword($acct_id, $newPassword);
                    // Update password sucess
                    if($changepassFlg == TRUE)
                    {
                        session_destroy();
                        return $this->_getHTMLSuccess();
//                        $result = array(
//                            'Code' => 0,
//                            'ReturnUrl' => base_url() . 'Account/Login',
//                        );
                    }
                    else
                    {
                        $result = array(
                            'Code' => -1,
                            'Message' => 'Có lỗi hệ thống, xin liên hệ CSKH'
                        );
                    }
                }
                else{
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Thay đổi mật khẩu thất bại, xin kiểm tra lại mật khẩu của bạn'
                    );
                }


            }
            else
            {
                if($newPassword == $oldPassword)
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Mật khẩu mới không được trùng với mật khẩu cũ'
                    );
                }
                if($newPassword != $confirmPassword)
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Mật khẩu xác nhận không khớp'
                    );
                }

            }
            header('Content-Type: application/json');
            echo json_encode($result);
            return;
        }

        // Load View
        $data['template'] = array(
            'title' => 'Đổi Mật Khẩu',
            'formName' => 'formChangePass'
        );
        $this->load->view('Member/change_pass_view', $data);
    }

    private function _getHTMLSuccess()
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
                                    Đổi mật khẩu thành công<br>
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
}
