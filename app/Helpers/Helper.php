<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function checkPermission($permissions)
    {
        return Auth::user()->hasAnyPermission($permissions);
    }

    public static function prepareForValidation($request)
    {
        $requestNew = $request;

        if(isset($request['cpf_cnpj'])) {
            $requestNew['cpf_cnpj'] = str_replace(['.', '-', '/'],'',$request['cpf_cnpj']);

            if(strlen($request['cpf_cnpj']) > 11 && strlen($request['cpf_cnpj']) < 14) {
                $requestNew['cpf_cnpj'] = '';
            }

            $requestNew['cpf_cnpj'] = str_replace(['.','/','-'], '', $request['cpf_cnpj']);
        }

        if(isset($request['phone'])) {
            $requestNew['phone'] = str_replace(['(', ')', '.', '/', '-', ' '], '', $request['phone']);
        }

        if(isset($request['estimated_safe'])) {
            $request['estimated_safe'] = str_replace('.', '', $request['estimated_safe']);
            $request['estimated_safe'] = str_replace(',', '.', $request['estimated_safe']);
            $requestNew['estimated_safe'] = floatval($request['estimated_safe']);
        }

        return $requestNew;
    }


    public static function msgMethod($key = 'DEFAULT')
    {

        $msg = [
         'DEFAULT' => 'Algo Aconteceu...',
         'INDEX_SUCCESS' => 'Registros listados com sucesso.',
         'INDEX_FAIL' => 'Falha ao listar registros.',
         'FIND_SUCCESS' => 'Registro encontrado com sucesso.',
         'FIND_FAIL' => 'Falha ao encontrar registro.',
         'CREATE_UPDATE_SUCCESS' => 'Registro cadastrado/atualizado com sucesso.',
         'CREATE_UPDATE_FAIL' => 'Falha ao criar/atualizar registro.',
         'UPDATE_SUCCESS' => 'Registro atualizado com sucesso.',
         'DELETE_SUCCESS' => 'Registro deletado com sucesso.',
         'DELETE_FAIL' => 'Falha ao deletar registro.',
        ];

        return $msg[$key];
    }
}