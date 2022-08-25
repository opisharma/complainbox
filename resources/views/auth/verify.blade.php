@extends('layouts.frontend.app')
@section('title', 'Verify')
@section('content')
<div class="mb-4 text-center">
    {{-- <img src="{{asset('img/logo_nub.png')}}" width="180" alt="" /> --}}
    <img src="{{asset('assets/images/log-in-logo.png')}}" width="180" alt="" />
</div>
<div class="card">
    <div class="card-header text-center"><h3>{{ __('Verify Your Email Address') }}</h3></div>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>
</div>
@endsection
