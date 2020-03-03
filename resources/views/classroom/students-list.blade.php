@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8" style="border-bottom: 1px solid black;">
            <h3>Teachers</h3>
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
            <h3>Students</h3>
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
                    <pre></pre>
                    <h3 style="text-align: center;">គ្មានសិស្ស</h3>
                @endforelse
            </table>
        </div>
    </div>

    @if ($class->owner_id == Auth::user()->id)
        <div class="row justify-content-md-center" style="margin-top: 50px;">
            <div class="col-8">
                <h5 style="text-align: center;">ផ្តល់លេខកូដថ្នាក់អោយពួកគេ៖ {{$referral_code}}</h5>
            </div>
        </div>
    @endif

</div>
@endsection