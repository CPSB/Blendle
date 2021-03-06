@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash message view instance --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-newspaper-o"></i> News messages

                        <div class="pull-right">
                            <a href="" class="btn btn-default btn-xs">
                                <i class="fa fa-search"></i> Search
                            </a>
                            <a href="{{ route('news.create') }}" class="btn btn-default btn-xs">
                                <i class="fa fa-plus"></i> New message
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (count($messages) > 0) {{-- Messages found --}}
                            <div class="table-responsive">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Author:</th>
                                            <th colspan="2">Title</th> {{-- Functions for the message. --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message) {{-- Loop through the news messages. --}}
                                            <tr>
                                                <td><strong>#{{ $message->id }}</strong></td>
                                            </tr>
                                        @endforeach {{-- END loop --}}
                                    </tbody>
                                </table>
                            </div>

                            {{ $messages->render() }} {{-- Paginateion view instance --}}
                        @else {{-- No messages found --}}
                            <div class="alert alert-info alert-important" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Info:</strong> There are no news messages found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection