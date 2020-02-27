@extends('layouts.app')

@section('content')
<link href="{{ asset('css/class-card.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        @forelse ($classrooms as $class)
            @if ($class->owner_id == Auth::user()->id)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="nav-link" href="#" id="moreButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: blue;" href="#" data-toggle="modal" data-target="#classUpdate{{$class->id}}">កែប្រែថ្នាក់</a>
                                <a class="dropdown-item btnDelete" style="color: red;" href="#" data-toggle="modal" data-target="#class{{$class->id}}">លុបថ្នាក់</a>
                            </div>
                            <a class="cards" href={{ url('/class/'.$class->id) }}>
                                <img class="card-img-top" height="100px" src="https://www.gstatic.com/classroom/themes/img_coffee.jpg" alt="Card image cap">
                            </a>
                        </div>
                        <a class="cards" href={{ url('/class/'.$class->id) }}>
                            <div class="card-body">
                                <img id="profile" src={{ $class->ownerImage }} alt="Logo">
                                <h5 class="card-title">{{ $class->class_name }}</h5>
                                <p class="card-text">មុខវិជ្ជា៖ {{ $class->class_subject }}</p>
                                <p class="card-text">ចំនួនសិស្ស៖ {{ $class->count }}</p>
                            </div>
                            <div class="card-footer">
                                <p id="created_date" data='{{ $class->created_at }}' class="text-muted">បានបង្កើតពេល {{ $class->createdAt }}</p>
                            </div>
                        </a>    
                    </div>
                </div>

                <div class="modal fade bd-example-modal-sm" id="class{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteClassLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteClassLabel">លុបថ្នាក់</h5>
                                <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>ប្រសិនបើអ្នកលុបថ្នាក់នេះសិស្សរបស់អ្នកនឹងមិនអាចធ្វើកិច្ចការផ្ទះបានទៀតទេ។</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger closeButton" data-dismiss="modal">បិទ</button>
                                <a href={{ url('/class/delete/'.$class->id) }} type="submit" class="btn btn-primary">លុបចោល</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Class Modal -->
                <div class="modal fade bd-example-modal-sm" id="classUpdate{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="updateClassLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateClassLabel">កែប្រែថ្នាក់</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action={{ url('/class/update/'.$class->id) }} method="POST">
                                @csrf
                                <div class="modal-body">
                                    <input type="text" name="className" class="form-control form-control-sm" placeholder="ឈ្មោះថ្នាក់ (ត្រូវការចាំបាច់)">
                                    <br>
                                    <input type="text" name="classSubject" class="form-control form-control-sm" placeholder="ប្រធានបទ">
                                    <br>
                                    <input type="text" name="classDesc" class="form-control form-control-sm" placeholder="ព័ត៏មានថ្នាក់">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">បិទ</button>
                                    <button type="submit" class="btn btn-primary">រក្សារទុក</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @else
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="nav-link" href="#" id="moreButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: red;" href="#" data-toggle="modal" data-target="#leaveClass{{$class->id}}">ចាកចេញ</a>
                                <a class="dropdown-item btnDelete" style="color: green;" href="#" data-toggle="modal" data-target="#reportAbuse">រាយការណ៍ការបំពាន</a>
                            </div>
                            <a class="cards" href={{ url('/class/'.$class->id) }}>
                                <img class="card-img-top" height="100px" src="https://www.gstatic.com/classroom/themes/img_coffee.jpg" alt="Card image cap">
                            </a>
                        </div>
                        <a class="cards" href={{ url('/class/'.$class->id) }}>
                            <div class="card-body">
                                <img id="profile" src={{ $class->ownerImage }} alt="Logo">
                                <h5 class="card-title">{{ $class->class_name }}</h5>
                                <p class="card-text">មុខវិជ្ជា៖ {{ $class->class_subject }}</p>
                                <p class="card-text">ចំនួនសិស្ស៖ {{ $class->count }}</p>
                            </div>
                            <div class="card-footer">
                                <p id="created_date" data='{{ $class->created_at }}' class="text-muted">បានបង្កើតពេល {{ $class->createdAt }}</p>
                            </div>
                        </a>    
                    </div>
                </div>

                <div class="modal fade bd-example-modal-sm" id="leaveClass{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteClassLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteClassLabel">ចាកចេញ</h5>
                                <button type="button" class="close closeButton" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>ប្រសិនបើអ្នកលុបថ្នាក់នេះសិស្សរបស់អ្នកនឹងមិនអាចធ្វើកិច្ចការផ្ទះបានទៀតទេ។</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger closeButton" data-dismiss="modal">បិទ</button>
                                <a href={{ url('/class/leave/'.$class->id) }} type="submit" class="btn btn-primary">លុបចោល</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <p>No Class</p>
        @endforelse
    </div>

</div>
@endsection
