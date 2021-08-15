<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Form_validation extends CI_Form_validation {

    protected $CI;

    public function __construct() {
        parent::__construct();
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
    }

    /**
     * Using to validate the input captcha with session captcha
     * @param  string $captchaWord validation's value
     * @return boolean      true/false
     */
    public function validCaptcha($captchaWord)
    {
        $this->CI->form_validation->set_message('validCaptcha', 'Hình ảnh kiểm chứng không chính xác.');
        if (strcasecmp($_SESSION['captchaWord'], $captchaWord) == 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Using to validate the string has start with a letters and continute with a digits
     * @param  string $str validation's value
     * @return boolean      true/false
     */
    public function digitsLetters($str)
    {
        if (!preg_match('/^[A-Za-z][a-zA-Z0-9\._-]+$/i', $str))
        {
            $this->form_validation->set_message('digitsLetters', 'Yêu cầu bắt đầu với chữ cái, tiếp theo là các ký tự không dấu.');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
