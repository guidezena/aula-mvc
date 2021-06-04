<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class APIController extends Controller
{
    public $loginAfterSignUp = true;

    public function login(Request $request)
    {
        $token = null;
        $camposJson = json_decode($request->getContent(), JSON_OBJECT_AS_ARRAY);
        $credenciais = [
            'email' => $camposJson['email'],
            'password' => $camposJson['password']
        ];
        try {
            if (!$token = JWTAuth::attempt($credenciais)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciais incorretas'
                ], 401);
            }
        } catch (JWTException $e) {

            return response()->json(['error' => 'Token não criado'], 500);
        }

        return response()->json(['success' => true, 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        $token = $request->query('token', 'blablabla');

        try {

            //$user = auth()->userOrFail();

            auth()->logout(true);

            return response()->json([
                'success' => true,
                'message' => 'Adeus :-( '
            ]);
        } catch (JWTException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Erro, ficarás comigo',
                'error_msg' => var_export($e)
            ], 500);
        }
    }
}
