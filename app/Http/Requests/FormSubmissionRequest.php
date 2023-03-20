<?php

namespace App\Http\Requests;

use App\Rules\EmailFull;
use Illuminate\Foundation\Http\FormRequest;

class FormSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_symbol' => 'required|string|max:50|exists:companies,symbol',
            'email' =>  [
                'required',
                'email',
                new EmailFull
            ],
            'start_date' => 'required|date|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'company_symbol.required' => 'Please provide a company symbol.',
            'company_symbol.string' => 'The company symbol must be a string.',
            'company_symbol.max' => 'The company symbol may not be greater than :max characters.',
            'company_symbol.exists' => 'The company symbol is invalid or does not exist.',

            'email.required' => 'Please provide an email address.',
            'email.email' => 'Please provide a valid email address.',
            'email.exists' => 'The email address is invalid or does not exist.',

            'start_date.required' => 'Please provide a start date.',
            'start_date.date' => 'Please provide a valid start date in the format YYYY-MM-DD.',
            'start_date.before_or_equal' => 'The start date must be before or equal to the end date and today\'s date.',

            'end_date.required' => 'Please provide an end date.',
            'end_date.date' => 'Please provide a valid end date in the format YYYY-MM-DD.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'end_date.before_or_equal' => 'The end date must be before or equal to today\'s date.',
        ];
    }
}
