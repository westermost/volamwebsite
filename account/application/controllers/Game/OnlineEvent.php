<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OnlineEvent extends Base_Controller
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
        // Load model Log
        $this->load->model('Log_model', 'Log');
        // Lấy tổng số tiền đã nạp trong tháng
        $totalCash = $this->Log->getTotalCashMonth($this->userInfo['acct_id']);

        // Load Event model
        $this->load->model('Event_model', 'Event');
        // Check xem user đã nhận tháng mới chưa?
        $eventUser = $this->Event->getEventUserInfo($this->userInfo['acct_id']);

        // User chưa nhận quà lần nào
        if ($eventUser === NULL)
        {
            // Thêm mới user vào event online
            $dataInsert = array(
                'day_received'  => 1,
                'acct_id'       => $this->userInfo['acct_id'],
            );
            $this->Event->saveEventUserInfo($dataInsert, 'insert');
        }

        // Lấy tháng nhận cuối cùng
        $lastMonthReceived = date('Y-m', strtotime($eventUser['last_received']));

        // Kiểm tra tháng nhận cuối cùng có thuộc tháng này không?
        if ($lastMonthReceived != date('Y-m'))
        {
            // Nếu đang là tháng khác => update ngày nhận về 0
            $dataUpdate = array(
                'day_received'  => 1,
                'acct_id'       => $this->userInfo['acct_id'],
            );
            $this->Event->saveEventUserInfo($dataUpdate);
        }

        // Lấy thông tin thành viên lần nữa
        $eventUser = $this->Event->getEventUserInfo($this->userInfo['acct_id']);

        // Lấy ra các phần quà trong tháng
        $onlineGift = $this->Event->getEventOnlineGifts();
        // Kiểm tra xem người dùng đã nạp đủ tiền chưa
        $isEligible = $totalCash >= ONLINE_GIFT_POINT ? true : false;

        if ($eventUser['day_received'] > 1)
        {
            for ($iii = 1; $iii < $eventUser['day_received']; $iii++)
            {
                unset($onlineGift[$iii]);
            }
        }

        // Lấy ngày nhận cuối cùng
        $data['todayReceived'] = false;
        $lastDateReceived = date('d', strtotime($eventUser['last_received']));
        if ($lastDateReceived == date('d'))
        {
            $eventUser['day_received'] = $eventUser['day_received'] - 1;
            $data['todayReceived'] = true;
        }

        $data['onlineGift'] = $onlineGift;
        $data['isEligible'] = $isEligible;
        $data['dayReceived'] = $eventUser['day_received'];

        $data['template'] = array(
            'title' => 'Online Event',
            'activeSide' => 'onlineEvent',
        );
        $this->load->view('Game/online_event_view', $data);
    }

    public function Receive()
    {
        // Lấy ngày từ link
        $day = $this->uri->segment(4);
        $type = $this->uri->segment(5);
        // Load Event model
        $this->load->model('Event_model', 'Event');
        // Lấy thông tin user tham gia online event
        $eventUser = $this->Event->getEventUserInfo($this->userInfo['acct_id']);

        // Lấy thông tin phần quà
        $eventGift = $this->Event->getEventOnlineGiftByDay($day, $type);
        if ($eventGift == NULL)
        {
            $this->session->set_flashdata('online', array('type' => 'fail', 'message' => 'Có lỗi xảy ra. <br/> Vui lòng liên hệ bộ phận CSKH'));
            redirect(base_url('Game/OnlineEvent'));
        }

        $lastDateReceived = date('d', strtotime($eventUser['last_received']));
        if ($day != $eventUser['day_received'])
        {
            $this->session->set_flashdata('online', array('type' => 'fail', 'message' => 'Bạn chưa đủ điều kiện nhận quà này. <br/> Vui lòng liên hệ bộ phận CSKH'));
            redirect(base_url('Game/OnlineEvent'));
        }
        elseif ($lastDateReceived == date('d'))
        {
            $this->session->set_flashdata('online', array('type' => 'fail', 'message' => 'Bạn đã nhận quà này. <br/> Vui lòng liên hệ bộ phận CSKH'));
            redirect(base_url('Game/OnlineEvent'));
        }

        // Tiến hành add thêm ngày nhận và ngày cuối cùng nhận
        $dayReceived = $eventUser['day_received'] + 1;
        $dataUpdate = array(
            'day_received' => $dayReceived,
            'last_received' => date('Y-m-d H:i:s'),
            'acct_id' => $this->userInfo['acct_id']
        );
        $this->Event->saveEventUserInfo($dataUpdate);

        // Tiến hành thêm mới item vào giftbox
        $this->load->model('Game_model', 'Game');
        $eventGift = array_values($eventGift);
        $acctId     = $this->userInfo['acct_id'];
        $giftId     = $eventGift[0];
        $itemType   = $eventGift[2];
        $quantity   = $eventGift[3];
        $flg = $this->Game->addGiftBox($acctId, $giftId, $itemType, $quantity);
        if ($flg == false)
        {
            $this->session->set_flashdata('online', array('type' => 'fail', 'message' => 'Nhận quà thất bại. Vui lòng thử lại.'));
        }
        else
        {
            $msg = 'Chúc mừng bạn đã nhận quà tặng <strong>Ngày ' . $day .'</strong> thành công';
            $message = json_encode($this->informDialog($msg, 'Thành công', 'success'));
            // Thêm giftbox thành công
            $this->session->set_flashdata('modalDialog', $message);
        }
        redirect(base_url('Game/OnlineEvent'));
    }
}
