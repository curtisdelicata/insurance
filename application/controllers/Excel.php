<?php

class Excel extends CI_Controller
{
    public $fileName;
    public function __construct()
    {
        $this->fileName = SALARY_CSV;
        parent::__construct();
    }
    function generate_csv()
    {
        $file_exist = __file_exist($this->fileName);
        $file = fileOpen($this->fileName);

        fputcsv($file, setHeader());

        for($i=1;$i<=12;$i++)
        {
            //////// Basic salary date/time ///////////
            $basicSalary = calcBasicPayment($i);
            ///// Bonus salary date/time/////////////
            $bonus = calcBonusPayment($i);
            fputcsv($file,array(getPeriod($i),$basicSalary['basic_payment_date'],$bonus['tenth_day_date']));
        }

        if($file_exist==1)
        {
            echo OVERWRIITEN_CSV_MSG.location($this->fileName);
        }else{
            echo CREATED_CSV_MSG.location($this->fileName);
        }
        fclose($file);
        exit;
    }
}
?>