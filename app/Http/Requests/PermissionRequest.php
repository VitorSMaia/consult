<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     * @throws ValidationException
     */
    public function validation($request, $id = null)
    {
        $nameValidation = ['required', 'min:5', Rule::unique('roles')->ignore($id)];

        $request = Helper::prepareForValidation($request);


        return Validator::make($request, [
            'name' => $nameValidation,
        ], [], [
            'name' => 'role',
        ])->validate();
    }
}
