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


<div class="meetteam mt-5 @if($p->page_type == 1 && $p->template_type == 1 && $p->career_form == 0) d-block @else d-none @endif">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Meet the Team</h3>
            </div>
            <div class="teamsec">
                <div class="team-carousel owl-carousel owl-theme">
                    @foreach(\App\Team::where('status', 1)->orderBy('created_at', 'asc')->get() as $t)
                    <div class="item">
                        <div class="teambox">
                        @if(!empty($t->image))
                        <img src="{{ url('images/frontend/team_images/large/'.$t->image) }}">
                        @else
                        <img src="/images/frontend/images/Personal.png" />
                        @endif
                            <p>{{ str_limit($t->description, $limit=150) }}</p>
                            <h5>{{ $t->name }}</h5>
                            <h6>{{ $t->designation }}</h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection
