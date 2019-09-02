<?php $__env->startSection('content'); ?>
<div class="blank_space"></div>

<div class="inner_banner" style="background-image:url(<?php echo e(url('/images/frontend/images/1.jpg')); ?>);">
    <div class="container h-100">
        <div class="row  h-100">
            <div class="col-lg-6 align-self-center m-auto text-center">
                <h3>Career</h3>
            </div>
        </div>
    </div>
</div>

    <div id="smart_container">
    <section class="all_blogs">
      <div class="container">
          
        <div class="row">
            
            <div class="col-lg-12">
              <p class="mb-3">Rapid Deals is home to the dedicated and positive. The company believes in harnessing one’s potential and does its best to cultivate a professional, vibrant, and motivating culture among its people to ensure one’s growth both inside and outside the workplace. We are always looking for people who are up for the challenge of the real estate industry. By joining Rapid Deals, you will grow alongside a group of experienced and goal-driven individuals. We currently have the following positions available. We accept applications via our online system, so if you’re interested, please complete the form to apply.</p>

<p>The successful candidate will be able to provide first class customer service support which will involve liaising with clients both on the telephone and face to face. They will possess a good understanding of the Dubai real estate industry and possess a professional demeanor. With a view of protecting Rapid Deals’s unblemished reputation, a high level of professionalism, enthusiasm, and work ethics is required. We are looking for candidates with a confident and charismatic attitude, strong negotiation skills and a hunger to earn money.</p>
              </div>
          
          <div class="col-lg-6 m-auto">
              
            <div class="list_propertybox">
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
            <form method="post" action="<?php echo e(url('career-form')); ?>" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

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
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.home_design_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\rapid deals\server code\resources\views/career.blade.php ENDPATH**/ ?>