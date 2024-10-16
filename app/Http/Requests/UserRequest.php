<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
    public function validation($request, $id = null): array
    {


        if($id) {
            $emailValidation = ['required', 'email', Rule::unique('users')->ignore($id)];
            $phoneValidation = ['required', 'min:2', Rule::unique('users')->ignore($id)];
            $cpfValidation = ['required','min:11', Rule::unique('users')->ignore($id)];
            $passwordValidation = ['sometimes', 'confirmed', Password::min(8)->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()];
        }else {
            $emailValidation = ['required', 'email', Rule::unique('users')];
            $phoneValidation = ['required', 'min:2', Rule::unique('users')];
            $cpfValidation = ['required','min:11', Rule::unique('users')];
            $passwordValidation = ['required', 'confirmed', Password::min(8)->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()];
        }


        $request = Helper::prepareForValidation($request);

        return Validator::make($request, [
            'full_name' => 'required|min:5',
            'cpf_cnpj' => $cpfValidation,
            'email' => $emailValidation,
            'phone' => $phoneValidation,
            'password' => $passwordValidation,
            'status' => 'sometimes',
            'office' => 'sometimes',
            'company' => 'sometimes',
            'permission' => 'sometimes',
            'color' => 'sometimes',
        ], [], [
            'name' => 'nome',
            'cpf_cnpj' => 'cpf/cnpj',
            'phone' => 'telefone',
            'password' => 'senha',
            'office' => 'cargo',
            'company' => 'empresa',
            'color' => 'cor',
        ])->validate();
    }
}
