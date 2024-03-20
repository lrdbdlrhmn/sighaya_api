@extends('layouts.master')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Report</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reports.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Report Type:</strong>
                            {{ $report->report_type }}
                        </div>
                        <div class="form-group">
                            <strong>Latlng:</strong>
                            {{ $report->latlng }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $report->description }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $report->status }}
                        </div>
                        <div class="form-group">
                            <strong>Manager Id:</strong>
                            {{ $report->manager_id }}
                        </div>
                        <div class="form-group">
                            <strong>Technical Id:</strong>
                            {{ $report->technical_id }}
                        </div>
                        <div class="form-group">
                            <strong>City Id:</strong>
                            {{ $report->city_id }}
                        </div>
                        <div class="form-group">
                            <strong>State Id:</strong>
                            {{ $report->state_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $report->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
