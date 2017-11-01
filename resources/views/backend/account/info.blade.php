<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-fw fa-info"></i> Account information:
    </div>
    <div class="panel-body">

        <form method="POST" action="{{ route('account.settings.info') }}" class="form-horizontal">
            @form($user)
            {{ csrf_field() }} {{--CSRF form field protection --}}

            <div class="form-group">
                <label class="control-label col-md-3">First and Lastname: <span class="text-danger">*</span></label>

                <div class="col-md-4 @error('firstName', 'has-error')">
                    <input type="text" class="form-control" placeholder="First name" @input('firstName')>
                    @error('firstName')
                </div>

                <div class="col-md-5 @error('lastName', 'has-error')">
                    <input type="text" class="form-control" placeholder="Last name" @input('lastName')>
                    @error('lastName')
                </div>
            </div>

            <div class="form-group @error('name', 'has-error')">
                <label class="control-label col-sm-3">Username: <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input class="form-control" placeholder="Your username" type="text" @input('name')>
                    @error('name')
                </div>
            </div>

            <div class="form-group @error('email', 'has-error')">
                <label class="control-label col-md-3">E-mail address: <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input class="form-control" placeholder="Your E-mail address" type="email" @input('email')>
                    @error('email')
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i> Save changes
                    </button>

                    <button type="reset" class="btn btn-link btn-sm">
                        <i class="fa fa-undo"></i> Cancel
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>