<form action="" class="form-inline">
    <div class="form-group">
    <select id='myselect'>
        <option value="This Week">This Week</option>
        <option value="This month">This month</option>
        <option value="Last Week">Last Week</option>
        <option value="Next Week">Next Week</option>
        <option value="Last month">Last month</option>
        <option value="Custom">Custom</option>
    </select>
    </div>
    <div class="form-group">
    <input hidden type="text" name="start_range" id="start_range" value="{!! date('Y-m-d') !!}">
    </div>
    <div class="form-group">
    <input hidden type="text" name="end_range" id="end_range" value="{!! date('Y-m-d', strtotime("+1 week")) !!}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

