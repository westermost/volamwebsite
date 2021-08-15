<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class EditGift extends Base_Controller
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


        if ($this->getPost('ItemID') || $this->getPost('ItemType') || $this->getPost('ItemName')
            || $this->getPost('Point') || $this->getPost('quantity'))
        {
            // Get data from request
            $ID         = $this->getPost('ID');
            $itemID     = $this->getPost('ItemID');
            $itemType   = $this->getPost('ItemType');
            $itemName   = $this->getPost('ItemName');
            $point      = $this->getPost('Point');
            $quantity   = $this->getPost('quantity');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ItemID', 'Mã vật phẩm', 'required|min_length[3]|numeric');
            $this->form_validation->set_rules('ItemType', 'Loại vật phẩm', 'required|callback__itemTypeCheck');
            $this->form_validation->set_rules('ItemName', 'Tên vật phẩm', 'required|min_length[6]');
            $this->form_validation->set_rules('Point', 'Điểm thưởng', 'required|numeric');
            $this->form_validation->set_rules('quantity', 'Số lượng', 'required|numeric');

            if ($this->form_validation->run() == TRUE)
            {
                 // Check sự tồn tại của quà tặng này
                $giftInfo = $this->Game->getAllGifts('single', $ID);
                if (is_null($giftInfo))
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Quà tặng này không tồn tại'
                    );
                    return $this->returnJson($result);
                }
                // Tiến hành update quà tặng
                $updateFlg = $this->Game->saveGift($itemID, $itemName, $itemType, $point, $quantity, $type = 'update', $ID);
                if ($updateFlg == true)
                {
                    $result = $this->informDialog('Cập nhật quà tặng thành công', 'THÀNH CÔNG', 'success');
                }
                else
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Cập nhật quà tặng thất bại. Vui lòng thử lại'
                    );
                }
                return $this->returnJson($result);
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

        // Lấy thông tin quà tặng
        if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3)) == true)
        {
            return $this->_loadGiftInfo();
        }
        else
        {
            $message = $this->informDialog('Quà tặng này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }
    }

    private function _loadGiftInfo()
    {
        $itemID = $this->uri->segment(3);

        // Check sự tồn tại của quà tặng này
        $giftInfo = $this->Game->getAllGifts('single', $itemID);
        if (is_null($giftInfo))
        {
            $message = $this->informDialog('Quà tặng này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }

        $data['giftInfo'] = $giftInfo[0];

        return $this->load->view('Admin/edit_gift_view', $data);
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
