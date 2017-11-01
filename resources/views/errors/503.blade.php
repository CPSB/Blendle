@extends('layouts.error')

@section('title', 'Under Maintenance')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><i class="fa fa-cogs green"></i> @yield('title') </h1>
            <p class="lead">The web server for <em><span id="display-domain"></span></em> is currently undergoing some maintenance.</p>
            <a href="javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center"><span class="green">Try This Page Again</span></a>
        </div>
    </div>

    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happened?</h2>
                    <p class="lead">Servers and websites need regular maintenance just like a car to keep them up and running smoothly.</p>
                </div>
                <div class="col-md-6">
                    <h2>What can I do?</h2>
                    <p class="lead">If you're a site visitor</p>
                    <p>If you need immediate assistance, please send us an email instead. We apologize for any inconvenience.</p>
                    <p class="lead">If you're the site owner</p>
                    <p>The maintenance period will mostly likely be very brief, the best thing to do is to check back in a few minutes and everything will probably be working normal again.</p>
                </div>
            </div>
        </div>
    </div>
@endsection