<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class DelGiftPack extends Base_Controller
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
        if ($this->getPost('PackID'))
        {
            $packId = $this->getPost('PackID');

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

            // Tiến hành xóa giftpack
            $delFlg = $this->Game->delGiftPack($packId);
            if ($delFlg == true)
            {
                // Tiến hành xóa gift pack item
                $this->Game->delGiftPackItem(packId);
                $result = $this->informDialog('Xóa gift pack thành công', 'THÀNH CÔNG', 'success');
            }
            else
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Xóa gift pack thất bại. Vui lòng thử lại'
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
            $message = $this->informDialog('Gift pack này không tồn tại', 'Cảnh báo', 'warning');
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
            $message = $this->informDialog('Gift pack này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }

        $data['giftPackInfo'] = $giftPackInfo;

        return $this->load->view('Admin/del_gift_pack_view', $data);
    }
}
