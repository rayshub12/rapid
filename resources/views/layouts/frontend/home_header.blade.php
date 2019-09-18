
<header class="sticky">
    <nav class="navbar navbar-expand-lg navbar-light sticky fixed-top custom_nav">
    <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/images/frontend/images/logo.svg') }}" alt="{{ config('app.name') }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/page/about-us') }}">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/properties/for/sale') }}">BUY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/properties/for/rent') }}">RENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/properties/for/off-plan') }}">OFF PLAN</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ url('/contact-us') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 CONTACT INFO
                 </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="{{ url('/contact-us') }}">CONTACT US</a>
                        <a class="nav-link" href="{{ url('/page/careers') }}">CAREERS</a>
                    </div>
                </li>
           
            
            <li class="nav-item">
                    <a class="btn btn-sm" href="{{ url('/list-your-property') }}" style="color:#fff; background: #05b3f8;">List Your Property</a>
                    <a class="btn btn-sm" href="tel:+97142432977" style="color:#fff; background: #000;margin-left: 0.5em;">+971 4 2432977</a>
                </li>
                 </ul>
        </div>

    </nav>
</header>