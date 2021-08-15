<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class GiftItems extends Base_Controller
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
        $this->load->model('Game_model', 'Game');

        // Lấy tất cả item gift code trong db
        $data['itemGiftCodes'] = $this->Game->getItemGiftCodes();

        // Load view
        $data['template'] = array(
           'title' => 'Danh sách gift items',
           'useDataTable' => true
        );
        $this->load->view('Admin/giftitems_view', $data);
    }
}
