@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="https://techteachgoals.files.wordpress.com/2017/08/classroom.jpg" alt="Card image cap">
                <div class="card-body"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Microsoft_Account.svg/1200px-Microsoft_Account.svg.png" alt="Logo"
                                            style="border-radius: 50%;
    float: right;
    height: 4.6875rem;
    position: relative;
    margin-top: -5.8rem;
    width: 4.6875rem;
}">
                    <h5 class="card-title">Laravel Class</h5>
                    <p class="card-text">SUbject : haha</p>
                    <p class="card-text">Student: 80 nak</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">created 3 days ago</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
