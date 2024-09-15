<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // You can add your authorization logic here
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => ['required', 'max:255', Rule::unique('coupons')->ignore($this->id)],
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
            'max_uses' => 'required|integer|min:1',
            // 'email' => 'required|email',
            'course_id' => 'required_without:gap_analysis_id',
            // 'gap_analysis_id' => 'required_without:course_id',
        ];
    }
}
