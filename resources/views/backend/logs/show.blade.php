@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-file-text-o"></i> Activity logs from <strong>{{ $user->name }}</strong>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            @if (count($logs) > 0) {{-- There are logs --}}
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th class="col-md-3">Time</thcol-md-3>
                                    <th class="col-md-6">Description</th>
                                    <th class="col-md-3">User</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($logs as $log) {{-- Loop through the activity logs --}}
                                <tr>
                                    <td>{{ $log->created_at->diffForHumans() }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td><a href="{{ route('logs.show', $log->causer) }}">{{ $log->causer->email }}</a></td>
                                </tr>
                                @endforeach {{-- END loop --}}
                                </tbody>
                            </table>
                            @else {{-- There are no logs --}}
                            <div class="alert alert-info alert-important" role="alert">
                                <strong><i class="fa fa-info-circle"></i></strong> Info:
                                There are no activity logs in the system.
                            </div>
                            @endif
                        </div>

                        {{ $logs->render() }} {{-- Pagination view instance --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection