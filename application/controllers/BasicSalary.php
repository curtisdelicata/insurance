<?php
require_once(APPPATH.'controllers/SalaryInterface.php');

class BasicSalary implements SalaryInterface
{
    public $month;
    public function __construct($month)
    {
        $this->month = $month;
    }

    public function payment_date()
    {
        $basic_payment_date = date("Y-m-t",strtotime(date('Y-m-01' )." +$this->month months"));
        $basic_payment_day = date("l",strtotime($basic_payment_date));
        if($basic_payment_day=='Saturday')
        {
            $basic_payment_date = date('Y-m-d',strtotime('-1 days',strtotime($basic_payment_date)));
        }else if($basic_payment_day=='Sunday'){
            $basic_payment_date = date('Y-m-d',strtotime('-2 days',strtotime($basic_payment_date)));
        }else{
            $basic_payment_date=$basic_payment_date;
        }
        $data['payment_date'] = $basic_payment_date;
        $data['payment_day'] = date("l",strtotime($basic_payment_date));
    
        return $data;
    }
}
?>