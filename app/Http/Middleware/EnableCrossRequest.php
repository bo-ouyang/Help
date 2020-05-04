<?php


namespace App\Http\Middleware;


class EnableCrossRequest {
    public function handle($request,\Closure $next){
       // $response = $next($request);
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Headers', '*');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        //$response->header('Content-Type','*');
        return $response;
        /*
        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, PATCH, DELETE',
            'Access-Control-Allow-Headers' => '*'
        ];

        if ($response instanceof $IlluminateResponse) {
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }
            echo 222;
            return $response;
        }

        if ($response instanceof $SymfonyResopnse) {
            foreach ($headers as $key => $value) {
                $response->headers->set($key, $value);
            }
            echo 33;
            return $response;
        }
        echo 11;*/
        return $response;
    }
}
