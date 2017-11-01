@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-3"> {{-- Sidebar menu --}}
                <div class="list-group">
                    <a href="#info" aria-controls="info" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-info-circle"></i> Account information
                    </a>
                    <a href="#security" aria-controls="security" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-key"></i> Account security
                    </a>
                </div>

                <div class="list-group">
                    <a href="" class="list-group-item list-group-item-danger">
                        <i class="fa fa-trash"></i> Account verwijderen.
                    </a>
                </div>
            </div> {{-- /Sidebar menu --}}

            <div class="col-md-9"> {{-- Content --}}
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="info">
                        @include('backend.account.info')
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="security">
                        @include('backend.account.security')
                    </div>
                </div>
            </div> {{-- /Content --}}
        </div>
    </div>
@endsection