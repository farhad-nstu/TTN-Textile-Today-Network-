@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><center><h3>{{ __('Verification Mail Sent') }}</h3></center></div>

                <div class="card-body">
                    <h2>Thanks for your registration</h2>
                    <p>Your account has been created. A verification email is sent to your account.
                        Please check your mail and click on the activation link. Thanks</p>
                    
                    <a href="{{ url('/')}}">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
