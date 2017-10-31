@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-ban text-danger"></i> Block: <strong>{{ $user->name }}</strong>

                        <a href="" class="pull-right btn btn-xs btn-default">
                            <i class="fa fa-undo"></i> Return to index
                        </a>
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('users.ban.store', $user) }}">
                            @form($user)

                            {{ csrf_field() }} {{-- CSRF form field protection --}}

                            <div class="form-group col-md-4 @error('name', 'has-error')">
                                <label>Username: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" disabled @input('name')>
                                @error('name')
                            </div>

                            <div class="form-group col-md-4 @error('email', 'has-error')">
                                <label>Email: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" disabled @input('email')>
                                @error('email')
                            </div>

                            <div class="form-group col-md-8 @error('endDate', 'has-error')">
                                <label>Expire date: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" @input('endDate')>
                                @if ($errors->has('endDate'))
                                    @error('endDate')
                                @else
                                    <small class="help-block"><span class="text-danger">*</span> Format: DD/MM/YYYY</small>
                                @endif
                            </div>

                            <div class="form-group col-md-12 @error('reason', 'has-error')">
                                <label>Block reason: <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="7" @input('reason')>@text('reason')</textarea>
                                @if ($errors->has('reason'))
                                    @error('reason')
                                @else
                                    <small class="help-block">
                                        <span class="text-danger">*</span> The reason will be mailed to the user.
                                    </small>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i> Block user
                                </button>

                                <button type="reset" class="btn btn-sm btn-link">
                                    <i class="fa fa-close"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection