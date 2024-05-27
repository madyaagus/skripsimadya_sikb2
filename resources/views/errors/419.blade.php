@extends('layouts.app')
@section('content')
    <div class="error-box">
        <h1>419</h1>
        <h3><i class="fa fa-warning"></i> Oops! Page Expired!</h3>
        <p>The page you requested was expired.</p>
        <a href="{{ route('/') }}" class="btn btn-custom">Back to Home</a>
    </div>
@endsection
