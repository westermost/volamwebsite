<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GiftCode extends Base_Controller
{
    public function index()
    {
        if ($this->input->method() != 'post')
        {
            return redirect(base_url('Errors'));
        }

        // Get data from request
        $username       = $this->getPost('UserName');
        $giftcode       = $this->getPost('GiftCode');

        // Get user information
        $this->load->model('Account_model', 'Account');
        $userInfo = $this->Account->getUserName($username);

        if (is_null($userInfo) === true)
        {
            $eRet = ['Code' => 101, 'Message' => 'Tài khoản không tồn tại.'];
            return $this->returnJson($eRet);
        }

        // Check giftcode is valid
        $pattern = '/[a-z0-9A-Z]{10}/';
        if (preg_match($pattern, $giftcode) == false)
        {
            $eRet = ['Code' => 102, 'Message' => 'Hãy nhập tối thiểu 10 ký tự.'];
            return $this->returnJson($eRet);
        }

        // Load model
        unset($this->Account);
        $this->load->model('Game_model', 'Game');

        // Check giftcode is exist
        $giftItems = $this->Game->getGiftPackInfo($giftcode);
        if (is_null($giftItems) === true)
        {
            $eRet = ['Code' => 103, 'Message' => 'GiftCode không tồn tại hoặc đã nhận.'];
            return $this->returnJson($eRet);
        }

        // Receive gift
        $flg = $this->Game->addGiftBoxFromGiftCode($giftItems, $userInfo['acct_id']);
        if ($flg === false)
        {
            $eRet = ['Code' => 0, 'Message' => 'Thao tác thất bại. Vui lòng liên hệ bộ phận CSKH.'];
            return $this->returnJson($eRet);
        }

        // Update giftcode status (received)
        $this->Game->updateGiftCodeStatus($giftItems[0]['GiftCode'], $userInfo['acct_id']);
        $eRet = ['Code' => 1, 'Message' => 'Nhận giftcode thành công'];
        return $this->returnJson($eRet);
    }
}
