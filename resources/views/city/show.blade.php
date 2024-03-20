@extends('layouts.master')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show City</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cities.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $city->name }}
                        </div>
                        <div class="form-group">
                            <strong>Name Fr:</strong>
                            {{ $city->name_fr }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $city->description }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $city->status }}
                        </div>
                        <div class="form-group">
                            <strong>State :</strong>
                            {{ $city->state_name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
