<?php
namespace App\Http\Traits;

use Rakibhstu\Banglanumber\NumberToBangla;
use DateTime;
trait Number{

    public static function num($number,$lang='en')
    {
        $toNumber=new NumberToBangla;
        if($lang=='en')
        {
            return $number;
        }
        return $toNumber->bnNum($number);
    }
    public static function bnMonth($month,$lang='en')
    {
        $toMonth=new NumberToBangla;
        if($lang=='en')
        {
            $dateObj   = DateTime::createFromFormat('!m', $month);
            return $monthName = $dateObj->format('F'); // March

        }
        return $toMonth->bnMonth($month);
    }


}