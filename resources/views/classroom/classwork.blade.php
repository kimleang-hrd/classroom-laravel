@extends('layouts.home')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/classwork.css') }}">
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <div class="card text-white">
                <img class="card-img" src="https://www.gstatic.com/classroom/themes/img_coffee.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <h1 class="card-title">{{ $class->class_name }}</h1>
                    <h4 class="card-text">{{ $class->class_subject }}</h4>
                    <p class="card-text">
                        <div style="display: flex; height: 24px;">
                            <span>លេខកូដថ្នាក់: {{ $class->referral_code }} &nbsp;</span>
                            <a href="#" style="color: white; height: 24px;" data-toggle="modal" data-target="#referral_code">
                                <i class="material-icons">crop_free</i>
                            </a>
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="referral_code" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: 8rem; text-align: center;">
                    {{ $class->referral_code }}
                </div>
            </div>
        </div>
    </div>

    @if ($class->owner_id == Auth::user()->id)
        <div class="row justify-content-md-center" style="margin-top: 25px">
            <div class="col-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createClasswork">បង្កើតការងារ</button>
            </div>
        </div>
    @endif

    <div class="row justify-content-md-center">
        <div class="col-12">
            <ul>
                @forelse($classworks as $classwork)
                    <li id={{$classwork->id}} class="classworks" data-toggle="modal" data-target="#classwork{{$classwork->id}}">
                        <div class="classworks-div">
                            <span class="title">{{$classwork->title}}</span>
                            <a class="more" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: red;" href="#" data-toggle="modal" data-target="#classwork{{$classwork->id}}">លុបការងារ</a>
                                <a class="dropdown-item" style="color: blue;" href="#" data-toggle="modal" data-target="#exampleModal">កែប្រែការងារ</a>
                            </div>
                            <span class="posted_time">{{$classwork->createdAt}}</span>
                        </div>
                    </li>

                    @if($class->owner_id == Auth::user()->id)
                        <div class="modal fade bd-example-modal-lg" id="classwork{{$classwork->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$classwork->title}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <span>{{$classwork->description}}</span>
                                        @if($classwork->file)
                                            <a href="#" class="btn btn-outline-primary">{{$classwork->file}}</a>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">បិទ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="modal fade bd-example-modal-lg" id="classwork{{$classwork->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$classwork->title}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/classwork/submit" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="class_id" value={{$class_id}}>
                                        <input type="hidden" name="classwork_id" value={{$classwork->id}}>
                                        <div class="modal-body">
                                            <p style="margin-top: 10px">{{$classwork->description}}</p>
                                            @if($classwork->file)
                                                <p>
                                                    <a href="#" class="btn btn-outline-primary">{{$classwork->file}}</a>
                                                </p>
                                            @endif
                                            <div class="form-group" style="margin-top: 10px">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" name="file">
                                                    <label class="custom-file-label" for="customFile">រើសហ្វាល់</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">បិទ</button>
                                            <button type="submit" class="btn btn-primary">រក្សារទុក</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    <pre></pre>
                    <h3 style="text-align: center;">គ្មានការងាក្នុងថ្នាក់</h3>
                @endforelse
            </table>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="createClasswork" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">បង្កើតការងារ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/classwork/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="class_id" value={{$class_id}}>
                    <div class="modal-body">
                        <div class="form-group">    
                            <label for="exampleFormControlInput1">ចំណងជើងការងារ</label>
                            <input id="exampleFormControlInput1" type="text" name="title" class="form-control form-control-sm" placeholder="ចំណងជើងការងារ (ត្រូវការចាំបាច់)">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ពណ៏នាការងារ</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file">
                                <label class="custom-file-label" for="customFile">រើសហ្វាល់</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">បិទ</button>
                        <button type="submit" class="btn btn-primary">រក្សារទុក</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection