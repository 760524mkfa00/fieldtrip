<form action="" class="form-inline">
    <div class="form-group form-group-sm">
    <select id='myselect' class="form-control form-control-sm" name="selectedOption">
        <option value="Today" {!! \Session::get('dateRange')['selectedOption'] == 'Today' ? 'selected="selected"' : ''  !!}>Today</option>
        <option value="This Week" {!! \Session::get('dateRange')['selectedOption'] == 'This Week' ? 'selected="selected"' : ''  !!}>This Week</option>
        <option value="This month" {!! \Session::get('dateRange')['selectedOption'] == 'This month' ? 'selected="selected"' : ''  !!}>This month</option>
        <option value="Last Week" {!! \Session::get('dateRange')['selectedOption'] == 'Last Week' ? 'selected="selected"' : ''  !!}>Last Week</option>
        <option value="Next Week" {!! \Session::get('dateRange')['selectedOption'] == 'Next Week' ? 'selected="selected"' : ''  !!}>Next Week</option>
        <option value="Last month" {!! \Session::get('dateRange')['selectedOption'] == 'Last month' ? 'selected="selected"' : ''  !!}>Last month</option>
        <option value="Custom" {!! \Session::get('dateRange')['selectedOption'] == 'Custom' ? 'selected="selected"' : ''  !!}>Custom</option>
    </select>
    </div>
    <div class="form-group form-group-sm">
    <input type="text" name="start_range" id="start_range" class="form-control" value="{!! \Session::get('dateRange')['start_range'] ?? date('Y-m-d') !!}">
    </div>
    <div class="form-group form-group-sm">
    <input type="text" name="end_range" id="end_range" class="form-control" value="{!! \Session::get('dateRange')['end_range'] ?? date('Y-m-d') !!}">
    </div>
    <button type="submit" id="submit" class="btn btn-sm btn-primary">Submit</button>
</form>

