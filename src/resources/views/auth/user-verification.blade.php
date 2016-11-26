@extends('allay::layout')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Verify Your Account
                </div>
                <div class="panel-body">

                    <p>
                        Your account is pending verification.
                    </p>

                    <p>
                        An email was sent to <code>{{Auth::user()->email}}</code>.

                    </p>

                    <hr/>

                    <div class="form-group">
                        <div class="col-md-12">
                            <a href="{{route('email-verification.resend')}}" class="btn btn-primary">
                                Resend Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
