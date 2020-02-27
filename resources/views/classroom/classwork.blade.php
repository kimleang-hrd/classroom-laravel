@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">បង្កើតការងារ</button>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/classwork/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="class_id" value={{$class_id}}>
                    <div class="modal-body">
                        <div class="form-group">    
                            <label for="exampleFormControlInput1">Email address</label>
                            <input id="exampleFormControlInput1" type="text" name="title" class="form-control form-control-sm" placeholder="ចំណងជើងការងារ (ត្រូវការចាំបាច់)">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Desc</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <!-- <button>Link</button> -->
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection