<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GiftPacks extends Base_Controller
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
        // Load model Game
        $this->load->model('Game_model', 'Game');

        // Load toàn bộ các gói gift code
        $giftPacks = $this->Game->getGiftPacks();

        $this->load->model('Account_model', 'Account');

        $cnt = count($giftPacks);
        for ($iii = 0; $iii < $cnt; $iii++) {
            if (mb_strlen($giftPacks[$iii]['created_by']) > 0)
            {
                $giftPacks[$iii]['created_by'] = $this->Account->getManager($giftPacks[$iii]['created_by']);
            }
            if (mb_strlen($giftPacks[$iii]['approved_by']) > 0)
            {
                $giftPacks[$iii]['approved_by'] = $this->Account->getManager($giftPacks[$iii]['approved_by']);
            }
        }

        // Load view
        $data['giftPacks'] = $giftPacks;

        $data['template'] = array(
           'title' => 'Danh sách các gói gift code',
           'useDataTable' => true
        );
        $this->load->view('Admin/giftpacks_view', $data);
    }
}
