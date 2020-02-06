<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Autenticador
{
    public function handle(Request $request, \Closure $next)
    {
        try {
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer', '', $authorizationHeader);
            $dadosAutenticacao = JWT::decode($token, ENV('JWT_KEY'), ['S256']);
            $user = User::where('email', $dadosAutenticacao->email)->first();
            if (is_null($user)) {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            return response()->json('Não Autorizado', '401');
        }
        return $next($request);
    }
}
