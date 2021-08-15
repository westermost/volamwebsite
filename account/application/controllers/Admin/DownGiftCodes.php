<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class DownGiftCodes extends Base_Controller
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
        if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3)) == true)
        {
            $this->load->model('Game_model', 'Game');
            $packId = $this->uri->segment(3);
            if (is_numeric($packId) == false)
            {
                return redirect(base_url('Admin/GiftPacks'));
            }
            // Lấy ra tất cả giftcodes
            $giftCodes = $this->Game->getAllGiftCodesByPackId($packId);
            if (is_null($giftCodes))
            {
                return redirect(base_url('Admin/GiftPacks'));
            }
            $fileName = 'GiftCodes_' . $packId . '.csv';
            header("pragma: ''");
            header('Content-type: application/octet-stream; charset=UTF-8');
            header("Content-Disposition: attachment; filename=\"" . $fileName . "\"");
            print pack('C*', 0xEF, 0xBB, 0xBF);
            foreach ($giftCodes as $code )
            {
                print $code['GiftCode'];
                print "\r\n";
                ob_flush();
            }
        }
        else
        {
            return redirect(base_url('Admin/GiftPacks'));
        }
    }
}
