<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Siniy
 */
class EditGiftItem extends Base_Controller
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
        if ($this->getPost('ItemID') && $this->getPost('ItemName') && $this->getPost('ID'))
        {
            $itemID     = $this->getPost('ItemID');
            $itemName   = $this->getPost('ItemName');
            $ID         = $this->getPost('ID');
            $itemType   = $this->getPost('ItemType');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ItemID', 'Mã vật phẩm', 'required|min_length[3]|numeric');
            $this->form_validation->set_rules('ItemType', 'Loại vật phẩm', 'required|callback__itemTypeCheck');
            $this->form_validation->set_rules('ItemName', 'Loại vật phẩm', 'required|min_length[6]');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                $dispError = array_values($errors)[0];

                $result = array(
                    'Code' => -1,
                    'Message' => $dispError
                );
                return $this->returnJson($result);
            }

            // Check sự tồn tại của item
            $giftItemInfo = $this->Game->getItemGiftCodeByID($ID);
            if (is_null($giftItemInfo))
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Gift item này không tồn tại'
                );
                return $this->returnJson($result);
            }

            // Tiến hành update giá trị của item
            $updateFlg = $this->Game->saveItemGiftCode($itemID, $itemName, $itemType, $type = 'update', $ID);
            if ($updateFlg == true)
            {
                $result = $this->informDialog('Cập nhật gift item thành công', 'THÀNH CÔNG', 'success');
            }
            else
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Cập nhật gift item thất bại. Vui lòng thử lại'
                );
            }
            return $this->returnJson($result);
        }


        // Lấy thông tin gift item
        if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3)) == true)
        {
            return $this->loadGiftItemInfo();
        }
        else
        {
            $message = $this->informDialog('Gift item này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }

    }

    private function loadGiftItemInfo()
    {
        $itemID = $this->uri->segment(3);

        // Check sự tồn tại của item
        $giftItemInfo = $this->Game->getItemGiftCodeByID($itemID);
        if (is_null($giftItemInfo))
        {
            $message = $this->informDialog('Gift item này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }

        $data['giftItemInfo'] = $giftItemInfo;

        return $this->load->view('Admin/edit_gift_item_view', $data);
    }

    public function _itemTypeCheck($itemType)
    {
        $check = array(0, 1, 2);
        if (!in_array($itemType, $check))
        {
            $this->form_validation->set_message('_itemTypeCheck', 'Hãy chọn giá trị {field} đúng');
            return FALSE;
        }
        return TRUE;
    }

}
