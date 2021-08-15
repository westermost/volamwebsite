<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class VerifyEmail extends Base_Controller
{

    public function index()
    {
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '')
        {
            $username   = $this->uri->segment(3);
            $verifyCode = $this->uri->segment(4);
            $patternUser = '/^username(.)+$/';
            $patternCode = '/^verifyCode(.)+$/';
            if (preg_match($patternUser, $username) && preg_match($patternCode, $verifyCode))
            {
                // Load model
                $this->load->model('Account_model', 'Account');
                $username = (string) str_replace('username', '', $username);
                $verifyCode = (string) str_replace('verifyCode', '', $verifyCode);
                $checkFlg = $this->Account->verifyMail($username, $verifyCode);

                if ($checkFlg === true)
                {
                    $updateFlg = $this->Account->activeEmail($username, null);
                    if ($updateFlg === true)
                    {
                        // Update active key về null thành công
                        $data['active'] = 'success';
                    }
                    else
                    {
                        // Update thất bại
                        $data['active'] = 'failed';
                    }
                }
                else
                {
                    // Active key không khớp hoặc user không tồn tại
                    $data['active'] = 'failed';
                }

            }
            else
            {
                // Định dạng url không đúng
                $data['active'] = 'failed';
            }
        }
        else
        {
            $data['active'] = 'failed';
        }
        $this->load->view('Member/verify_email_view', $data);
    }

}
