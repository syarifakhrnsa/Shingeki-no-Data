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
<!-- New Plan -->

<!-- Booking End -->
@livewire('plan-index')
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