<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberAddDay extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Check user is Login
        if ($this->isLogin() === false) {
            $this->authRedirect('Login');
        }
    }

    public function index()
    {
        // Get acct_id from session
        $acct_id = $this->userInfo['cAccName'];

        $this->load->model('Account_model', 'Account');
        // Get Account Info
        $userInfo = $this->Account->getAccountInfo($acct_id);

        if ($this->getPost('Cash'))
        {
            $acct_id = $this->userInfo['cAccName'];
            $cash = $this->getPost('Cash');

            // Load Model xử lý phần add ngày
            $this->load->model('CharacterInfo_model', 'Character');
            $acct_id = $this->Character->getUID($acct_id);

            if($acct_id == NULL)
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Tài Khoản: '. $this->getPost('UserName') . ' không tồn tại.'
                );
            }
            else
            {
                $dong = 0;
                switch ($cash)
                {
                    case 7:
                        $dong = 100;
                        break;
                    case 14:
                        $dong = 200;
                        break;
                    case 40:
                        $dong = 500;
                        break;
                    case 90:
                        $dong = 1000;
                        break;
                }

                // Lấy số đồng hiện tại của User
                $Yanbao = $this->Character->getYuanbao($acct_id['cAccName']);

                // Lấy số KNB hiên có
                $currentYuanbao     = $Yanbao['nExtPoint'];
                $currentCountCard   = $Yanbao['CountCard'];

                if($currentYuanbao < $dong || $currentYuanbao == 0)
                {
                    redirect(base_url("Member/Character"));
//                    $result = array(
//                        'Code' => -1,
//                        'Message' => 'Bạn cần '. $dong . ' để mua ' . $cash . ' ngày chơi.'
//                    );
                }
                else
                {
                    $dEndDate = $this->Character->getDateEndInfo($acct_id['cAccName']);

                    // Lấy ngày hết hạn hiện tại của user
                    $currentDate = $dEndDate['dEndDate'];

                    // Cộng cho ngày mua thêm
                    $newDate = date('Y-m-d H:i:s', strtotime($currentDate . ' + ' . $cash . ' days'));

                    $newYuanbao = $currentYuanbao - $dong;
                    // Trừ số đồng thanh toán.
                    $this->Character->addYaunbao($acct_id['cAccName'], $newYuanbao, $currentCountCard);

                    // Tiến hành nạp ngày chơi vào Database
                    $errorFlg = $this->Character->addDate($acct_id['cAccName'], $newDate);
//                    Load Model xử lý phần log add KNB
                    $this->load->model('Log_model', 'Log');
                    if($errorFlg == TRUE)
                    {
                        // Add log nạp thẻ
                        $this->Log->addDayLogCard($acct_id['cAccName'], 1, $acct_id['cAccName'], $newDate, 'User', $cash, $currentDate);
//                        $this->session->set_flashdata('Information', 'alert alert-success');
                    }
                    else
                    {
                        // Add log nạp thẻ
                        $this->Log->addDayLogCard($acct_id['cAccName'], 0, $acct_id['cAccName'], $newDate, 'User', $cash, $currentDate);
//                        $this->session->set_flashdata(array(
//                            'Information' => 'alert alert-danger',
//                            'Mess' => 'Có lỗi khi nạp thẻ cho tài khoản: '. $acct_id['cAccName']
//                        ));
                    }

                    redirect(base_url("Member/Character"));
//                    return $this->_getHTMLSuccess($cash);
                }
            }

            header('Content-Type: application/json');
            echo json_encode($result);
            return;
        }

        // Render view
        $this->load->view('Member/member_add_day_view');
    }

    private function _getHTMLSuccess($cash)
    {
        $returnHTML = '<div id="modalDialog" class="modal-dialog" style="width: 630px;">
                    <div id="modalContent" class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal"><span>×</span></button>
                            <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;Thành công</h4>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="alert alert-success">
                                    Bạn đã nạp  <b>' . $cash .'</b> ngày chơi<br>Hãy kiểm tra lại ở mục Nhân Vật.<br>
                                </div>
                                <hr>
                                <p>
                                    <button class="btn btn-primary modal-refresh"><i class="fa fa-check"></i> Đồng ý</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>';
        header('Content-Type: application/json');
        echo json_encode($returnHTML);
        // exit program
        return;
    }

}
