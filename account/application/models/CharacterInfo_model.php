<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CharacterInfo_model extends CI_Model
{
    private $_dbo = 'account';
    private $_table = 'Account_Habitus';

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

    public function getCharacterInfo($acct_id)
    {

        $this->db->select('cAccName, nickName, Faction, level, exp');
        $this->db->where(array('acct_id' => $acct_id));
        $data = $this->db->get($this->_table)->result_array();
        return $data;
    }

    public function getUID($UID)
    {
        $this->db->select('cAccName');
        $this->db->where('cAccName', $UID);
        $data = $this->db->get('Account_Habitus')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * Desciption: Xử lý nạp card
     * @param $acct_id
     * @return bool|null
     */
    public function getYuanbao($acct_id)
    {
        $this->db->db_select('account');

        if (isset($acct_id) == false && mb_strlen($acct_id) < 1)
        {
            return NULL;
        }

        $this->db->select('nExtPoint, CountCard');
        $this->db->where('cAccName', $acct_id);
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
            'nExtPoint' => $newYuanbao,
            'CountCard' => $newCountCard
        );
        $this->db->where('cAccName', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getDateEndInfo($acct_id)
    {
        $this->db->select('dEndDate');
        $this->db->where(array('cAccName' => $acct_id));
        $data = $this->db->get("Account_Habitus")->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    public function logRegistAccount($acct_id, $date_end)
    {
        $data = array(
            'cAccName'       => $acct_id,
            'dEndDate'   => $date_end
        );
        $this->db->insert('Account_Habitus', $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function addDate($acct_id, $newDate)
    {
        $data = array(
            'dEndDate' => $newDate
        );
        $this->db->where('cAccName', $acct_id);
        $this->db->update($this->_table, $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }


}

