@extends('layouts.master')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show State</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('states.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $state->name }}
                        </div>
                        <div class="form-group">
                            <strong>Name Fr:</strong>
                            {{ $state->name_fr }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $state->description }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $state->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
