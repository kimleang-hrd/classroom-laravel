@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6" style="text-align: center;">
            <a href="{{ url('/redirect') }}" class="btn btn-primary">Login with Facebook</a>
        </div>
    </div>
</div>
@endsection
