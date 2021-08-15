<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * =========== OnlineEvent ===========
 * ID           int AI
 * Day          int
 * ItemID1      int     NULL
 * ItemID2      int     NULL
 * ItemName1    nvarchar(300) NULL
 * ItemName2    nvarchar(300) NULL
 * ItemType1    int
 * ItemType2    int
 * Quantity1    int
 * Quantity2    int
 * Image1       int
 * Image2       int
 * ========= OnlineEventUser =========
 * ID               int AI
 * acct_id          int
 * day_received     int
 * last_received    datetime null
 * ====================================
 */
class Event_model extends CI_Model {
    private $_dbo = 'QGLAccount';
    private $_table = 'OnlineEvent';

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

    private function _setFields($type)
    {
        $ItemID     = 'ItemID' . $type;
        $ItemName   = 'ItemName' . $type;
        $ItemType   = 'ItemType' . $type;
        $Quantity   = 'Quantity' . $type;
        $Image      = 'Image' . $type;
        return compact('ItemID', 'ItemName', 'ItemType', 'Quantity', 'Image');
    }

    public function saveOnlineEventItem($data, $type, $option = 'insert')
    {
        if (count($data) <= 0 || mb_strlen($type) < 1)
        {
            return false;
        }

        $fileds = $this->_setFields($type);

        $queryBuilder = array(
            'Day'       => $data['day'],
            $fileds['ItemID']    => $data['itemID'],
            $fileds['ItemName']  => self::NVARCHAR . $data['itemName'],
            $fileds['ItemType']  => $data['itemType'],
            $fileds['Quantity']  => $data['quantity'],
            $fileds['Image']     => $data['image'],
        );

        if ($option == 'insert')
        {
            $this->db->insert('OnlineEvent', $queryBuilder);
        }
        else
        {
            unset($queryBuilder['Day']);
            $this->db->where('Day', $data['day']);
            $this->db->update('OnlineEvent', $queryBuilder);
        }

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function checkEventDay($day, $type)
    {
        $this->db->where('Day', $day);
        $dayOnlineEvent = $this->db->get('OnlineEvent')->result_array();
        if (count($dayOnlineEvent) <= 0)
        {
            return true;
        }
        return false;
    }

    public function getEventOnlineGifts()
    {
        $arrayWhere = range(1, 24);
        $this->db->where_in('Day', $arrayWhere);
        $data = $this->db->get('OnlineEvent')->result_array();

        if (count($data) <= 0 && empty($data))
        {
            return NULL;
        }
        foreach ($data as $key => $val)
        {
            $dataOnlineGift[$val['Day']] = $val;
        }

        return $dataOnlineGift;
    }

    public function getEventOnlineGiftByDay($day, $type)
    {
        if ($type != 1 && $type != 2)
        {
            return NULL;
        }
        $ItemID     = 'ItemID' . $type;
        $ItemName   = 'ItemName' . $type;
        $ItemType   = 'ItemType' . $type;
        $Quantity   = 'Quantity' . $type;
        $this->db->select("$ItemID, $ItemName, $ItemType, $Quantity");
        $this->db->where('Day', $day);
        $data = $this->db->get('OnlineEvent')->result_array();
        if (empty($data))
        {
            return NULL;
        }
        return $data[0];
    }

    public function getEventUserInfo($acct_id)
    {
        $this->db->where('acct_id', $acct_id);
        $data = $this->db->get('OnlineEventUser')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    public function saveEventUserInfo($data, $type = 'update')
    {
        $params = array();
        if (isset($data['day_received']))
        {
            $params['day_received'] = $data['day_received'];
        }
        if (isset($data['last_received']))
        {
            $params['last_received'] = $data['last_received'];
        }

        if ($type == 'update')
        {
            $this->db->where('acct_id', $data['acct_id']);
            $this->db->update('OnlineEventUser', $params);
        }
        else
        {
            $params['acct_id'] = $data['acct_id'];
            $this->db->insert('OnlineEventUser', $params);
        }

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }
}
