<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     * @throws ValidationException
     */
    public function validation($request): array
    {
        return Validator::make($request, [
            'name' => 'required|min:5',
            'email' => 'required|email|min:5',
            'phone' => 'numeric|min:9',
            'message' => 'required|min:5',
        ], [], [
            'name',
            'email',
            'phone',
            'message',
        ])->validate();
    }
}
