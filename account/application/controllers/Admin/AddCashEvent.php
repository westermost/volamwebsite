<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AddCashEvent extends Base_Controller
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
        $value = 0;

        if($this->getPost('UserName') && $this->getPost('Cash') )
        {
            $acct_id = $this->getPost('UserName');
            $cash = $this->getPost('Cash');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('UserName', 'Tài khoản', 'required|min_length[3]|is_unique[Event_xu.cAccName]|digitsLetters');

            $lucky = rand(1,100);
            $a = rand(1,5);

            if($lucky == 69 && $a == 3)
            {
                $cash = 100000;
            }
            elseif ($lucky == 35)
            {
                $cash = 20000;
            }
            elseif ($lucky == 75)
            {
                $cash = 50000;
            }

            if($this->form_validation->run() == TRUE)
            {
                // Load Model xử lý phần add KNB
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
                    $Yanbao = $this->Character->getYuanbao($acct_id['cAccName']);

                    // Lấy số KNB hiên có
                    $currentYuanbao = $Yanbao['nExtPoint'];
                    // Lấy tổng số KNB từng nạp
                    $currentCountCard = $Yanbao['CountCard'];

                    // Add KNB Bank theo công thức: [KNB Tổng] + (số tiền/100) + ((số tiền/100) * value)
                    // value là tỉ lệ phần trăm
                    $newYuanbao = (($cash/100) + (($cash/100) * $value)) + $currentYuanbao;
                    $newCountCard = $currentCountCard + $cash;

                    // Tiến hành nạp KNB vào Database
                    $errorFlg = $this->Character->addYaunbao($acct_id['cAccName'], $newYuanbao, $newCountCard);

                    unset($this->Character);
                    // Load Model xử lý phần log add  Event
                    $this->load->model('Account_model', 'Account');
                    if($errorFlg == TRUE)
                    {
                        // Add log nạp thẻ
                        $this->Account->addLogCardEvent($acct_id['cAccName']);
                        $this->session->set_flashdata('Information', 'alert alert-success');
                    }
                    else
                    {
                        $this->session->set_flashdata(array(
                            'Information' => 'alert alert-danger',
                            'Mess' => 'Có lỗi khi nạp thẻ cho tài khoản: '. $acct_id['cAccName']
                        ));
                    }
                }
            }
            else
            {
                $this->session->set_flashdata(array(
                    'Information' => 'alert alert-danger',
                    'Mess' => 'Tài khoản này đã nhận quà Event rồi. '
                ));
            }
        }


        $data['template'] = array(
            'title' => 'Nạp tiền qua Bank',
            'activeSide' => 'chargeEvent'
        );
        // Load view
        $this->load->view('Admin/add_cash_event_view', $data);
    }
}
