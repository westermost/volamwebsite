<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class EditGiftPack extends Base_Controller
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
        // Load model
        $this->load->model('Game_model', 'Game');

        // Nhận các data request
        if ($this->getPost('PackName') && $this->getPost('TotalCode') && $this->getPost('PackID'))
        {
            $packName   = $this->getPost('PackName');
            $totalCode  = $this->getPost('TotalCode');
            $packId     = $this->getPost('PackID');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('PackName', 'Mã vật phẩm', 'required');
            $this->form_validation->set_rules('TotalCode', 'Loại vật phẩm', 'required|numeric');

            if ($this->form_validation->run() == TRUE)
            {
                // Check sự tồn tại của gift pack
                $giftPackInfo = $this->Game->getGiftPackById($packId);
                if (is_null($giftPackInfo))
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Gift pack này không tồn tại'
                    );
                    return $this->returnJson($result);
                }

                $data = array(
                    'pack_name'     => $packName,
                    'total'         => $totalCode,
                    // 'created_by'    => $this->adminInfo['manager_id'];
                );
                $option = array(
                    'type' => 'update',
                    'pack_id' => $packId
                );
                $updateFlg = $this->Game->saveGiftPack($data, $option);

                if ($updateFlg == false)
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Chỉnh sửa gói giftcode thất bại. Vui lòng thử lại'
                    );
                }
                else
                {
                    $url = 'Admin/AddGiftPackDetail/' . $packId;
                    $result = array(
                        'Code' => 1,
                        'loadURL' => base_url($url)
                    );
                }
            }
            else
            {
                $errors = $this->form_validation->error_array();
                $dispError = array_values($errors)[0];

                $result = array(
                    'Code' => -1,
                    'Message' => $dispError
                );
            }
            return $this->returnJson($result);
        }

        // Lấy thông tin gift pack
        if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3)) == true)
        {
            return $this->_loadGiftPackInfo();
        }
        else
        {
            $message = $this->informDialog('Gói gift code này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }
    }

    private function _loadGiftPackInfo()
    {
        $packID = $this->uri->segment(3);

        // Check sự tồn tại của item
        $giftPackInfo = $this->Game->getGiftPackById($packID);
        if (is_null($giftPackInfo))
        {
            $message = $this->informDialog('Gói gift code này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }

        $data['giftPackInfo'] = $giftPackInfo;

        return $this->load->view('Admin/edit_gift_pack_view', $data);
    }
}
