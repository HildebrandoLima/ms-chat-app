<?php

namespace App\Http\Controllers;

use App\Exceptions\HttpInternalServerError;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class Controller extends BaseController
{
    public function get(Collection $success): Response
    {
        return response()->json([
            "message" => "Listagem efetuada com sucesso.",
            "data" => $success,
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function post(Collection|bool $success): Response
    {
        return response()->json([
            "message" => !is_bool($success) ? "Mensagem enviada com sucesso." : "Cadastro efetuado com sucesso.",
            "data" => !is_bool($success) ? $success[0] : $success,
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);        
    }

    public function put(bool $success): Response
    {
        return response()->json([
            "message" => "Edição efetuada com sucesso.",
            "data" => $success,
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function delete(): Response
    {
        return response()->json([
            "message" => "Deleção efetuada com sucesso.",
            "data" => [],
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function error(string $details): Response
    {
        throw new HttpResponseException(HttpInternalServerError::getResponse($details));
    }
}
