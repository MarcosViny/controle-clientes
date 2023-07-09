<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CepController extends Controller
{
    public function consultarCep(Request $request)
    {
        $cep = $request->cep;

        try {
            $client = new Client([
                'verify' => false
            ]);
            $response = $client->get("https://viacep.com.br/ws/{$cep}/json/");

            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);


            return response($responseData, $statusCode);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ], 422);
        }
    }
}
