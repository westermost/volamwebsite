<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AddDay extends Base_Controller
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
        // Get Admin User from session
        $adminUser = $this->AdminInfo['Username'];

        if($this->getPost('UserName') && $this->getPost('Cash') )
        {
            $acct_id = $this->getPost('UserName');
            $cash = $this->getPost('Cash');


            // Load Model xử lý phần add ngày
            $this->load->model('CharacterInfo_model', 'Character');
            $acct_id = $this->Character->getUID($acct_id);
            if($acct_id == NULL)
            {
                $this->session->set_flashdata(array(
                    'Information' => 'alert alert-danger',
                    'Mess' => 'Tài Khoản: '. $this->getPost('UserName') . ' không tồn tại.'
                ));
            }
            else
            {
                $dEndDate = $this->Character->getDateEndInfo($acct_id['cAccName']);

                // Lấy ngày hết hạn hiện tại của user
                $currentDate = $dEndDate['dEndDate'];

                // Cộng cho ngày mua thêm
                $newDate = date('Y-m-d H:i:s', strtotime($currentDate . ' + ' . $cash . ' days'));

                // Tiến hành nạp ngày chơi vào Database
                $errorFlg = $this->Character->addDate($acct_id['cAccName'], $newDate);

                unset($this->Character);
                // Load Model xử lý phần log add ngày chơi
                $this->load->model('Log_model', 'Log');
                if($errorFlg == TRUE)
                {
                    $this->Log->addDayLogCard($acct_id['cAccName'], 1, $adminUser, $newDate, "Bank", $cash, $currentDate);
                    $this->session->set_flashdata('Information', 'alert alert-success');
                }
                else
                {
                    // Add log nạp thẻ
                    $this->Log->addDayLogCard($acct_id['cAccName'], 2, $adminUser, $newDate, "Bank", $cash, $currentDate);
                    $this->session->set_flashdata(array(
                        'Information' => 'alert alert-danger',
                        'Mess' => 'Có lỗi khi nạp ngày chơi cho tài khoản: '. $acct_id['cAccName']
                    ));
                }
            }

        }

        $data['template'] = array(
            'title' => 'Nạp ngày chơi',
            'activeSide' => 'charge'
        );
        // Load view
        $this->load->view('Admin/add_day_view', $data);
    }
}
