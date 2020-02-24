@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
          <div class="card text-white">
            <img class="card-img" src="https://www.gstatic.com/classroom/themes/img_coffee.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <h1 class="card-title">{{ $class_name }}</h1>
                    <h4 class="card-text">{{ $class_subject }}</h4>
                    <p class="card-text">
                        <div style="display: flex; height: 24px;">
                            <span>Class Code: {{ $referral_code }} &nbsp;</span>
                            <a href="#" style="color: white; height: 24px;" data-toggle="modal" data-target=".bd-example-modal-lg">
                                <i class="material-icons">crop_free</i>
                            </a>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 8rem; text-align: center;">
                {{ $referral_code }}
            </div>
        </div>
    </div>
    </div>
</div>
@endsection