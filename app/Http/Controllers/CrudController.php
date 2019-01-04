<?php

namespace App\Http\Controllers;

use Artisan;
use File;
use Illuminate\Http\Request;
use Redirect;
use Response;
use View;

class CrudController extends Controller
{
    /**
     * Display generator.
     *
     * @return Response
     */
    public function getGenerator()
    {
        return view('crudmanagement.add-crud');
    }


    /**
     * Process generator.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postGenerator(Request $request)
    {
        $commandArg = [];
        $commandArg['name'] = $request->crud_name;

        // Make sure we do not already have this module
        $directories = glob(base_path().'/resources/views/*', GLOB_ONLYDIR);
        foreach ($directories as $dir) {
            $this_name = str_replace(base_path().'/resources/views/', '', $dir);
            $used_names[] = $this_name;
        }

        if (in_array(strtolower($request->crud_name), $used_names)) {
            return Redirect::back()->withErrors(['Name Exists or Restricted']);
        }

        if ($request->has('fields')) {
            $fieldsArray = [];
            $validationsArray = [];
            $x = 0;
            foreach ($request->fields as $field) {
                if ($request->fields_required[$x] == 1) {
                    $validationsArray[] = $field;
                }

                $fieldsArray[] = $field.'#'.$request->fields_type[$x];

                $x++;
            }

            $commandArg['--fields'] = implode(';', $fieldsArray);
        }

        if (!empty($validationsArray)) {
            $commandArg['--validations'] = implode('#required;', $validationsArray).'#required';
        }

        if ($request->has('route')) {
            $commandArg['--route'] = $request->route;
        }

        if ($request->has('view_path')) {
            $commandArg['--view-path'] = $request->view_path;
        }

        if ($request->has('controller_namespace')) {
            $commandArg['--controller-namespace'] = $request->controller_namespace;
        }

        if ($request->has('model_namespace')) {
            $commandArg['--model-namespace'] = $request->model_namespace;
        }

        if ($request->has('route_group')) {
            $commandArg['--route-group'] = $request->route_group;
        }

        if ($request->has('relationships')) {
            $commandArg['--relationships'] = $request->relationships;
        }

        if ($request->has('form_helper')) {
            $commandArg['--form-helper'] = $request->form_helper;
        }

        if ($request->has('soft_deletes')) {
            $commandArg['--soft-deletes'] = $request->soft_deletes;
        }

        try {
            Artisan::call('crud:generate', $commandArg);

            $menus = json_decode(File::get(base_path('resources/laravel-admin/menus.json')));

            $name = $commandArg['name'];
            $routeName = ($commandArg['--route-group']) ? $commandArg['--route-group'].'/'.snake_case($name, '-') : snake_case($name, '-');

            $menus->menus = array_map(function ($menu) use ($name, $routeName) {
                if ($menu->section == 'Resources') {
                    array_push($menu->items, (object) [
                        'title' => $name,
                        'url'   => '/'.$routeName,
                    ]);
                }

                return $menu;
            }, $menus->menus);

            File::put(base_path('resources/laravel-admin/menus.json'), json_encode($menus));

            Artisan::call('migrate');
        } catch (\Exception $e) {
            return Response::make($e->getMessage(), 500);
        }

        return redirect('crud')->with('flash_message', 'Your CRUD has been generated. See on the menu.');
    }
}
