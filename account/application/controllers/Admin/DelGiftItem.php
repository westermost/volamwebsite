<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class DelGiftItem extends Base_Controller
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
        if ($this->getPost('ID'))
        {
            $ID = $this->getPost('ID');

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

            // Tiến hành xóa item
            $delFlg = $this->Game->delItemGiftCode($ID);
            if ($delFlg == true)
            {
                $result = $this->informDialog('Xóa gift item thành công', 'THÀNH CÔNG', 'success');
            }
            else
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Xóa gift item thất bại. Vui lòng thử lại'
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

        return $this->load->view('Admin/del_gift_item_view', $data);
    }

}
