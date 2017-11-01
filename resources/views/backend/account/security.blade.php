<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-fw fa-info-circle"></i> Account security:
    </div>

    <div class="panel-body">

        <form method="POST" action="{{ route('account.settings.security') }}" class="form-horizontal">
            {{ csrf_field() }} {{-- CSRF field protection --}}

            <div class="form-group @error('password', 'has-error')">
                <label class="control-label col-md-3">Password: <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input type="password" class="form-control" placeholder="New password" @input('password')>
                    @error('password')
                </div>
            </div>

            <div class="form-group @error('password_confirmation')">
                <label class="control-label col-md-3">Password confirmation: <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input type="password" class="form-control" placeholder="Password confirmation" @input('password_confirmation')>
                    @error('password_confirmation')
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i> Save changes
                    </button>

                    <button type="reset" class="btn btn-link btn-sm">
                        <i class="fa fa-undo"></i> Candel
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>