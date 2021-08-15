<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gifts extends Base_Controller
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
        // Load model game
        $this->load->model('Game_model', 'Game');

        // Get gif target
        $data['giftTarget'] = $this->Game->getAllGiftBox($this->userInfo['acct_id']);

        // Get total cash
        $data['totalCash'] = $this->Game->getTotalCash($this->userInfo['acct_id']);

        /* =============== Xử lý tính năng nhận quà Phần thưởng đặc biệt =============== */
        $data['enabled'] = false;

        // Kiểm tra tính năng quà tặng đặc biệt có bật hay không
        if (SG_ENABLE == 1 || SG_ENABLE == true)
        {
            $data['received'] = false;
            // Lấy ra thông tin quà tặng
            $specialGiftUser = $this->Game->getSpecialGiftByUser($this->userInfo['acct_id']);
            if (is_null($specialGiftUser))
            {
                $data['enabled'] = false;
            }
            // Kiểm tra ngày nạp thẻ có trùng với ngày xảy ra sự kiện
            elseif (date('Y-m-d', strtotime($specialGiftUser['CashDay'])) == date('Y-m-d', strtotime(SG_CALENDAR)))
            {
                $data['enabled'] = true;
                $data['ItemQuantity'] = $specialGiftUser['Quantity'];
            }

            // Kiểm tra ngày nhận có trùng với ngày sự kiện?
            if (date('Y-m-d') != date('Y-m-d', strtotime(SG_CALENDAR)))
            {
                $data['enabled'] = false;
            }

            if ($specialGiftUser['Quantity'] == 0)
            {
                $data['received'] = true;
            }
        }
        /* =============================================================================== */

        /* =============== Xử lý tính quà nạp thẻ hàng ngày =============== */

        $dateAddCard = $this->Game->getDayAddCard($this->userInfo['acct_id']);
        $dateNow = date("Y-m-d");

        if (date('Y-m-d', strtotime($dateAddCard['DateCreated'])) == $dateNow) // Hôm nay có nạp Card
        {
            $data['checkDailyGift'] = TRUE;
            $checkReceived = $this->Game->checkGiftDailyReceived($this->userInfo['acct_id']);

            if(date('Y-m-d', strtotime($checkReceived['ReceivedDay'])) == $dateNow) // Đã nhận quà hôm nay rồi
            {
                $data['GiftDailyReceived'] = TRUE;
            }
            else
            {
                $data['GiftDailyReceived'] = false;
            }
        }
        else // Hôm nay không nạp Card
        {
            $data['checkDailyGift'] = false;
        }

        // Khai báo dữ liệu binding ra view
        $data['giftDaily'] = array(
            'itemName' => ItemName,
            'quality' => Quality
        );
        /* =============================================================================== */
        $data['template'] = array(
            'title' => 'Quà tặng',
            'activeSide' => 'gift'
        );
        $this->load->view('Game/gift_view', $data);
    }

    public function giftDaily()
    {
        // Load model
        $this->load->model('Game_model', 'Game');

        $acctId = $this->userInfo['acct_id'];

        $checkReceived = $this->Game->checkGiftDailyReceived($this->userInfo['acct_id']);
        $dateNow = date("Y-m-d");

        if(date('Y-m-d', strtotime($checkReceived['ReceivedDay'])) == $dateNow) // Đã nhận quà hôm nay rồi
        {
            $msg = 'Bạn đã nhận quà này rồi';
            $message = json_encode($this->informDialog($msg, 'Thất Bại', 'fail'));
        }
        else
        {

            // Add Quà cho User
            $flg = $this->Game->addGiftBox($acctId, DailyGiftITEMID, ItemType, Quality, 0);

            if ($flg == TRUE)
            {
                // Tiến hành update ngày nhận
                $data = array(
                    'acct_id' => $acctId,
                    'ReceivedDay' => date('Y-m-d')
                );
                $this->Game->addLogGiftDaily($data);
                $msg = 'Chúc mừng bạn đã nhận quà tặng thành công';
                $message = json_encode($this->informDialog($msg, 'Thành công', 'success'));
            }
            else
            {
                $msg = 'Có lỗi xảy ra, vui lòng liên hệ bộ phận CSKH';
                $message = json_encode($this->informDialog($msg, 'Thất Bại', 'fail'));
            }
        }

        // Thêm giftbox thành công
        $this->session->set_flashdata('modalDialog', $message);
        redirect(base_url('Game/Gifts'));
    }

    public function SpecialGift()
    {
        // Load model
        $this->load->model('Game_model', 'Game');
        $specialGiftUser = $this->Game->getSpecialGiftByUser($this->userInfo['acct_id']);
        if($specialGiftUser['Quantity'] != 0)
        {
            // Kiểm tra tính năng quà tặng đặc biệt có bật hay không
            if (SG_ENABLE == 1 || SG_ENABLE == true)
            {
                // Kiểm tra ngày nạp thẻ có trùng với ngày xảy ra sự kiện
                if (date('Y-m-d') == date('Y-m-d', strtotime(SG_CALENDAR)))
                {
                    // Lấy ra thông tin quà tặng

                    if (is_null($specialGiftUser))
                    {
                        $this->session->set_flashdata('specialGiftMsg', array('type' => 'fail', 'message' => 'Bạn chưa đủ điều kiện nhận quà này.'));
                        redirect(base_url('Game/Gifts'));
                    }
                    elseif (date('Y-m-d', strtotime($specialGiftUser['CashDay'])) != date('Y-m-d', strtotime(SG_CALENDAR)))
                    {
                        $this->session->set_flashdata('specialGiftMsg', array('type' => 'fail', 'message' => 'Bạn chưa đủ điều kiện nhận quà này.'));
                        redirect(base_url('Game/Gifts'));
                    }

//                if (date('Y-m-d', strtotime(SG_CALENDAR)) == date('Y-m-d', strtotime($specialGiftUser['ReceivedDay'])))
//                {
//                    $this->session->set_flashdata('specialGiftMsg', array('type' => 'fail', 'message' => 'Bạn đã nhận quà này.'));
//                    redirect(base_url('Game/Gifts'));
//                }

                    // Tiến hành update ngày nhận
                    $acctId = $this->userInfo['acct_id'];

                    $data = array(
                        'ReceivedDay' => date('Y-m-d'),
                        'acct_id' => $acctId
                    );
                    $flg = $this->Game->addSpecialGift($data);

                    if($specialGiftUser['Quantity'] == 0)
                    {
                        $msg = 'Bạn đã nhận quà này rồi';
                        $message = json_encode($this->informDialog($msg, 'Thất Bại', 'fail'));
                    }
                    else
                    {
                        // Tiến hành update vào gifbox
                        $ItemQuantity = $specialGiftUser['Quantity'];
                        if ($ItemQuantity >= RECORD_RATE)
                        {
                            $count99Item = floor($ItemQuantity/RECORD_RATE);
                            $remainItem  = $ItemQuantity % RECORD_RATE;

                            for ($iii = 1; $iii <= $count99Item; $iii++)
                            {
                                $this->Game->addGiftBox($acctId, SG_ITEMID, SG_ITEMTYPE, RECORD_RATE, 0);
                            }
                            if($remainItem > 0)
                            {
                                $this->Game->addGiftBox($acctId, SG_ITEMID, SG_ITEMTYPE, $remainItem, 0);
                            }
                        }
                        else
                        {
                            $this->Game->addGiftBox($acctId, SG_ITEMID, SG_ITEMTYPE, $ItemQuantity, 0);
                        }

                        // Cập nhật lại số lượng quà của User
                        $this->Game->updateSpecailGiftQuality($acctId, 0);

                        $msg = 'Chúc mừng bạn đã nhận quà tặng thành công';
                        $message = json_encode($this->informDialog($msg, 'Thành công', 'success'));
                    }

                    // Thêm giftbox thành công
                    $this->session->set_flashdata('modalDialog', $message);
                    redirect(base_url('Game/Gifts'));
                }
            }
        }
        else
        {
            $msg = 'Bạn đã nhận quà này rồi';
            $message = json_encode($this->informDialog($msg, 'Thất Bại', 'fail'));
            $this->session->set_flashdata('modalDialog', $message);
            redirect(base_url('Game/Gifts'));
        }


        $this->session->set_flashdata('specialGiftMsg', array('type' => 'fail', 'message' => 'Bạn chưa đủ điều kiện nhận quà này.'));
        redirect(base_url('Game/Gifts'));
    }
}
