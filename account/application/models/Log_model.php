<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ============= LogRegAccount ==========
 * ID           int             [A]
 * acct_id      bigint          [A]
 * DateCreated  datetime        [A]
 * IP           nchar(30)       [A]
 * ====================================
 */
class Log_model extends CI_Model
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

    public function getCashLog($acct_id)
    {
        $this->db->select('DateCreated, TypeCard, SeriCard, CodeCard, MoneyCard, Status');
        $this->db->where('acc_Id', $acct_id);
        $data = $this->db->get($this->_table)->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }
    public function getTotalCashMonth($acct_id)
    {
        $firstMonthDay  = date('Y-m-01 00:00:00');
        $lastMonthDay   = date('Y-m-t 23:59:59');

        $arrayWhere = array(
            'DateCreated <=' => $lastMonthDay,
            'DateCreated >=' => $firstMonthDay,
            'acc_Id'        =>  $acct_id
        );

        $this->db->select('SUM(cast(MoneyCard as int)) AS TotalCashMonth', FALSE);
        $this->db->where($arrayWhere);
        $data = $this->db->get($this->_table)->result_array();

        if ($data[0]['TotalCashMonth'] == '')
        {
            return 0;
        }
        return $data[0]['TotalCashMonth'];
    }

    public function getCashLogList()
    {
        $this->db->select('cAccName, DateCreated, TypeCard, SeriCard, CodeCard, MoneyCard, Admin, Status');
        $data = $this->db->get("LogCard")->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    public function getDayLogList()
    {
        $this->db->select('cAccName, UpdateUser, Type, DateCreated, DateEnd, Status, DayAdd, LastDay');
        $data = $this->db->get("LogDate")->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    public function getWeeklyCCU($startDate, $endDate)
    {
        $this->db->select('player_count, create_time');

        $this->db->where('create_time <=', $endDate . ' 23:59:59');
        $this->db->where('create_time >=', $startDate . ' 00:00:00');
        $this->db->where('DATEPART(MINUTE, "create_time") =', '00');
        $data = $this->db->get('LogPlayerCount')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    public function getLastestLog()
    {
        $this->db->select('create_time');
        $this->db->limit(1);
        $data = $this->db->get('LogPlayerCount')->row(1);
        return $data->create_time;
    }

    public function getCashLogPerDay($startDate, $endDate)
    {
        $arrayWhere = array(
            'DateCreated <=' => $endDate,
            'DateCreated >=' => $startDate,
            'Status'         =>  1,
        );

        $this->db->where($arrayWhere);
        $this->db->select('MoneyCard, TypeCard, SUM(cast(MoneyCard as int)) AS Total, COUNT(MoneyCard) as Quantity', FALSE);
        $this->db->group_by('MoneyCard, TypeCard');
        $data = $this->db->get("LogCard")->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return array();
        }
        return $data;
    }

    public function getTotalRevenueAndPaidUsers($startDate, $endDate)
    {
        $sql = "SELECT COUNT(cAccName) as PaidUsers, CONVERT(VARCHAR(10),DateCreated ,111) as DateCreated , SUM(cast(MoneyCard as INT)) as Total";
        $sql .= " FROM LogCard WHERE DateCreated >= ? AND DateCreated <= ? AND Status = 1";
        $sql .= " GROUP BY CONVERT(VARCHAR(10),DateCreated ,111)";

        $data = $this->db->query($sql, array($startDate, $endDate))->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return array();
        }
        $result = array();
        foreach ($data as $key => $val)
        {
            $result[$val['DateCreated']] = $val;
        }
        return $result;
    }

    public function getRegAccountLog($startDate, $endDate)
    {
        $sql = " SELECT COUNT(acct_id) as RegUsers, COUNT(DISTINCT IP) as UniqueIPs, CONVERT(VARCHAR(10),DateCreated ,111) as DateCreated";
        $sql .= " FROM LogRegAccount WHERE DateCreated >= ? AND DateCreated <= ?";
        $sql .= " GROUP BY CONVERT(VARCHAR(10),DateCreated ,111)";

        $data = $this->db->query($sql, array($startDate, $endDate))->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return array();
        }
        $result = array();
        foreach ($data as $key => $val)
        {
            $result[$val['DateCreated']] = $val;
        }
        return $result;
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

    public function getTotalCashViaDay($date, $acct_id)
    {
        $this->db->select('SUM(cast(MoneyCard as int)) AS TotalCash');
        $this->db->where('DateCreated <=', $date . ' 23:59:59');
        $this->db->where('DateCreated >=', $date . ' 00:00:00');
        $this->db->where('cAccName', $acct_id);
        $data = $this->db->get($this->_table)->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return 0;
        }
        return $data[0]['TotalCash'];
    }

    public function addDayLogCard($acct_id, $status, $updateUser, $DateEnd, $type, $dayAdd, $lassDay)
    {
        $this->db->db_select('account');

        // Chuyển timezone về Việt Nam
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $data = array(
            'cAccName'      => $acct_id,
            'DateCreated'   => date("Y-m-d H:i:s"),
            'Status'        => $status,
            'UpdateUser'    => $updateUser,
            'DateEnd'       => $DateEnd,
            'Type'          => $type,
            'DayAdd'        => $dayAdd,
            'LastDay'        => $lassDay,
        );
        $this->db->insert('LogDate', $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }
}
