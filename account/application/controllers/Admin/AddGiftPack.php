<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class AddGiftPack extends Base_Controller
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
        if ($this->getPost('PackName') || $this->getPost('TotalCode'))
        {
            $packName   = $this->getPost('PackName');
            $totalCode  = $this->getPost('TotalCode');

            // Validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules('PackName', 'Mã vật phẩm', 'required');
            $this->form_validation->set_rules('TotalCode', 'Loại vật phẩm', 'required|numeric');

            if ($this->form_validation->run() == TRUE)
            {
                $this->load->model('Game_model', 'Game');
                $data = array(
                    'pack_name'     => $packName,
                    'total'         => $totalCode,
                    'created_by'    => $this->AdminInfo['ID'], // 'created_by'    => $this->AdminInfo['ID'];
                );
                $option = array('type' => 'add', 'get' => 'lastID');
                $addFlg = $this->Game->saveGiftPack($data, $option);

                if ($addFlg == false)
                {
                    $result = array(
                        'Code' => -1,
                        'Message' => 'Thêm mới gói giftcode thất bại. Vui lòng thử lại'
                    );
                }
                else
                {
                    $url = 'Admin/AddGiftPackDetail/' . $addFlg;
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

        $this->load->view('Admin/add_gift_pack_view');
    }

}
