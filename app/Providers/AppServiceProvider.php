<?php

namespace App\Providers;

use App\Services\Pets\PetClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            PetClient::class,
            function () {
                return new PetClient(
                    Http::baseUrl(config('services.petstore.url'))
                        ->timeout(config('services.petstore.timeout'))
                        ->acceptJson()
                            ->withOptions([
                                'verify' => false,
                            ])
                );
            }
        );
    }

    public function boot(): void
    {
    }
}
