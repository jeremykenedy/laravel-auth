<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Router;
use Illuminate\View\View;

class AdminDetailsController extends Controller
{
    public function listRoutes(Router $router): View
    {
        $routes = collect($router->getRoutes())->map(function ($route) {
            return [
                'methods' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName() ?? '',
                'action' => ltrim($route->getActionName(), '\\'),
                'middleware' => implode(', ', array_map(
                    fn ($m) => $m instanceof \Closure ? 'Closure' : (string) $m,
                    $route->gatherMiddleware()
                )),
            ];
        })->sortBy('uri')->values();

        return view('admin.routes', compact('routes'));
    }
}
