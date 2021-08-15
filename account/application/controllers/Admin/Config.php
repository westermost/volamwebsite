<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends Base_Controller
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
        $data['template'] = array(
           'title' => 'Cấu hình',
           'activeSide' => 'config'
        );
        $this->load->view('Admin/config_view', $data);
    }

    public function email()
    {
        if ($this->getPost('Email') && $this->getPost('emailPass'))
        {
            $Email      = $this->getPost('Email');
            $emailPass  = $this->getPost('emailPass');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('emailPass', 'Mật khẩu', 'required|min_length[5]');

            if ($this->form_validation->run() == TRUE)
            {
                // ini config file
                $fileName = ROOT_DIR . '/config.ini';

                $env = new T_ENV();
                $dataConf = $env->readFile($fileName);
                if (empty($dataConf) && count($dataConf) <= 0)
                {
                    $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
                }
                else
                {
                    try
                    {
                        $dataConf['mail']['MAIL_SMTP_USER']  = $Email;
                        $dataConf['mail']['MAIL_SMTP_PASS']  = $emailPass;
                        $env->writeToFile($fileName, $dataConf);

                        $message = $this->informDialog('Cấu hình gửi mail thành công.', 'Thành công', 'success');
                    }
                    catch(IniWritingException $ex)
                    {
                        $message = $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
                    }
                }
            }
            else
            {
                $message = $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
            }
        }
        else
        {
            $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
        }
        // Return view
        return $this->returnJson($message);
    }

    public function charge()
    {
        if ($this->getPost('MerchantID') && $this->getPost('ApiUser') && $this->getPost('ApiPass'))
        {
            $merchantID = $this->getPost('MerchantID');
            $apiUser    = $this->getPost('ApiUser');
            $apiPass    = $this->getPost('ApiPass');

            $merchantID_2 = $this->getPost('MerchantID_2');
            $apiUser_2    = $this->getPost('ApiUser_2');
            $apiPass_2    = $this->getPost('ApiPass_2');

             // ini config file
            $fileName = ROOT_DIR . '/config.ini';

            $env = new T_ENV();
            $dataConf = $env->readFile($fileName);
            if (empty($dataConf) && count($dataConf) <= 0)
            {
                $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
            }
            else
            {
                try
                {
                    $dataConf['vippay']['MERCHANT_ID']  = $merchantID;
                    $dataConf['vippay']['API_USER']     = $apiUser;
                    $dataConf['vippay']['API_PASS']     = $apiPass;

                    $dataConf['vippay']['MERCHANT_ID_2']  = $merchantID_2;
                    $dataConf['vippay']['API_USER_2']     = $apiUser_2;
                    $dataConf['vippay']['API_PASS_2']     = $apiPass_2;

                    $env->writeToFile($fileName, $dataConf);

                    $message = $this->informDialog('Cấu hình thanh toán thành công.', 'Thành công', 'success');
                }
                catch(IniWritingException $ex)
                {
                    $message = $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
                }
            }
        }
        else
        {
            $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
        }
        // Return view
        return $this->returnJson($message);
    }

    public function general()
    {
//        if ($this->getPost('Bonus') && $this->getPost('ItemID'))
        if ($this->getPost('Bonus'))
        {
            $bonus      = $this->getPost('Bonus');
//            $itemID     = $this->getPost('ItemID');

            // ini config file
            $fileName = ROOT_DIR . '/config.ini';

            $env = new T_ENV();
            $dataConf = $env->readFile($fileName);
            if (empty($dataConf) && count($dataConf) <= 0)
            {
                $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
            }
            else
            {
                try
                {
                    $dataConf['Event']['BONUS']     = (int)$bonus;
//                    $dataConf['Event']['ITEMID']    = $itemID;

                    $env->writeToFile($fileName, $dataConf);

                    $message = $this->informDialog('Cấu hình thành công.', 'Thành công', 'success');
                }
                catch(IniWritingException $ex)
                {
                    $message = $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
                }
            }
        }
        else
        {
            $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
        }
        // Return view
        return $this->returnJson($message);
    }

    public function giftdaily()
    {
        $DailyGiftITEMID1        = $this->getPost('DailyGiftITEMID');
        $ItemType1              = $this->getPost('ItemType');
        $ItemName1              = $this->getPost('ItemName');
        $Quality1                = $this->getPost('Quality');

        if ($this->getPost('DailyGiftITEMID') && ($this->getPost('ItemType') || $this->getPost('ItemType') == 0) && $this->getPost('ItemName') && $this->getPost('Quality'))
        {
            $DailyGiftITEMID        = $this->getPost('DailyGiftITEMID');
            $ItemType               = $this->getPost('ItemType');
            $ItemName               = $this->getPost('ItemName');
            $Quality                = $this->getPost('Quality');

            // ini config file
            $fileName = ROOT_DIR . '/config.ini';

            $env = new T_ENV();
            $dataConf = $env->readFile($fileName);
            if (empty($dataConf) && count($dataConf) <= 0)
            {
                $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
            }
            else
            {
                try
                {
                    $dataConf['Event']['DailyGiftITEMID']     = $DailyGiftITEMID;
                    $dataConf['Event']['ItemType']    = $ItemType;
                    $dataConf['Event']['ItemName']    = $ItemName;
                    $dataConf['Event']['Quality']    = $Quality;

                    $env->writeToFile($fileName, $dataConf);

                    $message = $this->informDialog('Cấu hình thành công.', 'Thành công', 'success');
                }
                catch(IniWritingException $ex)
                {
                    $message = $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH.', 'Cảnh báo');
                }
            }
        }
        else
        {
            $message =  $this->informDialog('Có lỗi hệ thống. Vui lòng liên hệ CSKH .', 'Cảnh báo');
        }
        // Return view
        return $this->returnJson($message);
    }
}
