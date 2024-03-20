@extends('layouts.master')
@push('css_file')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Report') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('reports.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
                                        
										<th>Report Type</th>
										<th>Latlng</th>
										<th>Description</th>
										<th>Status</th>
										<th>State</th>
                                        <th>City</th>
										<th>Region</th>
										<th>User</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            
                                            
											<td>{{ $report->report_type }}</td>
											<td>
                                            <a href="https://maps.google.com/?q={{ $report->latlng }}" rel="noopener nofollow" target="_blank">{{ $report->latlng }}</a>
                                            
                                            </td>
											<td>{{ $report->description }}</td>
											<td>{{ $report->status }}</td>
                                            <td>{{ $report->state }}</td>
											<td>{{ $report->city }}</td>
											<td>{{ $report->region }}</td>
                                            
											<td>{{ $report->user }}</td>

                                            <td>
                                                <form action="{{ route('reports.destroy',$report->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('reports.show',$report->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reports.edit',$report->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
@push('js_file')
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

    <script>

    $(function () {
        $('#example2').DataTable({
        "paging": true,
        "searching" : true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>
@endpush