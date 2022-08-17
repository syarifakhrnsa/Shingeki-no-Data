@extends('layouts.app')
@section('content')
<div class="bg-white" style="padding-bottom: 50px">
<div class="text-center mb-3" style="margin-top: 80px">
    <div class="container-fluid py-4 mt-80 px-auto">
        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tours & Travel</h6>
        <h1 class="display-3 text-black">Peran Machine Learning</h1>
        <h1 class="display-3 text-black mb-md-4">Dalam Traveling</h1>
        <img src="{{asset('image/blog/blog1.png')}}" style="width: 60%" class="align-items-center"  alt="">
        <h5 class="mb-0 mt-4">Oleh: Syarifa Khairunnisa</h5>
        <h5 class="mb-0">16 Agustus 2022</h5>
    </div>
</div>
<div style="background-color:white; margin-right: 100px; margin-left: 100px" style="font-size: 18px">
    <p style="font-size: 18px;" class='pt-5'>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores totam, odit facere atque alias doloribus molestiae reprehenderit, earum ad recusandae animi, facilis quos hic illum. Totam doloribus eaque quam, est reprehenderit nam deleniti amet dolor ullam eum culpa eius minus aliquam repellendus, quasi, numquam placeat pariatur aperiam. Error, animi ab delectus nesciunt adipisci numquam reiciendis nam dignissimos rem quia sequi quis eveniet cupiditate, itaque distinctio eius iusto libero. Illo ad repudiandae dolore nesciunt, hic exercitationem architecto minima quis sed, quas dicta numquam officia inventore, rerum error possimus laudantium? Soluta, id. Voluptas fugit quis sapiente quae sint totam. Voluptatem, quasi dolore?
    </p>
    <p style="font-size: 18px" class='pt-5'> 
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores totam, odit facere atque alias doloribus molestiae reprehenderit, earum ad recusandae animi, facilis quos hic illum. Totam doloribus eaque quam, est reprehenderit nam deleniti amet dolor ullam eum culpa eius minus aliquam repellendus, quasi, numquam placeat pariatur aperiam. Error, animi ab delectus nesciunt adipisci numquam reiciendis nam dignissimos rem quia sequi quis eveniet cupiditate, itaque distinctio eius iusto libero. Illo ad repudiandae dolore nesciunt, hic exercitationem architecto minima quis sed, quas dicta numquam officia inventore, rerum error possimus laudantium? Soluta, id. Voluptas fugit quis sapiente quae sint totam. Voluptatem, quasi dolore?
    </p>
    <h5> Lorem, ipsum dolor.</h5>
    <p style="font-size: 18px" class='pt-5'>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores totam, odit facere atque alias doloribus molestiae reprehenderit, earum ad recusandae animi, facilis quos hic illum. Totam doloribus eaque quam, est reprehenderit nam deleniti amet dolor ullam eum culpa eius minus aliquam repellendus, quasi, numquam placeat pariatur aperiam. Error, animi ab delectus nesciunt adipisci numquam reiciendis nam dignissimos rem quia sequi quis eveniet cupiditate, itaque distinctio eius iusto libero. Illo ad repudiandae dolore nesciunt, hic exercitationem architecto minima quis sed, quas dicta numquam officia inventore, rerum error possimus laudantium? Soluta, id. Voluptas fugit quis sapiente quae sint totam. Voluptatem, quasi dolore?
    </p>
</div>
</div>
{{-- back to home button --}}
<div class="text-center" style="background-color: white">
    <a href="{{url('/')}}" class="btn btn-primary btn-lg">
        <i class="fa fa-home"></i>
        Back to Home
    </a>
</div>

@endsection