<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class CheckCode extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
       if ($this->isAdminLogin() === false)
       {
           redirect(base_url('admincp'));
       }
    }

    public function index()
    {
        if ($this->getPost('GiftCode'))
        {
            // Load model
            $this->load->model('Game_model', 'Game');

            $giftCode = $this->getPost('GiftCode');

            $giftCodeInfo = $this->Game->getGiftCodeInfo($giftCode);
            if (is_null($giftCodeInfo))
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Gift Code không tồn tại!!'
                );

                return $this->returnJson($result);
            }

            $giftPackId = $giftCodeInfo['gift_id'];

            // Lấy thông tin gift pack
            $giftPackInfo = $this->Game->getGiftPacks($giftPackId);

            $result = $this->_getHTML($giftPackInfo, $giftCodeInfo);

            return $this->returnJson($result);
        }
        $this->load->view('Admin/check_code_view');
    }

    private function _getHTML($giftPackInfo, $giftCodeInfo)
    {
        $this->load->model('Account_model', 'Account');
        $activedBy = null;
        if (is_null($giftCodeInfo['actived_by']) == false && mb_strlen($giftCodeInfo['actived_by']) > 0)
        {
            $activedBy = $this->Account->getAccountInfo($giftCodeInfo['actived_by']);
            $activedBy = $activedBy['loginName'];
        }

        $status = $giftCodeInfo['Status'] == 1 ? 'Chưa nhận' : 'Đã nhận';
        return '<div class="col-sm-offset-1 col-sm-10"><div class="row">
                    <label class="col-sm-3" for="PackName">Tên gói</label>
                    <div class="col-sm-8">
                        '. $giftPackInfo[0]['pack_name'] .'
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" for="TotalCode">Tình trạng</label>
                    <div class="col-sm-8">
                        '. $status .'
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 for="RemainCode">Người nhận</label>
                    <div class="col-sm-8">
                        '. $activedBy .'
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" for="CreatedBy">Nhận lúc</label>
                    <div class="col-sm-8">
                        '. $giftCodeInfo['actived_at'] .'
                    </div>
                </div></div>';
    }

}
