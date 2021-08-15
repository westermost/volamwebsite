<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charge extends Base_Controller
{
    const API = 'choi68';

    public function index()
    {
        if ($this->input->method() != 'post')
        {
            return redirect(base_url('Errors'));
        }

        // Get data from request
        $username = $this->getPost('UserName');
        $cardType = $this->getPost('CardType');
        $cardSeri = $this->getPost('CardSeri');
        $cardCode = $this->getPost('CardCode');

        // Get user information
        $this->load->model('Account_model', 'Account');
        $userInfo = $this->Account->getUserName($username);
        if (is_null($userInfo))
        {
            $eRet = ['Code' => 102, 'Message' => 'Tài khoản không tồn tại.'];
            return $this->returnJson($eRet);
        }

        // Execute validate
        $eRet = $this->_initValidate($username, $cardType, $cardSeri, $cardCode);
        if (!empty($eRet))
        {
            return $this->returnJson($eRet);
        }

        // Get type card
        $card = "";
        if($cardType == 1){
            $card = "Viettel";
        }
        else if($cardType == 2){
            $card = "Mobi";
        }
        else if($cardType == 3){
            $card = "Vina";
        }
        else if($cardType == 4){
            $card = "Gate";
        }
        else if($cardType == 11){
            $card = "Zing";
        }
        else if($cardType == 14){
            $card = "OnCash";
        }
        else if($cardType == 17){
            $card = "Megacard";
        }

        // Load thư viện Vippay_API
        $this->load->library('Vippay_API');

        // Check user type
        if ($userInfo['apiReg'] == self::API)
        {
            $merchantId = MERCHANT_ID_2;
            $apiUser    = API_USER_2;
            $apiPass    = API_PASS_2;
        }
        else
        {
            $merchantId = MERCHANT_ID;
            $apiUser    = API_USER;
            $apiPass    = API_PASS;
        }

        // Gửi thông tin về API
        $vippay_api = new Vippay_API();
        $vippay_api->setMerchantId($merchantId);
        $vippay_api->setApiUser($apiUser);
        $vippay_api->setApiPassword($apiPass );
        $vippay_api->setPin($cardCode);
        $vippay_api->setSeri($cardSeri);
        $vippay_api->setCardType(intval($cardType));
        $vippay_api->cardCharging();
        $code = intval($vippay_api->getCode());
        $info_card = intval($vippay_api->getInfoCard());
        $error = $vippay_api->getMsg();

        // success
        if($code === 0 && $info_card >= 10000)
        {
            $acct_id = $userInfo['acct_id'];

            $Yanbao = $this->Account->getYuanbao($acct_id);
            // Get current yuanbao
            $currentYuanbao = $Yanbao['yuanbao'];
            // Get total yuanbao
            $currentCountCard = $Yanbao['CountCard'];

            $newYuanbao = (($info_card/10) * BONUS) + $currentYuanbao;

            $newCountCard = $currentCountCard + $info_card;

            $errorFlg = $this->Account->addYaunbao($acct_id, $newYuanbao, $newCountCard);

            if($errorFlg == TRUE)
            {
                // Add log
                $this->Account->addLogCard($acct_id, $cardSeri, $cardCode, $info_card, $card, 1);

                // SpecialGift is turn on?
                if (SG_ENABLE == 1 || SG_ENABLE == true)
                {
                    // Check date cash is special gift date
                    if (date('Y-m-d') == date('Y-m-d', strtotime(SG_CALENDAR)))
                    {
                        // Get total cash
                        $this->load->model('Log_model', 'Log');
                        $totalCashToday = $this->Log->getTotalCashViaDay(date('Y-m-d'), $acct_id);
                        unset($this->Log);

                        // Add to SpecialGift
                        $specialGiftQuantity = $totalCashToday / SG_RATE;
                        $this->load->model('Game_model', 'Game');
                        $specialGiftUser = $this->Game->getSpecialGiftByUser($acct_id);

                        $data = array(
                            'Quantity' => $specialGiftQuantity,
                            'acct_id'  => $acct_id
                        );
                        if (is_null($specialGiftUser))
                        {
                            $this->Game->addSpecialGift($data, 'insert');
                        }
                        else
                        {
                            $this->Game->addSpecialGift($data);
                        }
                    }
                }

                $eRet = ['Code' => 50, 'Message' => 'Nạp thẻ '.$card.' thành công với mệnh giá ' . $info_card. ' vnđ.'];
            }
            else
            {
                // add log
                $this->Account->addLogCard($acct_id, $cardSeri, $cardCode, $info_card, $card, 0);
                $eRet = ['Code' => -1, 'Message' => 'Có lỗi hệ thống, xin liên hệ CSKH.'];
            }
        }
        else
        {
            $eRet = ['Code' => -1, 'Message' => 'Có lỗi hệ thống, xin liên hệ CSKH.'];
        }
        return $this->returnJson($eRet);
    }

    /* Validation */
    private function _initValidate($username, $cardType, $cardSeri, $cardCode)
    {
        // Check username required
        if (mb_strlen($username) <= 0)
        {
            return ['Code' => 101, 'Message' => 'Yêu cầu nhập Tài khoản.'];
        }

        // Check card type required
        if (mb_strlen($cardType) <= 0)
        {
            return ['Code' => 103, 'Message' => 'Yêu cầu chọn Loại thẻ.'];
        }

        // Check card seri required
        if (mb_strlen($cardSeri) <= 0)
        {
            return ['Code' => 104, 'Message' => 'Yêu cầu nhập Số seri.'];
        }

        // Check card code required
        if (mb_strlen($cardCode) <= 0)
        {
            return ['Code' => 105, 'Message' => 'Yêu cầu nhập Mã thẻ.'];
        }

    }
}
