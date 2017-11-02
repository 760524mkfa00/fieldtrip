<?php

namespace Fieldtrip\Http\Controllers;

use Fieldtrip\Route;
use Illuminate\Http\Request;
use Fieldtrip\Http\Requests\StoreRoute as StoreRouteRequest;
use Fieldtrip\Http\Requests\UpdateRoute as UpdateRouteRequest;

class RouteController extends Controller
{

    public function index()
    {
        $routes = Route::with('zone')->get();
        return view('routes.index', compact('routes'));
    }

    public function create()
    {
        return view('routes.create')
            ->withRoute(new Route());
    }

    public function store(StoreRouteRequest $request)
    {
        $data = $request->only('zone_id', 'route_number', 'end_time_am', 'end_point_am', 'start_time_pm', 'start_point_pm', 'end_time_pm','unit');


        $route = Route::create($data);

        return redirect()->route('edit_route', ['id' => $route->id]);
    }

    public function edit(Route $route)
    {
        return view('routes.edit', compact('route'));
    }


    public function update(Route $route, UpdateRouteRequest $request)
    {
        $data = $request->only('zone_id', 'route_number', 'end_time_am', 'end_point_am', 'start_time_pm', 'start_point_pm', 'end_time_pm','unit');
        $route->fill($data)->save();
        return \Redirect::route('list_routes')->with('flash_message', 'Route has been updated.');
    }

    public function destroy(Route $route)
    {

        try {
            $route->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('list_routes')->with('flash_message', 'Route has been removed.');

    }

}
