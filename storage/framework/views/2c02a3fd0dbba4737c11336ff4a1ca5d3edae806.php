<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top  custom_nav">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(url('/images/frontend/images/logo.svg')); ?>"
                alt="<?php echo e(config('app.name')); ?>"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/about-us')); ?>">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/property-for/1/buy/1')); ?>">BUY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/property-for/2/rent/1')); ?>">RENT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/property-for/off-plan/3')); ?>">OFF PLAN</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?php echo e(url('/contact-us')); ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 CONTACT INFO
                 </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="<?php echo e(url('/contact-us')); ?>">CONTACT US</a>
                        <a class="nav-link" href="<?php echo e(url('/career')); ?>">CAREER</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm" href="<?php echo e(url('/list-your-property')); ?>" style="color:#fff; background: #05b3f8;">List Your Property</a>
                </li>
            </ul>
        </div>
    </nav>
</header><?php /**PATH D:\rapid deals\server code\resources\views/layouts/frontend/home_header_2.blade.php ENDPATH**/ ?>