@extends('layouts.app')

@section('content')
<link href="{{ asset('css/class-card.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        @forelse ($classrooms as $class)
            <p>{{$class}}</p>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <img class="card-img-top" height="100px" src="https://www.gstatic.com/classroom/themes/img_coffee.jpg" alt="Card image cap">
                    <div class="card-body">
                        <img id="background" src={{ $class->ownerImage }} alt="Logo">
                        <h5 class="card-title">{{ $class->class_name }}</h5>
                        <p class="card-text">មុខវិជ្ជា៖ {{ $class->class_subject }}</p>
                        <p class="card-text">ចំនួនសិស្ស៖ {{ $class->count }}</p>
                    </div>
                    <div class="card-footer">
                        <p id="created_date" data='{{ $class->created_at }}' class="text-muted">បានបង្កើតពេល {{ $class->createdAt }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>No Class</p>
        @endforelse
    </div>
</div>
<script src="{{ asset('js/moment.js') }}"></script>
<script>
$(document).ready(function() {
    
})
</script>
@endsection
