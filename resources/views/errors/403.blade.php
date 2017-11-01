@extends('layouts.error')

@section('title', 'Forbidden')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><i class="fa fa-ban red"></i>@yield('title')</h1>
            <p class="lead">Sorry! You don't have access permissions for that on <em><span id="display-domain"></span></em>.</p>
            <p><a onclick=javascript:checkSite(); class="btn btn-default btn-lg green">Take Me To The Homepage</a>
                <script type="text/javascript">
                    function checkSite(){
                        var currentSite = window.location.hostname;
                        window.location = "http://" + currentSite;
                    }
                </script>
            </p>
        </div>
    </div>
    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happened?</h2>
                    <p class="lead">A 403 error status indicates that you don't have permission to access the file or page. In general, web servers and websites have directories and files that are not open to the public web for security reasons.</p>
                </div>
                <div class="col-md-6">
                    <h2>What can I do?</h2>
                    <p class="lead">If you're a site visitor</p>
                    <p>Please use your browsers back button and check that you're in the right place. If you need immediate assistance, please send us an email instead.</p>
                    <p class="lead">If you're the site owner</p>
                    <p>Please check that you're in the right place and get in touch with your website provider if you believe this to be an error.</p>
                </div>
            </div>
        </div>
    </div>
@endsection