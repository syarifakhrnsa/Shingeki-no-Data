@extends('layouts.app')
@section('content')
<div style="background-color: white">
<div class="container-fluid py-4">
    <div class="container pt-5 pb-3">
        <div class="">
            <h1 class="display-3 mb-md-4 text-center">My Travel Plans</h1>
        </div>
    </div>
</div>
<!-- Booking Start -->
<form action="{{route('newplan')}}" method="POST">
@csrf
<div class="container">
    <div class="container">
        <div class="bg-light shadow" style="padding: 30px; z-index: 3; position: relative;">
            <div class="row align-items-center" style="min-height: 60px;">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="mb-0">Make a Whole New Plan</h4>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="mb-3 mb-md-0" style="height: 47px;">
                                    <div class="form-group">
                                        <input type="text" class="form-control p-4" placeholder="Plan Name" data-target="#planname" name="plan_name" autocomplete="false"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="date" id="date1" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Date" data-target="#date1" data-toggle="datetimepicker" name="date" autocomplete="false"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <select class="custom-select px-4" style="height: 47px;" name="duration" >
                                    <option value="" disabled selected>Duration</option>
                                    <option value="1">1 Day</option>
                                    <option value="2">2 Days</option>
                                    <option value="3">3 Days</option>
                                    <option value="4">4 Days</option>
                                    <option value="5">5 Days</option>
                                    <option value="6">6 Days</option>
                                    <option value="7">7 Days</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -12px;">New Plan</button>
            </div>
        </div>
    </div>
</div>
</div>
</form>
<!-- Booking End -->
    <div class="card shadow plans" style="padding: 50px; margin:100px 100px 50px 100px">
        <div class="card-body " style="height: 550px;overflow: scroll;" >
            <table class="table">
                <thead>
                    <tr>
                        <th>Plan Name</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($plans) == 0)
                        <tr>
                            <td colspan="5" class="text-center">There is no plan available</td>
                        </tr>
                    @endif
                    @foreach ($plans as $plan)
                    <tr>
                    <td>{{$plan->plan_name}}</td>
                    <td>{{$plan->date}}</td>
                    <td>{{$plan->duration}}
                    @if ($plan->duration == 1)
                        {{'Day'}}
                    @else
                        {{'Days'}}
                    @endif 
                    </td>
                    <td>{{$plan->created_at}}</td>
                    <td>
                        <a href="{{route('map', $plan->plan_id)}}" class="btn btn-primary">Open</a>
                        <a href="{{route('deleteplan', $plan->plan_id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
    <div class="text-center" style="background-color: white">
        <a href="{{url('/')}}" class="btn btn-primary btn-lg">
            <i class="fa fa-home"></i>
            Back to Home
        </a>
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