<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class AddGiftItem extends Base_Controller
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
        if ($this->getPost('ItemID') || $this->getPost('ItemType') || $this->getPost('ItemName'))
        {
            // Get data from request
            $itemID = $this->getPost('ItemID');
            $itemType = $this->getPost('ItemType');
            $itemName = $this->getPost('ItemName');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ItemID', 'Mã vật phẩm', 'required|min_length[3]|numeric');
            $this->form_validation->set_rules('ItemType', 'Loại vật phẩm', 'required|callback__itemTypeCheck');
            $this->form_validation->set_rules('ItemName', 'Tên vật phẩm', 'required|min_length[6]');

            if ($this->form_validation->run() == TRUE)
            {
                $this->load->model('Game_model', 'Game');
                $flg = $this->Game->saveItemGiftCode($itemID, $itemName, $itemType);
                if ($flg === false)
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Thêm mới gift item thất bại. Vui lòng thử lại'
                    );
                }
                else
                {
                    $result = $this->informDialog('Thêm mới gift item thành công', 'THÀNH CÔNG', 'success');
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
        $this->load->view('Admin/add_gift_item_view');
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
