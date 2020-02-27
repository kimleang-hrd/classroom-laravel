@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8" style="border-bottom: 1px solid black;">
            <h1>Teachers</h1>
        </div>
    </div>

    <div class="row justify-content-md-center" style="margin-top: 10px;">
        <div class="col-8">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <span>
                                    <img width="32" height="32" style="border-radius: 50%;" src={{$owner->image}} alt="teacher picture">
                                </span>
                                <span>{{$owner->name}}</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-md-center" style="margin-top: 25px;">
        <div class="col-8" style="border-bottom: 1px solid black;">
            <h1>Students</h1>
        </div>
    </div>

    <div class="row justify-content-md-center" style="margin-top: 10px;">
        <div class="col-8">
            <table>
                @forelse ($students as $student)
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <span>
                                        <img width="32" height="32" style="border-radius: 50%;" src={{$student->image}} alt="student picture">
                                    </span>
                                    <span>{{$student->name}}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <p>No Students</p>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection