<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Response::macro('success', function($message, $data = null){
            if($data){
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => $data
                ]);
            }
            return response()->json([
                    'success' => true,
                    'message' => $message
                ]);

        });
        Response::macro('error', function($message, $status_code){
            return response()->json([
                'success' => false,
                'message' => $message
            ], $status_code );
        });
    }
}
