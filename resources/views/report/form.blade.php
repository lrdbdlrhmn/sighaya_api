<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('report_type') }}
            <select class="form-control" name="report_type" id="report_type">
                <option value="reason1">Manque d'eau</option>
                <option value="reason2">Fuite d'eau</option>
                <option value="reason3">Facture non distribuée</option>
                <option value="reason4">Erreur de relevé (réclamation sur la fact)</option>
                <option value="reason5">Fraude signalée</option>
                <option value="reason6">Autre</option>
            </select>
            
        </div>
        <div class="form-group">
            {{ Form::label('latlng') }}
            {{ Form::text('latlng', $report->latlng, ['class' => 'form-control' . ($errors->has('latlng') ? ' is-invalid' : ''), 'placeholder' => 'Latlng']) }}
            {!! $errors->first('latlng', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $report->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="form-group">
            {{ Form::label('region_id') }}
            <select class="form-control" name="region_id" id="region_id">
                @foreach ($regions as $item)
                    <option value="{{$item->id}}">{{$item->name_fr}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('city_id') }}
            <select class="form-control" name="city_id" id="city_id">
                @foreach ($cities as $item)
                    <option value="{{$item->id}}">{{$item->name_fr}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('state_id') }}
            <select class="form-control" name="state_id" id="state_id">
                @foreach ($states as $item)
                    <option value="{{$item->id}}">{{$item->name_fr}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="form-control" type="file" id="image" name="image" />
        </div>

        <div class="form-group">
            <input class="form-control" type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id" />
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>