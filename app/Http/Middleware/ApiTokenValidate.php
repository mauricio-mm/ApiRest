<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Personal_access_tokens;

class ApiTokenValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Obtenha o token da requisição
        $token = $request->header('Authorization');

        // Verifique se o token está presente
        if ($token) {
            // Verifique se o token existe na tabela personal_tokens
            $personalToken = Personal_access_tokens::where('token', $token)->first();

            // Verifique se o token é válido
            if ($personalToken) {
                // Token válido, continue com a requisição
                return $next($request);
            }
        }

        // Token inválido ou ausente, retorne uma resposta de erro
        return response()->json(['error' => 'Token inválido'], 401);
    }
}
