@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Gebruiker toevoegen.

                        <a href="" class="btn btn-xs btn-default pull-right">
                            <i class="fa fa-undo"></i> Return to index
                        </a>
                    </div>

                    <div class="panel-body">

                        <form method="POST" action="{{ route('users.store') }}">
                            {{ csrf_field() }} {{-- CSRF field protection --}}

                            <div class="form-group col-md-12 @error('email', 'has-error')">
                                <label for="">Email address: <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" @input('email')>
                                @error('email')
                            </div>

                            <div class="form-group col-md-4 @error('firstName', 'has-error')">
                                <label>First name: <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" @input('firstName')>
                                @error('firstName')
                            </div>

                            <div class="form-group col-md-8 @error('lastName', 'has-error')">
                                <label>Last name: <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" @input('lastName')>
                                @error('lastName')
                            </div>

                            <div class="form-group col-md-12"> {{-- Submit and reset button --}}
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Save user
                                </button>

                                <button type="reset" class="btn btn-sm btn-link">
                                    <i class="fa fa-undo"></i> Cancel
                                </button>
                            </div> {{-- /END buttons --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection