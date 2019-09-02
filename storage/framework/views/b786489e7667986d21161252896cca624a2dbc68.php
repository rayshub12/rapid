<?php $__env->startSection('content'); ?>

<div class="blank_space"></div>
    <div id="smart_container">
      <div class="inner_banner" style="background-image:url(<?php echo e(url('/images/frontend/images/1.jpg')); ?>);">
    <div class="container h-100">
        <div class="row  h-100">
            <div class="col-lg-6 align-self-center m-auto text-center">
                <h3>Contact Us</h3>
            </div>
        </div>
    </div>
</div>

      

    <section class="contactus">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Get in touch with us:</h3>
          </div>

            <div class="col-md-7">
                <div class="contact_details">
                 <h6><i class="fa fa-paper-plane"></i> Address</h6>
                 <p>
                  <b>Office no.</b> 2108, Bayswater By Omniyat,<br> 

                  Al Abraj St, Business Bay, Dubai.<br> 
                  
                  <b>PO Box:</b> 26237, Dubai, United Arab Emirates.
                 </p>
                
                 <h6><i class="fa fa-phone" aria-hidden="true"></i> Contact Info</h6>
                 <p>Tel: +971 4 2432977</p>
                 <p>Fax: +971 4 2869062</p>

                 <h6><i class="fa fa-globe" aria-hidden="true"></i> Website</h6>
                  <a href="#">www.rapiddealsuae.com</a>
                  <p>DED # 614746  |  ORN # 12756</p>
                </div>
            </div>
            <div class="col-md-5">
              <div class="contactform">
                <h4><center>Contact Us</center></h4>
                  
                <?php if(Session::has('flash_message_success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                    <strong><?php echo session('flash_message_success'); ?></strong>
                </div>
                <?php endif; ?>
                <?php if(Session::has('flash_message_error')): ?>
                <div class="alert alert-error alert-dismissible">
                    <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                    <strong><?php echo session('flash_message_error'); ?></strong>
                </div>
                <?php endif; ?>
                  <form action="<?php echo e(url('/contact-form')); ?>" method="post" enctype="multipart/form-data">
                      <?php echo e(csrf_field()); ?>

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
            </div>
          </div>
      </div>
    </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.home_design_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/contact-us.blade.php ENDPATH**/ ?>