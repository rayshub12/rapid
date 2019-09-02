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

    <div id="smart_container">
    <section class="all_blogs">
      <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <p class="mb-3">{!! $p->content !!}</p>
              </div>
          <div class="col-lg-6 m-auto">
            
            @if( $p->career_form == 1 )
              <div class="list_propertybox">
              @if(Session::has('flash_message_success'))
              <div class="alert alert-success alert-dismissible">
                  <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{!! session('flash_message_success') !!}</strong>
              </div>
              @endif
              @if(Session::has('flash_message_error'))
              <div class="alert alert-error alert-dismissible">
                  <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                  <strong>{!! session('flash_message_error') !!}</strong>
              </div>
              @endif
              <form method="post" action="{{ url('career-form') }}" enctype="multipart/form-data">
                  {{ csrf_field()}}
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Full Name *</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" value="" name="fullname" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email Address *</label>
                  <div class="col-sm-8">
                      <input type="email" class="form-control" value="" name="email" required>
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Phone Number *</label>
                    <div class="col-sm-8">
                        <input id="phone" name="phone" type="tel" required>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Select Possition *</label>
                      <div class="col-sm-8">
                          <select id="inputState" class="form-control" name="course">
                              <option selected="">Option 1</option>
                              <option>Option 2</option>
                              <option>Option 3</option>
                              <option>Option 4</option>
                            </select>
                      </div>
                    </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Attached Resume *</label>
                      <div class="col-sm-8">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFile" name="resume">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Captcha: *</label>
                      <div class="col-sm-8">
                          <div class="form-group">
                              <div class="g-recaptcha" data-sitekey="6Le48aoUAAAAAN5OuFa4-BMG3KihvWRR6WAFSNXu"></div>
                              <div class="help-block with-errors"></div>
                          </div>
                      </div>
                  </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary right">Submit</button>
                </div>
                <div class="row">
                  <div class="col-sm-8 ml-auto text-right mt-2">
                      <p style="font-size: 10px;line-height: normal;"><b>Note:</b> We take your privacy seriously. All details and information provided are dealt with in a professional manner according to our Privacy Policy.</p>
                  </div>
                </div>
              </form>
            @endif
            @if($p->contact_form == 1 )
              <div class="contactform">
                <h4><center>Contact Us</center></h4>
                  
                @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-dismissible">
                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
                @endif
                @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-dismissible">
                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
                @endif
                  <form action="{{ url('/contact-form') }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <!--<label>Name</label>-->
                          <input type="text" class="form-control" placeholder="Full Name*" name="username" required>
                        </div>
                        <div class="form-group col-md-6">
                           <!--<label>Phone Number *</label>-->
                              <input id="" class="form-control" name="phone" placeholder="Phone No*" type="tel" required>
                          </div>
                      </div>
                      <div class="row form-group">
                        
                          <div class="col-md-12">
                              <!--<label for="inputEmail4">Email</label>-->
                            <input type="email" class="form-control"  placeholder="Email*" name="email" required>
                              
                          </div>
                      </div>
                      <div class="form-group">
                          <!--<label for="exampleFormControlTextarea1">Example textarea</label>-->
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Your Query" name="message"></textarea>
                        </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
              </div>

            @endif
          </div>
          
          </div>
          <!--<div class="col-lg-3">-->
          <!--  <div class="rightsidebar">-->
          <!--      <div class="sidebarmenu">-->
          <!--          <h6>Listings by category</h6>-->
          <!--          <ul>-->
          <!--            <li><a href="#">Apartments(13)</a></li>-->
          <!--            <li><a href="#">Condos(7)</a></li>-->
          <!--            <li><a href="#">Houses(5)</a></li>-->
          <!--            <li><a href="#">Industrial(1)</a></li>-->
          <!--            <li><a href="#">Land(2)</a></li>-->
          <!--          </ul>-->
          <!--        </div>-->
          <!--    <div class="callnowsec">-->
          <!--      <h4>Call <span>+971 (0)4 4294444</span> to speak to one of our property experts.</h4>-->
          <!--      <a href="tel:+971044294444">Call Now</a>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
        </div>
      </div>
    </section>
    
@endforeach
@endsection