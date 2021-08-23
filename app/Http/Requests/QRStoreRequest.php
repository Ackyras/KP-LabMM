<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class QRStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $today  = Carbon::today();
        $now    = Carbon::now();
        return [
            //
            'valid_for'     =>  ['required', 'date', 'after_or_equal:' . $today],
            'valid_until'   =>  ['required', 'date', 'after_or_equal:' . $now],
            'token'         =>  ['required']
        ];
    }
}
