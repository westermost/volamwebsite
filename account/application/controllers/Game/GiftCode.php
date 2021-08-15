<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GiftCode extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->isLogin() === false)
        {
            $this->authRedirect('Login');
        }
    }

    public function index()
    {
        // Load model
        $this->load->model('Game_model', 'Game');

        // Xử lý request get
        if ($this->getQuery('Code'))
        {
            return $this->_getRequestExec();
        }

        // Xử lý request post
        if ($this->getPost('captcha') && $this->getPost('GiftCode'))
        {
            return $this->_postRequestExec();
        }

        $data['template'] = array(
            'title' => 'GiftCode',
            'activeSide' => 'giftcode',
        );
        $this->load->view('Game/giftcode_view', $data);
    }

    private function _getRequestExec()
    {
        $giftCode = $this->getQuery('Code');
        $pattern = '/[a-z0-9A-Z]{10}/';

        // Kiểm tra giftcode nhập vào có hợp lệ hay không
        if (preg_match($pattern, $giftCode) == true)
        {
            // Kiểm tra gói giftcode có tồn tại hay không
            $giftItems = $this->Game->getGiftPackInfo($giftCode);
            if (is_null($giftItems) === false && count($giftItems) > 0)
            {
                $result = $this->_getDialogHTML($giftItems);
            }
            else
            {
                $message = 'GiftCode không tồn tại hoặc đã nhận!';
                $result = $this->informDialog($message, 'Cảnh báo');
            }
        }
        else
        {
            $result = array(
                'Code' => -1,
                'Message' => 'Hãy nhập tối thiểu 10 ký tự'
            );
        }
        return $this->returnJson($result);
    }

    private function _postRequestExec()
    {
        $captcha = $this->getPost('captcha');
        $giftCode = $this->getPost('GiftCode');
        // Validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('GiftCode', 'GiftCode', 'required|min_length[10]');
        $this->form_validation->set_rules('captcha', 'Hình kiểm chứng', 'required|min_length[5]|validCaptcha');
        if ($this->form_validation->run() == TRUE)
        {
            // Kiểm tra gói giftcode có tồn tại hay không
            $giftItems = $this->Game->getGiftPackInfo($giftCode);
            if (is_null($giftItems) === false && count($giftItems) > 0)
            {
                $flg = $this->Game->addGiftBoxFromGiftCode($giftItems, $this->userInfo['acct_id']);
                if ($flg === false)
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Thao tác thất bại. Vui lòng liên hệ bộ phận CSKH.'
                    );
                }
                else
                {
                    // Update status của giftcode về 0 (Đã nhận quà rồi)
                    $this->Game->updateGiftCodeStatus($giftItems[0]['GiftCode'], $this->userInfo['acct_id']);
                    $message = 'Tặng phẩm đã được chuyển đến Phạm Phần Dương ở Kinh Thành!';
                    $result = $this->informDialog($message, 'Thành công', 'success');
                }
            }
            else
            {
                $message = 'GiftCode không tồn tại hoặc đã nhận!';
                $result = $this->informDialog($message, 'Cảnh báo');
            }
        }
        else
        {
            // Validate form error
            $errors = $this->form_validation->error_array();
            $dispError = array_values($errors)[0];

            $result = array(
                'Code' => -1,
                'Message' => $dispError
            );
        }
        return $this->returnJson($result);
    }

    private function _getDialogHTML($giftItems)
    {
        $gifts = '';
        foreach ($giftItems as $item)
        {
            // Xác định loại tặng phẩm
            switch ($item['ItemType']) {
                case 0:
                    $type = 'Vật phẩm';
                    break;
                case 1:
                    $type = 'Trợ thủ';
                    break;
                case 2:
                    $type = 'Thú cưỡi';
                    break;
                default:
                    $type = 'Vật phẩm';
                    break;
            }
            // In loại tặng phẩm
            $gifts .= '<li>' . $type . ': ' . $item['quantity'] . ' ' . $item['ItemName'] . '</li>';
        }
        return '<div id="modalContent" class="modal-content">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal"><span>×</span></button>
                        <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;NHẬN TẶNG PHẨM TỪ GIFT-CODE</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Quà tặng sẽ được chuyển đến NPC Phạm Thần Dương ở Kinh Thành <br />
                            <i>Thời gian chuyển có thể chậm vài phút!</i>
                        </p>
                        <form action="' . base_url('Game/GiftCode') .'" autocomplete="off" class="form-horizontal" id="mainForm" method="post" novalidate="novalidate">
                                <div id="formMessage" class="alert alert-danger hidden"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="Gifts">Tặng phẩm</label>
                                    <div class="col-sm-8">
                                        <ul>
                                            '.$gifts.'
                                        </ul>
                                    </div>
                                </div>
                                <input type="hidden" name="GiftCode" value="'.$giftItems[0]['GiftCode'].'" />
                                <div class="form-group has-feedback">
                                    <label class="col-sm-3 control-label">Nhập hình</label>
                                    <div class="col-sm-8">
                                        <img id="captchaImg" src="' .base_url('Home/Captcha') .'" alt="Captcha Image">
                                        <input class="form-control" id="captcha" maxlength="5" name="captcha" placeholder="Captcha Image" type="text" value="">
                                        <i class="fa fa-check form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-8 text-center">
                                        <button type="submit" class="btn btn-lg btn-block btn-primary"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;XÁC NHẬN</button>
                                        <img id="submitWait" style="display:none" src="'. public_url('images/loading6.gif') .'">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    formGiftCode.initValidate();
                </script>';
    }
}
