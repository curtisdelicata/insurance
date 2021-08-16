<?php
function getPeriod($month)
{
    return date("M/y",strtotime(date('Y-m-01' )." +$month months"));
}
function __file_exist($filename)
{
    $CI = & get_instance();
    $file_exist=0;
    if(file_exists($CI->config->item('upload_dir').$filename))
    {
        $file_exist=1;
    }
    return $file_exist;
}
function location($filename)
{
    $CI = & get_instance();
    return $CI->config->item('app_upload_dir').$filename;
} 
function setHeader()
{
    return $header = array("Period","Basic Payment","Bonus Payment");
}

function fileOpen($filename)
{
    $CI = & get_instance();
    return $file = fopen($CI->config->item('upload_dir').$filename, 'wb');
}
function calcBasicPayment($month)
{
    $basic_payment_date = date("Y-m-t",strtotime(date('Y-m-01' )." +$month months"));
    $basic_payment_day = date("l",strtotime($basic_payment_date));
    if($basic_payment_day=='Saturday')
    {
        $basic_payment_date = date('Y-m-d',strtotime('-1 days',strtotime($basic_payment_date)));
    }else if($basic_payment_day=='Sunday'){
        $basic_payment_date = date('Y-m-d',strtotime('-2 days',strtotime($basic_payment_date)));
    }else{
        $basic_payment_date=$basic_payment_date;
    }
    $data['basic_payment_date'] = $basic_payment_date;
    $data['basic_payment_day'] = date("l",strtotime($basic_payment_date));

    return $data;
}

function calcBonusPayment($month)
{
    $tenth_day_date = date("Y-m-d",strtotime(date('Y-m-10' )." +$month months"));
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
    $data['tenth_day_date'] = $tenth_day_date;
    $data['tenth_day'] = date("l",strtotime($tenth_day));

    return $data;
}

?>