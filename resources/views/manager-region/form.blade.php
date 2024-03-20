<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('region_id') }}
            <select class="form-control" name="region_id" id="region_id">
                @foreach ($regions as $item)
                    <option value="{{$item->id}}">{{$item->name_fr}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            <select class="form-control" name="user_id" id="user_id">
                @foreach ($users as $item)
                    <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>