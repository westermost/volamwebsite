<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends Base_Controller
{
  public function index()
  {
    // Check valid captcha from session
    if ($this->getPost('captcha'))
    {
        $captchaWord = $this->getPost('captcha');
        if (strcasecmp($_SESSION['captchaWord'], $captchaWord) == 0)
        {
            echo json_encode(true);
            return true;
        }
        else
        {
            echo json_encode(false);
            return false;
        }
    }
    // Generage captcha
    $this->_generateCaptcha();
    exit;
  }

  private function _generateCaptcha()
  {
    $this->load->helper('captcha');
    $vals = array(
            'word'          => '',
            'img_path'      => PUBLIC_DIR . 'images/captcha/',
            'img_url'       => public_url() . '/images/captcha/',
            'font_path'     => PUBLIC_DIR . 'fonts/captcha.ttf',
            'img_width'     => '132',
            'img_height'    => 46,
            'expiration'    => 600,
            'word_length'   => 5,
            'font_size'     => 20,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(232,76,61),
                    'border' => array(195, 23, 30),
                    'text' => array(255, 255, 255),
                    'grid' => array(255, 255, 255)
            )
    );


    $cap = create_captcha($vals, false);
    $_SESSION['captchaWord'] = $cap['word'];

    // Return image
    header('Content-Type: image/jpeg');

    imagejpeg($cap['im'], NULL);
    ImageDestroy($cap['im']);
  }
}
