<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="blank_space"></div>
<div class="inner_banner" style="background-image:url(<?php echo e(url('images/frontend/page_images/large/'.$p->page_image)); ?>);">
    <div class="container h-100">
        <div class="row  h-100">
            <div class="col-lg-6 align-self-center m-auto text-center">
                <h3><?php echo e($p->title); ?></h3>
                <p><?php echo e($p->sub_title); ?></p>
            </div>
        </div>
    </div>
</div>

<?php echo $p->content; ?>



<div class="meetteam mt-5 <?php if($p->page_type == 1 && $p->template_type == 1 && $p->career_form == 0): ?> d-block <?php else: ?> d-none <?php endif; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Meet the Team</h3>
            </div>
            <div class="teamsec">
                <div class="team-carousel owl-carousel owl-theme">
                    <?php $__currentLoopData = \App\Team::where('status', 1)->orderBy('created_at', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <div class="teambox">
                        <?php if(!empty($t->image)): ?>
                        <img src="<?php echo e(url('images/frontend/team_images/large/'.$t->image)); ?>">
                        <?php else: ?>
                        <img src="/images/frontend/images/Personal.png" />
                        <?php endif; ?>
                            <p><?php echo e(str_limit($t->description, $limit=150)); ?></p>
                            <h5><?php echo e($t->name); ?></h5>
                            <h6><?php echo e($t->designation); ?></h6>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.home_design_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/b81baw0coev3/public_html/rapidleads.buzzsummo.net/resources/views/frontend/pages/single_page.blade.php ENDPATH**/ ?>