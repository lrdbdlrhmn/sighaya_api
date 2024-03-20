@extends('layouts.master')



@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Manager Region</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('manager-regions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('manager-region.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
