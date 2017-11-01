@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- View flash message instance --}}

        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <form method="POST" action="">
                    {{ csrf_field() }} {{-- CSRF form field protection --}}

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="message">
                            @include('backend.news.panels.message')
                        </div>
                        <div role="tabpanel" class="tab-pane" id="settings">
                            @include('backend.news.panels.settings')
                        </div>
                        <div role="tabpanel" class="tab-pane" id="seo">
                            @include('backend.news.panels.seo')
                        </div>
                    </div>
                </form>
            </div> {{-- /END content --}}

            <div class="col-md-3"> {{-- option menu --}}
                <div class="list-group">
                    <a href="#" class="list-group-item disabled"><i class="fa fa-fw fa-list"></i> Options:</a>
                    <a href="#message" aria-controls="message" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-file-text-o"></i> Message
                    </a>
                    <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-cogs"></i> Settings
                    </a>
                    <a href="#seo" aria-controls="seo" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-code"></i> SEO
                    </a>
                </a>
            </div> {{-- /END option menu --}}
        </div>
    </div>
@endsection