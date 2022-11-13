<?php
namespace App\Http\Traits;

use Rakibhstu\Banglanumber\NumberToBangla;
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
}