<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use ReflectionClass;

class AutoRouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        //
    }

    // protected function registerAutoRoutes()
    // {
    //     $controllerNamespace = 'App\\Http\\Controllers\\';
    //     $controllersPath = app_path('Http/Controllers');

    //     foreach (scandir($controllersPath) as $file) {
    //         if (Str::endsWith($file, 'Controller.php')) {
    //             $controllerClass = $controllerNamespace . pathinfo($file, PATHINFO_FILENAME);

    //             $reflection = new ReflectionClass($controllerClass);
    //             foreach ($reflection->getMethods() as $method) {
    //                 if ($method->isPublic() && !$method->isConstructor()) {
    //                     $methodName = $method->getName();

    //                     // Build route URL based on the controller and method name
    //                     $routeUrl = Str::kebab(str_replace('Controller', '', $reflection->getShortName())) . '/' . Str::kebab($methodName);

    //                     Route::get($routeUrl, [$controllerClass, $methodName]);
    //                 }
    //             }
    //         }
    //     }
    // }

    protected function registerAutoRoutes()
{
    $controllerNamespace = 'App\\Http\\Controllers\\';
    $controllersPath = app_path('Http/Controllers');

    foreach (scandir($controllersPath) as $file) {
        if (Str::endsWith($file, 'Controller.php')) {
            $controllerClass = $controllerNamespace . pathinfo($file, PATHINFO_FILENAME);

            $reflection = new ReflectionClass($controllerClass);
            foreach ($reflection->getMethods() as $method) {
                if ($method->isPublic() && !$method->isConstructor()) {
                    $methodName = $method->getName();

                    // Build route URL based on the controller and method name
                    $routeUrl = Str::kebab(str_replace('Controller', '', $reflection->getShortName())) . '/' . Str::kebab($methodName);

                    // Check if method has parameters
                    $parameters = $method->getParameters();
                    $routeParameters = '';

                    if (count($parameters) > 0) {
                        foreach ($parameters as $parameter) {
                            // Add each parameter to the route URL
                            $routeParameters .= '/{' . $parameter->getName() . '}';
                        }
                    }

                    // Register the route with or without parameters
                    Route::get($routeUrl . $routeParameters, [$controllerClass, $methodName]);
                }
            }
        }
    }
}

}
