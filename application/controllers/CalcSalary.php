<?php
require_once(APPPATH.'controllers/RequireClass.php');

class CalcSalary extends CI_Controller 
{
    public $fileName;
    public function __construct()
    {
        $this->fileName = SALARY_CSV;
        parent::__construct();
    }

    public function csv()
    {
        $file_exist = __file_exist($this->fileName);
        $file = fileOpen($this->fileName);
        
        fputcsv($file, setHeader());
        for($i=1;$i<=12;$i++)
        {
            $basic_salary_payment = new BasicSalary($i);
            $basic_salary_payment_date = $basic_salary_payment->payment_date();

            $bonus_salary_payment = new BonusSalary($i);
            $bonus_salary_payment_date = $bonus_salary_payment->payment_date();

            fputcsv($file,array(getPeriod($i),$basic_salary_payment_date['payment_date'],$bonus_salary_payment_date['payment_date']));
        }
        if($file_exist==1)
        {
            return OVERWRIITEN_CSV_MSG.location($this->fileName);
        }else{
            return CREATED_CSV_MSG.location($this->fileName);
        }
        fclose($file);
    }
} 

$onj =new CalcSalary();
echo $onj->csv();

?>