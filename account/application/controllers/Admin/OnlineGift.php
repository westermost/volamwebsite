<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class OnlineGift extends Base_Controller
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
        $this->load->model('Event_model', 'Event');

        if ($this->getPost('Point'))
        {
            $Point = $this->getPost('Point');
            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Point', 'Mốc nạp tháng', 'required|numeric');

            if ($this->form_validation->run() == TRUE)
            {
                // ini config file
                $fileName = ROOT_DIR . '/config.ini';

                $env = new T_ENV();
                $dataConf = $env->readFile($fileName);
                if (empty($dataConf) && count($dataConf) <= 0)
                {
                    $msg = array('Type' => 'danger', 'Message' => 'Chỉnh sửa Mốc nạp tháng thất bại.');
                    $this->session->set_flashdata('GiftOnlineMsg', $msg);
                    return redirect(base_url('Admin/OnlineGift'));
                }
                try
                {
                    $dataConf['OnlineGift']['Point']  = $Point;
                    $env->writeToFile($fileName, $dataConf);

                    $msg = array('Type' => 'success', 'Message' => 'Chỉnh sửa Mốc nạp tháng thành công.');
                    $this->session->set_flashdata('GiftOnlineMsg', $msg);
                    return redirect(base_url('Admin/OnlineGift'));
                }
                catch(IniWritingException $ex)
                {
                    $msg = array('Type' => 'danger', 'Message' => 'Chỉnh sửa Mốc nạp tháng thất bại.');
                    $this->session->set_flashdata('GiftOnlineMsg', $msg);
                    return redirect(base_url('Admin/OnlineGift'));
                }
            }
            else
            {
                $msg = array('Type' => 'danger', 'Message' => 'Chỉnh sửa Mốc nạp tháng thất bại.');
                $this->session->set_flashdata('GiftOnlineMsg', $msg);
                return redirect(base_url('Admin/OnlineGift'));
            }
        }

        $onlineGift = $this->Event->getEventOnlineGifts();
        $data['onlineGift'] = $onlineGift;
        $data['template'] = array(
            'title' => 'Online Nhận Quà',
        );
        // Load view
        $this->load->view('Admin/online_gift_view', $data);
    }

    public function Edit()
    {
        if ($this->input->method() == 'post')
        {
            $day = $this->uri->segment(4);
            $this->load->model('Event_model', 'Event');
            $typeGift = $this->getPost('TypeGift');

            if ($typeGift == 'normal')
            {
                $result = $this->_progress('1', $day);
                return $this->returnJson($result);
            }
            elseif ($typeGift == 'special')
            {
                $result = $this->_progress('2', $day);
                return $this->returnJson($result);
            }
        }
        $result = array(
            'Code' => '-1',
            'Message' => 'Có lỗi hệ thống. Vui lòng liên hệ CSKH'
        );
        return $this->returnJson($result);
    }

    private function do_upload($fileFormName, $day)
    {
        if ($fileFormName == 'Image_1')
        {
            $fileName = 'item' . $day . '_01.png';
        }
        else
        {
            $fileName = 'item' . $day . '_02.png';
        }
        $config['upload_path']          = PUBLIC_DIR . 'images/items/';
        $config['file_name']            = $fileName;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = TRUE;
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($fileFormName))
        {
            return false;
        }
        $this->upload->data();
        $this->_resizeImage($fileName);
        return $fileName;

    }

    private function _progress($type, $day)
    {
        // Check event day is exist
        $checkFlg = $this->Event->checkEventDay($day, $type);
        $typeSave = $checkFlg == true ? 'insert' : 'update';

        $itemID = $this->getPost('ItemID_' . $type);
        $itemName = $this->getPost('ItemName_' . $type);
        $quantity = $this->getPost('Quantity_' . $type);
        $itemType = $this->getPost('ItemType_' . $type);

        // Validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ItemID_' . $type, 'Mã vật phẩm', 'required|numeric');
        $this->form_validation->set_rules('ItemName_' . $type, 'Tên vật phẩm', 'required|min_length[6]');
        $this->form_validation->set_rules('Quantity_' . $type, 'Số lượng', 'required|numeric');
        $this->form_validation->set_rules('ItemType_' . $type, 'Số lượng', 'required|callback__itemTypeCheck');
        if ($this->form_validation->run() == TRUE)
        {
            $image = $this->do_upload('Image_' . $type, $day);
            if ($image !== false)
            {
                $data = array(
                    'day'       => $day,
                    'itemID'    => $itemID,
                    'itemName'  => $itemName,
                    'quantity'  => $quantity,
                    'itemType'  => $itemType,
                    'image'     => $image
                );
                $saveFlg = $this->Event->saveOnlineEventItem($data, $type, $typeSave);
                $msg = $typeSave == 'insert' ? 'Thêm mới item' : 'Cập nhật item <strong>Ngày ' . $day . '</strong>';
                if ($saveFlg == true)
                {
                    $msgDiaLog = $msg . ' thành công';
                    $Message = $this->informDialog($msgDiaLog, 'Thành công', 'success');
                    $result = array(
                        'Code' => 1,
                        'Message' => $Message
                    );

                }
                else
                {
                    $msgDiaLog = $msg . ' không thành công. Vui lòng thử lại';
                    $Message = $this->informDialog($msgDiaLog, 'Thất bại', 'danger', '');
                    $result = array(
                        'Code' => -1,
                        'Message' => $Message
                    );
                }
            }
            else
            {
                $result = array(
                    'Code' => -1,
                    'Message' => $this->informDialog('Upload hình ảnh thất bại. Vui lòng thử lại', 'Thất bại', 'danger', '')
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
        return $result;
    }

    private function _resizeImage($fileName)
    {
        $config['image_library']    = 'gd2';
        $config['source_image']     = PUBLIC_DIR . 'images/items/' . $fileName;
        $config['create_thumb']     = FALSE;
        $config['maintain_ratio']   = FALSE;
        $config['width']            = 42;
        $config['height']           = 42;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();

        $this->image_lib->clear();
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
