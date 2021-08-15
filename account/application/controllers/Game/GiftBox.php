<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GiftBox extends Base_Controller
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
        if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3)) == true)
        {
            // Lấy giá trị id của mốc thưởng từ url
            $giftId = $this->uri->segment(3);
            // Lấy id user từ session
            $acctId = $this->userInfo['acct_id'];

            // Load model
            $this->load->model('Game_model', 'Game');

            // Lấy ra thông tin quà tặng
            $giftBox = $this->Game->getGiftById($giftId);

            if (isset($giftBox) == false && count($giftBox) <= 0)
            {
                // Quà tặng không tồn tại
                $this->session->set_flashdata('giftbox', array('type' => 'fail', 'message' => 'Quà tặng này không tồn tại. <br/> Vui lòng liên hệ bộ phận CSKH'));
                redirect(base_url('Game/Gifts'));
            }
            // Kiểm tra đã đủ điều kiện nhận quà chưa?
            $totalCash = $this->Game->getTotalCash($acctId);
            if ($giftBox['Point'] > $totalCash)
            {
                $this->session->set_flashdata('giftbox', array('type' => 'fail', 'message' => 'Bạn chưa đủ điều kiện để nhận phần quà này.'));
                redirect(base_url('Game/Gifts'));
            }

            // Kiểm tra xem quà tặng đã được nhận chưa?
            $checkFlg = $this->Game->checkGiftBox($giftBox['gift_id'], $acctId);
            if ($checkFlg == true)
            {
                // Tài khoản đã nhận quà này rồi
                $this->session->set_flashdata('giftbox', array('type' => 'fail', 'message' => 'Phần quà này đã được nhận bởi bạn hoặc ai đó. <br/> Vui lòng liên hệ bộ phận CSKH.'));
                redirect(base_url('Game/Gifts'));
            }
            // Tiến hành thêm giftbox mới.
            $updateFlg = $this->Game->addGiftBox($acctId, $giftBox['gift_id'], $giftBox['gift_type'], $giftBox['quantity'], $giftBox['serialNo']);
            if ($updateFlg === true)
            {
                $message = '<div id="modalContent" class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal"><span>×</span></button>
                                    <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Thành công</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <div class="alert alert-success">
                                            Chúc mừng bạn đã nhận quà tặng <strong>'.$giftBox['Name'].'</strong> thành công.
                                        </div>
                                        <hr>
                                        <p>
                                            <button class="btn btn-success modal-refresh"><i class="fa fa-check"></i> OK</button>
                                        </p>
                                    </div>
                                </div>
                            </div>';
                $message = json_encode($message);
                // Thêm giftbox thành công
                $this->session->set_flashdata('modalDialog', $message);
            }
            else
            {
                // Thêm giftbox thất bại
                $this->session->set_flashdata('giftbox', array('type' => 'fail', 'message' => 'Nhận quà thất bại. Vui lòng thử lại.'));
            }
         }
        else
        {
            // Url không hợp lệ
            $this->session->set_flashdata('giftbox', array('type' => 'fail', 'message' => 'Quà tặng này không tồn tại. <br /> Vui lòng liên hệ bộ phận CSKH.'));
        }

        redirect(base_url('Game/Gifts'));
    }

    public function EditGiftBox()
    {
        // load model
        $this->load->model('Game_model', 'Game');

        // Lấy ra danh sách item gift code
        $itemGiftCodes = $this->Game->getItemGiftCodes();
        echo '<pre style="font-weight:bold; color: red">';
        print_r($itemGiftCodes);
        echo '</pre>';

        // Update gift box from item gift code
        if ($this->uri->segment(7))
        {
            $this->Game->addGiftBoxFromGiftCode(array(array($this->uri->segment(5) => $this->uri->segment(6), 'quantity' => $this->uri->segment(7))), $this->uri->segment(4));
        }
    }
}
