<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AddCash extends Base_Controller
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
            $value = $this->getPost('Value');

            if ($cash > 2000000 || ($cash % 10000 != 0))
            {
                if ($cash > 2000000)
                {
                    $this->session->set_flashdata(array(
                        'Information' => 'alert alert-danger',
                        'Mess' => 'Số tiền không vượt quá 2 triệu.'
                    ));
                }
                else
                {
                    $this->session->set_flashdata(array(
                        'Information' => 'alert alert-danger',
                        'Mess' => 'Số tiền phải chia hết cho 10000.'
                    ));
                }
            }
            else
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
//                 Load Model xử lý phần log add KNB
                    $this->load->model('Account_model', 'Account');
                    if($errorFlg == TRUE)
                    {
                        // Add log nạp thẻ
                        $this->Account->addLogCard($acct_id['cAccName'], null, null, $cash, 'Bank', 1, $adminUser);
                        $this->session->set_flashdata('Information', 'alert alert-success');
                    }
                    else
                    {
                        // Add log nạp thẻ
                        $this->Account->addLogCard($acct_id['cAccName'], null, null, $cash, 'Bank', 0, $adminUser);
                        $this->session->set_flashdata(array(
                            'Information' => 'alert alert-danger',
                            'Mess' => 'Có lỗi khi nạp thẻ cho tài khoản: '. $acct_id['cAccName']
                        ));
                    }
                }
            }
        }


        $data['template'] = array(
            'title' => 'Nạp tiền qua Bank',
            'activeSide' => 'charge'
        );
        // Load view
        $this->load->view('Admin/add_cash_view', $data);
    }
}
