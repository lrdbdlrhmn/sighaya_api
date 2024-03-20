<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $region->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name_fr') }}
            {{ Form::text('name_fr', $region->name_fr, ['class' => 'form-control' . ($errors->has('name_fr') ? ' is-invalid' : ''), 'placeholder' => 'Name Fr']) }}
            {!! $errors->first('name_fr', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $region->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $region->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('city') }}
            <select class="form-control" name="city_id" id="city_id">
                @foreach ($cities as $item)
                    <option value="{{$item->id}}">{{$item->name_fr}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('state') }}
            <select class="form-control" name="state_id" id="state_id">
                @foreach ($states as $item)
                    <option value="{{$item->id}}">{{$item->name_fr}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>