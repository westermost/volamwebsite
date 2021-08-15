<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class SpecialGift extends Base_Controller
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
        if ($this->input->method(TRUE) == 'POST')
        {
            // ini config file
            $fileName = ROOT_DIR . '/config.ini';

            $env = new T_ENV();
            $dataConf = $env->readFile($fileName);
            if (empty($dataConf) && count($dataConf) <= 0)
            {
                $result = [
                    'type' => 'fail',
                    'message' => 'Xảy ra lỗi hệ thống. Vui lòng liên hệ CSKH.'
                ];
                $this->session->set_flashdata('informMsg', $result);
                redirect(base_url('Admin/SpecialGift'));
            }
            else
            {
                try
                {
                    $enable = $this->getPost('cbxEnable');
                    $dataConf['SpecialGift']['SG_ENABLE']       = false;

                    $chargeRate = $this->getPost('ChargeRate');
                    $dataConf['SpecialGift']['SG_RATE']  = $chargeRate;

                    if ($enable == 'on')
                    {
                        $ItemID     = $this->getPost('ItemID');
                        $calendar   = $this->getPost('BeginDate');

                        $ItemName   = $this->getPost('ItemName');
                        $recordRate   = $this->getPost('RecordRate');

                        $dataConf['SpecialGift']['SG_ENABLE']       = true;
                        $dataConf['SpecialGift']['SG_CALENDAR']     = $calendar;
                        $dataConf['SpecialGift']['SG_ITEMID']       = $ItemID;
                        $dataConf['SpecialGift']['SG_ITEMNAME']     = $ItemName;
                        $dataConf['SpecialGift']['RECORD_RATE']     = $recordRate;
                    }

                    $env->writeToFile($fileName, $dataConf);

                    $result = [
                        'type' => 'success',
                        'message' => 'Cập nhật thông tin Phần thưởng đặc biệt thành công'
                    ];
                    $this->session->set_flashdata('informMsg', $result);
                    redirect(base_url('Admin/SpecialGift'));
                }
                catch(IniWritingException $ex)
                {
                    $this->_sendErrorMessage('fail', 'Cập nhật thông tin Phần thưởng đặc biệt thất bại');
                }
            }
        }
        // Load view
        $data['template'] = array(
           'title' => 'Phần thưởng đặc biệt',
           'datePicker' => true
        );
        $this->load->view('Admin/special_gift_view', $data);
    }

    private function _sendErrorMessage($type, $message)
    {
        $result = [
            'type' => 'fail',
            'message' => 'Cập nhật thông tin Phần thưởng đặc biệt thất bại'
        ];
        $this->session->set_flashdata('informMsg', $result);
        redirect(base_url('Admin/SpecialGift'));
    }
}
