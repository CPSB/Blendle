<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-cogs fa-fw"></i> News message settings

        <a href="{{ route('news.index') }}" class="pull-right btn btn-xs btn-default">
            <i class="fa fa-undo"></i> Return to index
        </a>
    </div>

    <div class="panel-body">
        <div class="form-group col-md-4 @error('status', 'has-error')">
            <label> Status: <span class="text-danger">*</span></label>

            <select class="form-control" @input('status')>
                <option value="">-- Select the status for the news message --</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
            </select>
            @error('status')
        </div>

        <div class="form-group col-md-6 @error('release', 'has-error')">
            <label class="">
        </div>
    </div>
</div>