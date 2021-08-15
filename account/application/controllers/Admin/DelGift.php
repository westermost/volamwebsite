<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class DelGift extends Base_Controller
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

        if ($this->getPost('ID'))
        {
            $ID = $this->getPost('ID');
            // Check sự tồn tại của quà tặng này
            $giftInfo = $this->Game->getAllGifts('single', $ID);
            if (is_null($giftInfo))
            {
                $message = $this->informDialog('Quà tặng này không tồn tại', 'Cảnh báo', 'warning');
                return $this->returnJson($message);
            }
            // Tiến hành xóa item
            $delFlg = $this->Game->delGift($ID);
            if ($delFlg == true)
            {
                $result = $this->informDialog('Xóa quà tặng thành công', 'THÀNH CÔNG', 'success');
            }
            else
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Xóa quà tặng thất bại. Vui lòng thử lại'
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

        return $this->load->view('Admin/del_gift_view', $data);
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
