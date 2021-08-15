<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
    private $_dbo = 'account';
    private $_table = 'Account_Info';

    public function __construct()
    {
        parent::__construct();
        $this->db->db_select($this->_dbo);
    }

    public function setTable($table)
    {
        $this->_table = $table;
    }

    public function getTable()
    {
        return $this->_table;
    }

    public function getUserAuth($username, $password)
    {
        $this->db->select('iid, cAccName, cPassWord');
        $this->db->where(array('cAccName' => $username, 'cPassWord' => $password));
        $data = $this->db->get($this->_table)->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    // Phần admin quản lý.
    public function getAdminAuth($username, $password)
    {
        $this->db->select('ID, Username, Password');
        $this->db->where(array('Username' => $username, 'Password' => $password));
        $data = $this->db->get('Manager')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    public function getUserName($username)
    {
        $this->db->select('iid, cAccName', 'apiReg');
        $this->db->where('cAccName', $username);
        $data = $this->db->get($this->_table)->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }



    /**
     * Kiểm tra người dùng có nhập đúng vào đường dẫn quên mật khẩu từ email
     * @param  string $username loginName
     * @param  token $token    token
     * @return boolean           true/false
     */
    public function checkResetPassword($username, $token)
    {
        if (mb_strlen($username) <= 0 && mb_strlen($token) <= 0)
        {
            return false;
        }

        $this->db->select('acct_id');
        $this->db->where(array('cAccName' => $username, 'token' => $token));
        $data = $this->db->get($this->_table)->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return false;
        }
        return $data[0];
    }

    /**
     * Update token
     * @param  string $acctId acct_id
     * @param  token $token  token
     * @return boolean         true/false
     */
    public function updateToken($acctId, $token)
    {
        if (mb_strlen($acctId) <= 0 && mb_strlen($token) <= 0)
        {
            return false;
        }
        $data = array('token' => $token);
        $this->db->where('acct_id', $acctId);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getEmail($username)
    {
        $this->db->select('acct_id, useremail, cAccName');
        $this->db->where('cAccName', $username);
        $data = $this->db->get($this->_table)->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    public function addUser($username, $password, $password2, $api = '')
    {
        $data = array(
            'cAccName'      => $username,
            'cPassWord'     => $password,
            'cSecPassword'  => $password2
        );
        if (isset($api) && mb_strlen($api) > 0)
        {
            $data['apiReg'] = $api;
        }

        $this->db->insert($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function updateForgotPass($acct_id, $password_hash)
    {
        $data = array(
            'password_hash' => $password_hash
        );
        $this->db->where('acct_id', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function updateInventoryPass($acct_id, $randInvHash)
    {
        $data = array(
            'assetLockPassword' => $randInvHash
        );
        $this->db->where('acct_id', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function checkPasswordCorrect($acct_id, $oldPassword)
    {
        $this->db->select('cPassWord');
        $this->db->where('cAccName', $acct_id);
        $data = $this->db->get($this->_table)->result_array();
        if ($data[0]['cPassWord'] == $oldPassword)
        {
            return TRUE;
        }
        return FALSE;
    }

    public function changePassword($acct_id, $newPassword)
    {
        // ACCBD9B9F9BDA87BDFA33B01DB58BBDD5720BF2B2CD723ADEAAB2F21702ABBC4
        $data = array(
            'cPassWord' => $newPassword
        );

        $this->db->where('cAccName', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getAccountInfo($acct_id)
    {
        $this->db->select('cAccName, cEMail, iid, active_key, unlock');
        $this->db->where(array('cAccName' => $acct_id));
        $data = $this->db->get($this->_table)->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    public function getDateEndInfo($acct_id)
    {
        $this->db->select('dEndDate, nExtPoint');
        $this->db->where(array('cAccName' => $acct_id));
        $data = $this->db->get("Account_Habitus")->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * @description:
     *  - Add email cho user mới.
     *  - Add Active Key
     *  - Lock tài khoản lại.
     * @param $acct_id
     * @param $email
     * @return bool
     */
    public function addEmail($acct_id, $email, $active_key)
    {

        $data = array(
            'cEMail' => $email,
            'active_key' => $active_key
        );

        $this->db->where('cAccName', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function activeEmail($loginName, $active_key)
    {
        $data = array(
            'active_key' => $active_key
        );

        $this->db->where('cAccName', $loginName);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }


    public function verifyMail($loginName, $active_key)
    {
        if (mb_strlen($loginName) <= 0 || mb_strlen($active_key) <= 0)
        {
            return false;
        }

        $this->db->select('iid');
        $this->db->where(array('cAccName' => $loginName, 'active_key' => $active_key));
        $checkFlg = $this->db->count_all_results($this->_table);
        if ($checkFlg === 1)
        {
            return true;
        }
        return false;
    }

    /**
     * @Descriotion: Unlock và Lock account
     * @param $acct_id
     * @param $unLockKey
     * @return bool
     */

    public function addLock($acct_id, $unLockKey)
    {
        $data = array(
            'unlock' => $unLockKey
        );

        $this->db->where('cAccName', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function addUnLock($acct_id, $unLockKey)
    {
        $data = array(
            'unlock' => NULL
        );

        $this->db->where('acct_id', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function checkUnlockMail($loginName, $unLockKey)
    {
        if (mb_strlen($loginName) <= 0 || mb_strlen($unLockKey) <= 0)
        {
            return false;
        }

        $this->db->select('iid');
        $this->db->where(array('cAccName' => $loginName, 'unlock' => $unLockKey));
        $checkFlg = $this->db->count_all_results($this->_table);

        if ($checkFlg === 1)
        {
            return true;
        }
        return false;
    }

    public function unLockAccount($loginName)
    {
        $data = array(
            'unlock' => NULL
        );

        $this->db->where('cAccName', $loginName);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getManager($managerID)
    {
        if (isset($managerID) == false && mb_strlen($managerID) < 1)
        {
            return NULL;
        }

        $this->db->select('FullName');
        $this->db->where('ID', $managerID);
        $data = $this->db->get('Manager')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0]['FullName'];
    }

    /**
     * Desciption: Xử lý nạp card
     * @param $acct_id
     * @return bool|null
     */
    public function getYuanbao($acct_id)
    {
        $this->db->db_select('QGLAccount');

        if (isset($acct_id) == false && mb_strlen($acct_id) < 1)
        {
            return NULL;
        }

        $this->db->select('yuanbao, CountCard');
        $this->db->where('acct_id', $acct_id);
        $data = $this->db->get($this->_table)->result_array();
        $this->db->error();

        if (empty($data) && count($data) <= 0)
        {
            return FALSE;
        }
        return $data[0];

    }

    public function addYaunbao($acct_id, $newYuanbao, $newCountCard)
    {
        $data = array(
            'yuanbao' => $newYuanbao,
            'CountCard' => $newCountCard
        );
        $this->db->where('acct_id', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $acct_id
     * @param $cardSeri
     * @param $cardCode
     * @param $info_card
     * @param $cardType Nhà Mạng, Nạp qua Ngân Hàng = Bank
     * @param $status 1 = Thành Công, 0 = Thất Bại
     * @return bool
     */
    public function addLogCard($acct_id, $cardSeri, $cardCode, $money_card, $cardType, $status, $adminUser)
    {
        $this->db->db_select('account');

        // Chuyển timezone về Việt Nam
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $data = array(
            'cAccName' => $acct_id,
            'DateCreated' => date("Y-m-d H:i:s"),
            'SeriCard' => $cardSeri,
            'CodeCard' => $cardCode,
            'MoneyCard' => $money_card,
            'TypeCard' => $cardType,
            'Status' => $status,
            'Admin' => $adminUser,
        );
        $this->db->insert('LogCard', $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getAccountInfo_VIP()
    {
//        $sql  = "SELECT * FROM Account Order by 'CountCard' DESC";
//        $data = $this->db->query($sql);
        $this->db->select('acct_id, cAccName, useremail, phone , disconnect_time, CountCard');
        $this->db->order_by('CountCard', 'DESC');
        $data = $this->db->get($this->_table)->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    public function getUnDisAccount($acct_id)
    {

        $data = array(
            'iClientID' => 0
        );

        $this->db->where('cAccName', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function addLogCardEvent($acct_id)
    {
        $this->db->db_select('account');

        $data = array(
            'cAccName' => $acct_id,
        );
        $this->db->insert('Event_xu', $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }



}

