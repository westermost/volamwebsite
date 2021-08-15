<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Siniy
 */
class CashAdd extends Base_Controller
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
         // Load model Log
        $this->load->model('Log_model', 'Log');

        if ($this->getQuery('BeginDate') && $this->getQuery('EndDate'))
        {
            $startDate  = $this->getQuery('BeginDate');
            $startDate = $startDate . ' 00:00:00';

            $endDate    = $this->getQuery('EndDate');
            $endDate = $endDate . ' 23:59:59';
        }
        else
        {
            // First day of month
            $startDate  = date('Y-m-01 00:00:00');
            // Last day of month
            $endDate    = date('Y-m-t 23:59:59');
        }

        $cashLogData = $this->Log->getCashLogPerDay($startDate, $endDate);

        $cashLogBank        = array();
        $cashLogVina        = array();
        $cashLogViettel     = array();
        $cashLogMobi        = array();
        $cashLogGate        = array();
        $cashLogZing        = array();
        $cashLogOnCash      = array();
        $cashLogMega        = array();

        // Tổng số tiền đã ghi
        $total      = 0;
        $totalBanking   = 0;
        $totalVina      = 0;
        $totalMobi      = 0;
        $totalViettel   = 0;
        $totalGate      = 0;
        $totalZing      = 0;
        $totalOnCash    = 0;
        $totalMega      = 0;

        // Tổng số giao dịch đã ghi
        $quantityBanking    = 0;
        $quantityVina       = 0;
        $quantityMobi       = 0;
        $quantityViettel    = 0;
        $quantityGate       = 0;
        $quantityZing       = 0;
        $quantityOnCash     = 0;
        $quantityMega       = 0;

        foreach ($cashLogData as $log)
        {
            $total += $log['Total'];
            if ($log['TypeCard'] == 'Bank')
            {
                $totalBanking += ($log['MoneyCard'] * $log['Quantity']);
                $quantityBanking += $log['Quantity'];
                continue;
            }
            if ($log['TypeCard'] == 'Viettel')
            {
                $totalViettel += ($log['MoneyCard'] * $log['Quantity']);
                $quantityViettel += $log['Quantity'];
                $cashLogViettel[$log['MoneyCard']] = $log;
                continue;
            }
            if ($log['TypeCard'] == 'Mobi')
            {
                $totalMobi += ($log['MoneyCard'] * $log['Quantity']);
                $quantityMobi += $log['Quantity'];
                $cashLogMobi[$log['MoneyCard']] = $log;
                continue;
            }
            if ($log['TypeCard'] == 'Vina')
            {
                $totalVina += ($log['MoneyCard'] * $log['Quantity']);
                $quantityVina += $log['Quantity'];
                $cashLogVina[$log['MoneyCard']] = $log;
                continue;
            }
            if ($log['TypeCard'] == 'Gate')
            {
                $totalGate += ($log['MoneyCard'] * $log['Quantity']);
                $quantityGate += $log['Quantity'];
                $cashLogGate[$log['MoneyCard']] = $log;
                continue;
            }
            if ($log['TypeCard'] == 'Zing')
            {
                $totalZing += ($log['MoneyCard'] * $log['Quantity']);
                $quantityZing += $log['Quantity'];
                $cashLogZing[$log['MoneyCard']] = $log;
                continue;
            }
            if ($log['TypeCard'] == 'OnCash')
            {
                $totalOnCash += ($log['MoneyCard'] * $log['Quantity']);
                $quantityOnCash += $log['Quantity'];
                $cashLogOnCash[$log['MoneyCard']] = $log;
                continue;
            }
            if ($log['TypeCard'] == 'Megacard')
            {
                $totalMega += ($log['MoneyCard'] * $log['Quantity']);
                $quantityMega += $log['Quantity'];
                $cashLogMega[$log['MoneyCard']] = $log;
                continue;
            }
        }

        // Lấy ra tổng số tiền nạp thẻ từ điện thoại và nạp trực tiếp
        $data['total'] = $total;

        $data['startDate'] = $startDate;
        $data['endDate']   = $endDate;

        $data['cashLogBank']    = array($totalBanking, $quantityBanking);
        $data['totalVina']      = array($totalVina, $quantityVina);
        $data['totalMobi']      = array($totalMobi, $quantityMobi);
        $data['totalViettel']   = array($totalViettel, $quantityViettel);
        $data['totalGate']      = array($totalGate, $quantityGate);
        $data['totalZing']      = array($totalZing, $quantityZing);
        $data['totalOnCash']    = array($totalOnCash, $quantityOnCash);
        $data['totalMega']      = array($totalMega, $quantityMega);

        $data['cashLogViettel'] = $cashLogViettel;
        $data['cashLogVina']    = $cashLogVina;
        $data['cashLogMobi']    = $cashLogMobi;
        $data['cashLogGate']    = $cashLogGate;
        $data['cashLogZing']    = $cashLogZing;
        $data['cashLogOnCash']  = $cashLogOnCash;
        $data['cashLogMega']    = $cashLogMega;

        $data['template'] = array(
            'title' => 'CashAdd Report',
            'datePicker' => true
        );
        // Load view
        $this->load->view('Admin/Reports/cash_add_report_view', $data);
    }
}
