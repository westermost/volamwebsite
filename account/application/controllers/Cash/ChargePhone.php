<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChargePhone extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->isLogin() === false) {
            $this->authRedirect('Login');
        }
    }

    public function index()
    {
        if ($this->getPost('CardType') && $this->getPost('CardSeri') && $this->getPost('CardCode') && $this->getPost('captcha')) {
             // Get acct_id from session
             $acct_id = $this->userInfo['cAccName'];

            // Get thông tin thẻ nhập từ form
            $cardType = $this->getPost('CardType');
            $cardSeri = $this->getPost('CardSeri');
            $cardCode = $this->getPost('CardCode');
            $captcha = $this->getPost('captcha');

            // Load thư viện validation
            $this->load->library('form_validation');

            // Add rule Validation
            $this->form_validation->set_rules('CardType', 'Loại thẻ', 'required');
            $this->form_validation->set_rules('CardSeri', 'Số seri thẻ', 'required|min_length[8]');
            $this->form_validation->set_rules('CardCode', 'Mã thẻ cào', 'required|numeric|min_length[8]');
            $this->form_validation->set_rules('captcha', 'Hình kiểm chứng', 'required|min_length[5]|validCaptcha');
            if ($this->form_validation->run() == TRUE) {
                // Lấy tên nhà phân phối Card
                $card = "";
                if ($cardType == 1) {
                    $card = "Viettel";
                } else if ($cardType == 2) {
                    $card = "Mobi";
                } else if ($cardType == 3) {
                    $card = "Vina";
                }

                // Load thư viện Vippay_API
                $this->load->library('Recard_API');

                //initialize variables for form validation
	            $success = false;
                $helper = new Helper();
    
                $testflg = 1;
                if ($testflg == 1) {
                    // Gửi thông tin về API
                    $helper->merchant_id = "dd49501a-f6ed-4c78-b894-32fbc2041088";
                    $helper->secret_key = "oZ8cpkH4taxH";
                    $helper->type = $cardType;
                    $helper->serial = $cardSeri;
                    $helper->code = $cardCode;
                    $helper->amount = $amount;
                } else {
                    // Gửi thông tin về API
                    $helper->merchant_id = "dd49501a-f6ed-4c78-b894-32fbc2041088";
                    $helper->secret_key = "oZ8cpkH4taxH";
                    $helper->type = $type;
                    $helper->serial = $serial;
                    $helper->code = $code;
                    $helper->amount = $amount;
                }

                $connect = $helper->connect();

                // nap the thanh cong
                if ($connect) 
                {
                    $resp = json_decode($connect['response'], true);

                    // The results returned successfully
                    if($connect['code'] === 200 && $resp['success'] == 1) 
                    {
                        $transaction_code = $resp['transaction_code'];
                        // tỉ lệ khuyến mãi
                        $value = 0;
                        $success = true;

                        // Load Model xử lý
                        $this->load->model('CharacterInfo_model', 'Character');
                        $Yanbao = $this->Character->getYuanbao($acct_id);
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
                        // Load Model xử lý phần log add KNB
                        $this->load->model('Account_model', 'Account');
                        if($errorFlg == TRUE)
                        {
                            // Add log nạp thẻ
                            $this->Account->addLogCard($acct_id['cAccName'], null, null, $cash, $type, 1, $adminUser);
                            $this->session->set_flashdata('Information', 'alert alert-success');
                        }
                        else
                        {
                            // Add log nạp thẻ
                            $this->Account->addLogCard($acct_id['cAccName'], null, null, $cash, $type, 0, $adminUser);
                            $this->session->set_flashdata(array(
                                'Information' => 'alert alert-danger',
                                'Mess' => 'Có lỗi khi nạp thẻ cho tài khoản: '. $acct_id['cAccName']
                            ));
                        }
                        
                    } 
                    else 
                    {
                        $response = $connect['response'];
                    }
        
                   
                    // phần hiển thị thông báo
                    if ($errorFlg == TRUE) 
                    {
                        if ($testflg == 1) {
                            // Add log nạp thẻ
                            $this->Account->addLogCard($acct_id, $cardSeri, $cardCode, $info_card, $card, 1);
                        }

                        // Kiểm tra tính năng quà tặng đặc biệt có bật hay không
                        if (SG_ENABLE == 1 || SG_ENABLE == true) {
                            // Kiểm tra ngày nạp thẻ có trùng với ngày xảy ra sự kiện
                            if (date('Y-m-d') == date('Y-m-d', strtotime(SG_CALENDAR))) {
                                // Lấy tổng số cash đã nạp
                                $this->load->model('Log_model', 'Log');
                                $totalCashToday = $this->Log->getTotalCashViaDay(date('Y-m-d'), $acct_id);
                                unset($this->Log);

                                // Thêm vào bảng specialGift
                                $specialGiftQuantity = $totalCashToday / SG_RATE;
                                $this->load->model('Game_model', 'Game');
                                $specialGiftUser = $this->Game->getSpecialGiftByUser($acct_id);

                                $data = array(
                                    'Quantity' => $specialGiftQuantity,
                                    'acct_id' => $acct_id
                                );
                                if (is_null($specialGiftUser)) {
                                    $this->Game->addSpecialGift($data, 'insert');
                                } else {
                                    $this->Game->addSpecialGift($data);
                                }
                            }
                        }

                        // Return message
                        $result = array(
                            'Code' => 0,
                            'Message' => 'Nạp thẻ ' . $card . ' thành công với mệnh giá ' . $info_card . ' vnđ.'
                        );
                        header('Content-Type: application/json');
                        echo json_encode($result);
                        return;
                    } 
                    else 
                    {
                        // Add log nạp thẻ
                        $this->Account->addLogCard($acct_id, $cardSeri, $cardCode, $info_card, $card, 0);
                        $result = array(
                            'Code' => -1,
                            'Message' => 'Có lỗi trong quá trình xử lý thẻ. Vui lòng liên hệ bộ phận CSKH'
                        );
                        header('Content-Type: application/json');
                        echo json_encode($result);
                        return;
                    }
                } 
                else 
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Nạp thẻ' . $card . 'không thành công. <br> Lỗi:' . $error
                    );
                    header('Content-Type: application/json');
                    echo json_encode($result);
                    return;
                }
            } else {
                // Validate form error
                $errors = $this->form_validation->error_array();
                $dispError = array_values($errors)[0];

                $result = array(
                    'Code' => -1,
                    'Message' => $dispError
                );
            }
            return $this->returnJson($result);

        }

        $data['template'] = array(
            'title' => 'Nạp thẻ điện thoại',
            'activeSide' => 'charge',
            'formName' => 'formChargePhone'
        );
        $this->load->view('Cash/charge_view.php', $data);
    }
}
