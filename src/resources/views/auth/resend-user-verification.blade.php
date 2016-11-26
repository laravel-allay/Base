@extends('allay::layout')

<!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Email Verification Resent
                    </div>
                    <div class="panel-body">
                        <p>
                            Another verification email was sent to <code>{{Auth::user()->email}}</code>.

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
