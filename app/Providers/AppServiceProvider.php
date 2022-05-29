<?php

namespace App\Providers;

use Illuminate\Database\QueryException;
use League\Fractal\Manager;
use App\Serializers\ArraySerializer;
use Illuminate\Support\ServiceProvider;
use Dingo\Api\Transformer\Adapter\Fractal;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
            $fractal = new Manager();
            $fractal->setSerializer(new ArraySerializer());
            return new Fractal($fractal, 'include', ',', false);
        });

        app('Dingo\Api\Exception\Handler')->register(function (AuthenticationException $e) {
            throw new UnauthorizedHttpException('Unauthenticated.');
        });

        app('Dingo\Api\Exception\Handler')->register(function (ModelNotFoundException $e) {
            throw new NotFoundHttpException('404 Not Found!');
        });

        app('Dingo\Api\Exception\Handler')->register(function (ValidationException $e) {
            throw new BadRequestHttpException($e->validator->errors()->first());
        });

        app('Dingo\Api\Exception\Handler')->register(function (QueryException $e) {
            throw new ServiceUnavailableHttpException(10, 'database error');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
