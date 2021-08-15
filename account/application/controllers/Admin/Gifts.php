<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class Gifts extends Base_Controller
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

        // Lấy tất cả mốc thưởng trong db
        $data['gifts'] = $this->Game->getAllGifts();

        // Load view
        $data['template'] = array(
           'title' => 'Danh sách quà tặng',
           'useDataTable' => true
        );
        $this->load->view('Admin/gifts_view', $data);
    }
}
