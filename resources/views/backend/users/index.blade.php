@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> User management.

                        <span class="pull-right">
                            @if (count($users) > 20)
                                <a href="" class="btn btn-xs btn-default">
                                    <i class="fa fa-search"></i> Search user
                                </a>
                            @endif

                            <a href="{{ route('users.create') }}" class="btn btn-xs btn-default">
                                <i class="fa fa-plus"></i> Add user
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">

                        @if (count($users) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status:</th>
                                            <th>Name:</th>
                                            <th>Email:</th>
                                            <th colspan="2">Created At:</th> {{-- Colspan="2" needed for the functions --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user) {{-- Loop through the users --}}
                                            <tr>
                                                <td><strong>#{{ $user->id }}</strong></td>
                                                <td>{{-- Implementation status --}}</td>
                                                <td>{{ $user->name }}</td>
                                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                                <td>{{ $user->created_at->diffForHumans() }}</td>

                                                <td class="text-center"> {{-- Options --}}
                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-info-circle"></i>
                                                    </a>

                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-ban"></i>
                                                    </a>

                                                    <a href="{{ route('users.destroy', $user) }}" class="text-muted">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </a>
                                                </td> {{-- /Options --}}
                                            </tr>
                                        @endforeach {{-- END loop --}}
                                    </tbody>
                                </table>
                            </div>

                            {{ $users->render() }} {{-- Pagination view instance --}}
                        @else
                            <div class="alert alert-info alert-important" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Info:</strong>
                                There are no users found in the system.
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection