<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GiftPackItem extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
       if ($this->isAdminLogin() === false)
       {
           redirect(base_url('admincp'));
       }
    }

    public function RemoveItem()
    {
        if ($this->getPost('pack_id') && $this->getPost('item_id'))
        {
            // Load Game model
            $this->load->model('Game_model', 'Game');

            $packId = $this->getPost('pack_id');
            $itemId = $this->getPost('item_id');

            if (is_numeric($packId) && is_numeric($itemId))
            {
                $delFlg = $this->Game->rmGiftPackItem($packId, $itemId);
                if ($delFlg === false)
                {
                    $result = array('Code' => -1);
                }
                else
                {
                    $result = array('Code' => 1);
                }
            }
        }
        else
        {
            $result = array('Code' => -1);
        }
        echo json_encode($result);
        return;
    }

    public function AddItem()
    {
        if ($this->getPost('pack_id') && $this->getPost('item_id'))
        {
            $ID         = $this->getPost('item_id');
            $itemType   = $this->getPost('item_type');
            $packId     = $this->getPost('pack_id');
            $quantity   = (int) $this->getPost('quantity');

            if ($quantity <= 0)
            {
                $result = array('Code' => -1, 'Message' => 'Vui lòng chọn số lượng');
                return $this->returnJson($result);
            }
            // Load Game model
            $this->load->model('Game_model', 'Game');

            // Kiểm tra item gift code có tồn tại hay không
            $itemGiftCode = $this->Game->getItemGiftCodeByItemId($ID, $itemType);
            if (is_null($itemGiftCode))
            {
                $result = array('Code' => -1, 'Message' => 'Vật phẩm bạn thêm vào không tồn tại');
            }
            else
            {
                $itemId = $itemGiftCode['ID'];
                // Thêm thông tin vào bảng GiftPackItem
                $addFlg = $this->Game->addGiftPackItem($packId, $itemId, $quantity);
                // Insert thất bại
                if ($addFlg === false)
                {
                    $result = array('Code' => -1, 'Message' => 'Có lỗi hệ thống. Vui lòng liên hệ CSKH');
                }
                else
                {
                    $result = array('Code' => 1, 'Item' => $itemGiftCode);
                }
            }
        }
        else
        {
            $result = array('Code' => -1, 'Message' => 'Vui lòng chọn đủ các giá trị');
        }
        return $this->returnJson($result);
    }
}
