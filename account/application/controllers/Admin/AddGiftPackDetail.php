<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class AddGiftPackDetail extends Base_Controller
{
    public function index()
    {
        // Load model
        $this->load->model('Game_model', 'Game');

        // Xử lý chức năng duyệt
        if ($this->getPost('PackID'))
        {
            $packID = $this->getPost('PackID');
            if (is_numeric($packID) == false)
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Phê duyệt gift pack thất bại. Vui lòng thử lại'
                );
                return $this->returnJson($result);
            }

            // Kiểm tra GiftPack có tồn tại hay không
            $giftPackInfo = $this->Game->getGiftPackById($packID);
            if (is_null($giftPackInfo))
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Phê duyệt gift pack thất bại. Vui lòng thử lại'
                );
                return $this->returnJson($result);
            }

            // Tiến hành update trường approved
            $data = array(
                'approved_by' => $this->AdminInfo['ID'], // Thay bằng giá trị được lấy từ authenticate
                'approved_at' => date("Y-m-d H:i:s")
            );
            $option = array('type' => 'approved', 'pack_id' => $packID);
            $updateFlg = $this->Game->saveGiftPack($data, $option);
            if ($updateFlg == false)
            {
                $result = array(
                    'Code' => -1,
                    'Message' => 'Phê duyệt gift pack thất bại. Vui lòng thử lại'
                );
            }
            else
            {
                // Generate GiftCode
                $dataInsert = array();
                for ($iii = 1; $iii <= $giftPackInfo['total']; $iii++)
                {
                    $giftCode = array(
                        'GiftCode'  => strtoupper(rand_pass('10')),
                        'Status'    => 1,
                        'gift_id'   => $packID
                    );
                    array_push($dataInsert, $giftCode);
                }
                // Add gift code đã generate vào database
                $flg = $this->Game->addGenerateGiftCodes($dataInsert);
                if ($flg == true)
                {
                    $result = $this->informDialog('<p>Phê duyệt và tạo GiftCode thành công.</p> <p>Click download để tải về GiftCode</p>', 'Thành công', 'success');
                }
                else
                {
                    // Tiến hành update trường approved
                    $data = array(
                        'approved_by' => $this->AdminInfo['ID'],
                        'approved_at' => date("Y-m-d H:i:s")
                    );
                    $option = array('pack_id' => $packID);
                    $updateFlg = $this->Game->saveGiftPack($data, $option);

                    $result = array(
                        'Code' => -1,
                        'Message' => 'Phê duyệt gift pack thất bại. Vui lòng thử lại'
                    );
                }
            }

            return $this->returnJson($result);

        }

        // Lấy thông tin gift item
        if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3)) == true)
        {
            return $this->_loadGiftPackInfo('Admin/add_gift_pack_detail_view');
        }
        else
        {
            $message = $this->informDialog('Gói giftcode này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }
    }

    /*
     * Xử lý khi click nút phê duyệt
     */
    public function Approve()
    {
        // Load model
        $this->load->model('Game_model', 'Game');

        // Lấy thông tin gift item
        if ($this->uri->segment(4) != '' && is_numeric($this->uri->segment(4)) == true)
        {
            return $this->_loadGiftPackInfo('Admin/approve_gift_pack_detail_view', 4);
        }
        else
        {
            $message = $this->informDialog('Gói giftcode này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }
    }

    private function _loadGiftPackInfo($view, $segment = 3)
    {

        $packID = $this->uri->segment($segment);

        // Lấy thông tin gift pack
        $giftPackInfo = $this->Game->getGiftPacks($packID);

        $this->load->model('Account_model', 'Account');
        $giftPackInfo[0]['created_by'] = $this->Account->getManager($giftPackInfo[0]['created_by']);

        if (is_null($giftPackInfo))
        {
            $message = $this->informDialog('Gói giftcode này không tồn tại', 'Cảnh báo', 'warning');
            echo $message;
            return;
        }

        // Lấy toàn bộ gift pack item
        $giftPackItem = $this->Game->getGiftPackItems($packID);

        $data['giftPackInfo'] = $giftPackInfo[0];
        $data['giftPackItem'] = $giftPackItem;
        return $this->load->view($view, $data);
    }

    public function EditGiftBox()
    {
        $this->load->model('Game_model', 'Game');
        $this->Game->addGiftBoxFromGiftCode(array(array($this->uri->segment(5) => $this->uri->segment(6), 'quantity' => $this->uri->segment(7))), $this->uri->segment(4));
    }
}
