@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- View flash message instance --}}

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }} {{-- FORM field protection --}}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-plus" aria-hidden="true"></span> Add news message.

                    <a href="{{ route('news.index') }}" class="pull-right btn btn-xs btn-default">
                        <i class="fa fa-undo"></i> Return to index
                    </a>
                </div>

                <ul class="list-group"> {{-- Form data --}}
                    <li class="list-group-item"> {{-- Algemene informatie --}}
                        <div class="row">
                            <div class="col-md-4">
                                <h4>General information:</h4>
                                <small>The title from the news message. And the new image.</small>
                            </div>
                            <div class="col-md-8 @error('name', 'has-error') mb-8">
                                <label>Title: <span class="text-danger">*</span></label>
                                <input placeholder="Your item title" class="form-control" type="text" @input('name')>
                                @error('name')
                            </div>

                            <div class="col-md-offset-4 col-md-8 @error('image','has-error') mb8">
                                <label>Image: <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" @input('image')>
                                @error('image')
                            </div>
                        </div>
                    </li> {{-- /Algemene informatie --}}

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Settings options:</h4>
                                <small>Date format: <strong>DD/MM/YYYY</strong></small>
                            </div>

                            <div class="col-md-4 mb-8 @error('publishDate', 'has-error')">
                                <label>Publish date: <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" @input('publishDate', \Carbon\Carbon::now()->format('d/m/Y'))>
                                @error('publishDate')
                            </div>

                            <div class="col-md-4 mb-8 @error('status', 'has-error')">
                                <label>Status: <span class="text-danger">*</label>
                                <select class="form-control" @input('status')>
                                    <option value="">-- Select the status for the post --</option>
                                    <option value="publish">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                                @error('status')
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>News Categories:</h4>
                                <small>The Categories are seperated by an comma character.</small>
                            </div>
                            <div class="col-md-8 mb-8 @error('tags', 'has-error')">
                                <label>Categories: <span class="text-danger">*</span></label>
                                <input class="form-control" placeholder="News categories" type="text" @input('tags')>
                                @error('tags')
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Your message: <span class="text-danger">*</span></h4>
                                <small>Describe wht u want to tell to the world.</small>
                            </div>
                            <div class="col-md-8 mb-8 @error('message', 'has-error')">
                                <label>Your message: <span class="text-danger">*</span></label>
                                <textarea class="form-control" placeholder="Describe what u want to tell." rows="8" @input('message')>@text('message')</textarea>
                                @if ($errors->has('message'))
                                    @error('message')
                                @else
                                    <small class="help-block">* This field is markdown supported.</small>
                                @endif
                            </div>
                        </div>
                    </li>

                </ul> {{-- /Form data --}}

                <div class="panel-footer text-right"> {{-- Buttons --}}
                    <button type="reset" class="btn btn-link btn-xs">
                        <i class="fa fa-undo"></i> Cancel
                    </button>

                    <button type="submit" class="btn btn-xs btn-success">
                        <i class="fa fa-check"></i> Save
                    </button>
                </div> {{-- END buttons --}}
            </div>
        </form>
    </div>
@endsection