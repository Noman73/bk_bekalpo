<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Phone;
class phoneValidateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:admin');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $phone=Phone::where('id',$value)->where('user_id',auth()->user()->id)->where('status',1)->count();
        if($phone>0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong Phone Number Given.';
    }
}
