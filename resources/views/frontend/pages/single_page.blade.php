@extends('layouts.frontend.home_design_2')
@section('content')

@foreach($pages as $p)
<div class="blank_space"></div>
<div class="inner_banner" style="background-image:url({{ url('images/frontend/page_images/large/'.$p->page_image) }});">
    <div class="container h-100">
        <div class="row  h-100">
            <div class="col-lg-6 align-self-center m-auto text-center">
                <h3>{{$p->title}}</h3>
                <p>{{$p->sub_title}}</p>
            </div>
        </div>
    </div>
</div>

{!! $p->content !!}

@endforeach

@endsection
