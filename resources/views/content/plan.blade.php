@extends('layouts.app')
@section('content')

<div class="container-fluid py-4">
    <div class="container pt-5 pb-3">
        <div class="">
            <h1 class="display-3 mb-md-4 text-center">My Travel Plans</h1>
        </div>
    </div>
</div>
<!-- Booking Start -->
<div class="container">
    <div class="container">
        <div class="bg-light shadow" style="padding: 30px; z-index: 3; position: relative;">
            <div class="row align-items-center" style="min-height: 60px;">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="mb-3 mb-md-0" style="height: 47px;">
                                    <div class="form-group">
                                        <input type="text" class="form-control p-4" placeholder="Plan Name" data-target="#planname"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="date" id="date1" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Depart Date" data-target="#date1" data-toggle="datetimepicker"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="date" id="date2" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Return Date" data-target="#date2" data-toggle="datetimepicker"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <select class="custom-select px-4" style="height: 47px;">
                                    <option selected>Duration</option>
                                    <option value="1">Duration 1</option>
                                    <option value="2">Duration 1</option>
                                    <option value="3">Duration 1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <form action="{{route('storeplan')}}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px;">New Plan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking End -->
    <div class="card shadow plans" style="padding: 50px; margin:100px">
        <div class="card-body " style="height: 550px;overflow: scroll;" >
            <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Depart Date</th>
                    <th>Return Date</th>
                    <th>Duration</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                <tr>
                <td>{{$plan->id}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="{{route('toMap',$plan->id)}}">{{$plan->created_at}}</a></td>
                </tr>
                @endforeach
            </tbody>
            </table> 
        </div>
    </div>
<!-- JavaScript Libraries -->
<script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js')}}"></script>

@push('script')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush

@endsection