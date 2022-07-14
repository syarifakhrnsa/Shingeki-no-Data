@extends('layouts.app')
@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-sm-6 mb-3" >
            <div class="card">
                <div class="card-header bg-dark text-white">All plan</div>
                <div class="card-body " style="height: 550px;overflow: scroll;" >
                   <table class="table table-dark ">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Date of Your plan</th>
                            <th>hh</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($plans as $plan)
                       <tr>
                        <td>{{$plan->id}}</td>
                        <td><a href="{{route('toMap',$plan->id)}}">{{$plan->created_at}}</a></td>
                        
                       </tr>
                       @endforeach
                    </tbody>
                   </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4" style="margin-left:-3vh">
            <div class="card" >
                <div class="card-header bg-dark text-white" style="height: 80vh">
                
                    <form action="{{route('storeplan')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark"><img src="{{url('image/fullplus.png')}}" class="img-fluid mt-5 " style="object-fit: cover;"  alt=""></button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>



@push('script')
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush

@endsection