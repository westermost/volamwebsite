<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller
{
    /* Request encoding */
    const REQUEST_ENCODING = "UTF-8";

    /* User logged in information */
    public $userInfo = array();
    public $AdminInfo = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('authentication'));
        $module = $this->uri->segment(1);
        if (strtolower($module) != 'auth')
        {
            $this->AdminInfo = $this->authentication->checkAdmin();
        }
        $this->userInfo = $this->authentication->check();
    }

    protected function isLogin()
    {
        $tempUserInfo = "";
        if(is_array($this->userInfo))
        {
            $tempUserInfo = count($this->userInfo);
        }
        else{
            $tempUserInfo = strlen($this->userInfo);
        }


        if (isset($this->userInfo) == false && $tempUserInfo <= 0)
        {
            return false;
//             $this->session->sess_destroy();
//             redirect(base_url('Account/Login'));
//             exit;
        }
        else
        {
            return $this->userInfo;
        }
    }

    protected function isAdminLogin()
    {
        if (isset($this->AdminInfo) == false && count($this->AdminInfo) <= 0)
        {
            return false;
            // $this->session->sess_destroy();
            // redirect(base_url('Account/Login'));
            // exit;
        }
        else
        {
            return $this->AdminInfo;
        }
    }


    public function authRedirect($url)
    {
        session_destroy();
        redirect(base_url($url));
        exit;
    }

    /**
    * Using to hashing password
    * @param  string $password password
    * @return string      password hashed
    */
    protected function hashPassword($password)
    {
        // Execute hash
        shell_exec("cd " . ROOT_DIR);
        $password = shell_exec("cmd /c qglpasswd.exe user " . $password);

        // Check password after hash
        if (isset($password) && mb_strlen($password) > 0)
        {
            $pos = strpos($password, '(');
            $password = substr($password, $pos + 1, (strlen($password) - $pos - 2));
        }

        return $password;
    }


    /**
    * Using to get query request on form within delete control code
    * @param  string $key key of input request
    * @param  string $encoding request encoding
    * @return string      request value
    */
    public function getQuery($key, $encoding = self::REQUEST_ENCODING)
    {
        if ($this->input->get($key) === false)
        {
            return "";
        }

        $val = $this->input->get($key);
        $val = $this->deleteControlCode($val);
        if (strlen($val) <= 0)
        {
            return "";
        }

        $val = mb_convert_encoding($val, mb_internal_encoding(), $encoding);
        return $val;
    }


    /**
    * Using to get post request on form within delete control code
    * @param  string $key key of input request
    * @param  string $encoding request encoding
    * @return string      request value
    */
    public function getPost($key, $encoding = self::REQUEST_ENCODING)
    {
        if ($this->input->post($key) === false)
        {
            return "";
        }
        $val = $this->input->post($key);
        if (is_array($val) == true)
        {
            $ary = array();
            foreach ($val as $v) {
                $v = $this->deleteControlCode($v);
                if (strlen($v) <= 0)
                {
                    continue;
                }

                $v = mb_convert_encoding($v, mb_internal_encoding(), $encoding);
                array_push($ary, $v);
            }

            return $ary;
        }
        else
        {
            $val = $this->deleteControlCode($val);
            if (strlen($val) <= 0)
            {
                return "";
            }

            $val = mb_convert_encoding($val, mb_internal_encoding(), $encoding);
            return $val;
        }

    }

    /**
    * Delete control code
    * @param  string $str string to check and delete control code
    * @return string      request value after delete control code
    */
    public function deleteControlCode($str)
    {
        if (strlen($str) <= 0) return "";

        $pattern = "[\\x00-\\x08]|[\\x0B-\\x0C]|[\\x0E-\\x1F]";
        $str = mb_ereg_replace($pattern, "", $str);

        $pattern = "[\\x00]|[\\x09]|[\\x0D]|[\\x0A]|[\\x20]";
        $work = mb_ereg_replace($pattern, "", $str);
        if (strlen($work) <= 0) return "";

        $pattern = "[\\x09]";
        $str = mb_ereg_replace($pattern, " ", $str);

        return $str;
    }

    protected function returnJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        return;
    }

    protected function informDialog($message, $title, $type = 'warning', $refresh = 'yes')
    {
        if ($refresh == 'yes')
        {
            $modalRefresh = 'modal-refresh';
            $dataDismiss = '';
        }
        else
        {
            $modalRefresh = '';
            $dataDismiss = 'data-dismiss="modal"';
        }
        return '<div id="modalDialog" class="modal-dialog" style="width: 630px;">
                    <div id="modalContent" class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal"><span>×</span></button>
                            <h4><i class="fa fa-windows"></i>&nbsp;&nbsp;&nbsp;'.$title.'</h4>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="alert alert-'.$type.'">
                                    '.$message.'<br>
                                </div>
                                <hr>
                                <p>
                                    <button class="btn btn-primary '.$modalRefresh.'" '.$dataDismiss.' ><i class="fa fa-check"></i> Đồng ý</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
