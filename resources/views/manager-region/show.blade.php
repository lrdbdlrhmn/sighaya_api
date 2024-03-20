@extends('layouts.master')
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Manager Region</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('manager-regions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Region Id:</strong>
                            {{ $managerRegion->region_namme }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $managerRegion->nni }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $managerRegion->phone }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
