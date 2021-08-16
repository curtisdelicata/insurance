<?php

require_once(APPPATH.'controllers/SalaryInterface.php');


class BonusSalary implements SalaryInterface
{
    public $month;
    public function __construct($month)
    {
        $this->month = $month;
    }

    public function payment_date()
    {
        $tenth_day_date = date("Y-m-d",strtotime(date('Y-m-10' )." +$this->month months"));
        $tenth_day = date("l",strtotime($tenth_day_date));
        if($tenth_day=='Saturday')
        {
            $tenth_day_date = date('Y-m-d',strtotime('+2 days',strtotime($tenth_day_date)));
        }else if($tenth_day=='Sunday'){
            $tenth_day_date = date('Y-m-d',strtotime('+1 days',strtotime($tenth_day_date)));
        }else{
            $tenth_day_date=$tenth_day_date;  
        }
        $tenth_day = date("l",strtotime($tenth_day_date));
        $data['payment_date'] = $tenth_day_date;
        $data['payment_day'] = date("l",strtotime($tenth_day));

        return $data;
    }
}
?>