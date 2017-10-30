@foreach($routes as $route)
    <tr>
        <td><strong> {!! $route->id !!}</strong></td>
        <td><strong> {!! $route->zone->zone !!}</strong></td>
        <td><strong> {!! $route->route_number !!}</strong></td>
        <td><strong> {!! $route->end_time_am !!}</strong></td>
        <td>{!! $route->end_point_am !!}</td>
        <td>{!! $route->start_time_pm !!}</td>
        <td>{!! $route->start_point_pm !!}</td>
        <td>{!! $route->end_time_pm !!}</td>
        <td class="hidden-xs" style="width:2%;">
            <a title="Edit"
               href="{!! URL::route('update_route', $route->id) !!}"
               class="pull-right"><i class="fa fa-pencil-square-o fa"></i>
            </a>
        </td>
        <td class="hidden-xs" style="width:2%;">
            <a title="Remove"
               href="{!! URL::route('remove_route', $route->id) !!}"
               class="pull-right"><i class="fa fa-times"></i>
            </a>
        </td>
    </tr>
@endforeach