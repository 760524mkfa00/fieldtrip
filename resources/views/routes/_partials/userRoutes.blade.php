@foreach($routes as $route)
    <tr style="background-color: {!! $route->zone->color !!};">
{{--        <td><strong> {!! $route->id !!}</strong></td>--}}
        <td><strong> {!! $route->zone->zone !!}</strong></td>
        <td><strong> {!! $route->route_number !!}</strong></td>
        <td><strong> {!! $route->unit !!}</strong></td>
        <td><strong> {!! $route->end_time_am !!}</strong></td>
        <td>{!! $route->end_point_am !!}</td>
        <td>{!! $route->start_time_pm !!}</td>
        <td>{!! $route->start_point_pm !!}</td>
        <td>{!! $route->end_time_pm !!}</td>
    </tr>
@endforeach