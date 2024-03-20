<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('first_name') }}
            {{ Form::text('first_name', $user->first_name, ['class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : ''), 'placeholder' => 'First Name']) }}
            {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('last_name') }}
            {{ Form::text('last_name', $user->last_name, ['class' => 'form-control' . ($errors->has('last_name') ? ' is-invalid' : ''), 'placeholder' => 'Last Name']) }}
            {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nni') }}
            {{ Form::text('nni', $user->nni, ['class' => 'form-control' . ($errors->has('nni') ? ' is-invalid' : ''), 'placeholder' => 'Nni']) }}
            {!! $errors->first('nni', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('phone') }}
            {{ Form::text('phone', $user->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Phone']) }}
            {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_type') }}
            <select class="form-control" name="user_type" id="user_type">
                <option value="user">Utilisateur</option>
                <option value="manager">Administrateur technique</option>
                <option value="technical">Technicien</option>
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('whatsapp') }}
            {{ Form::text('whatsapp', $user->whatsapp, ['class' => 'form-control' . ($errors->has('whatsapp') ? ' is-invalid' : ''), 'placeholder' => 'Whatsapp']) }}
            {!! $errors->first('whatsapp', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            {{ Form::label('password') }}
            {{ Form::text('password', $user->password, ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password']) }}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('region') }}
            <select class="form-control" name="region_id" id="region_id">
                @foreach ($regions as $item)
                    <option value="{{$item->id}}">{{$item->name_fr}}</option>
                @endforeach
            </select>
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