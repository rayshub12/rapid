<?php $__env->startSection('content'); ?>

<div class="blogbanner">
    <img src="<?php echo e(url('/images/frontend/images/blogbanner.jpg')); ?>">
</div>

<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id="smart_container">
    <section class="pt-1 pb-1">
        <div class="breadcrumb_sec">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb custom_breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(url('/blog')); ?>">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($p->title); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="all_blogs">
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="single_blog">

                        <div class="blogs_img">
                            <img src="<?php echo e(url('images/frontend/post_images/large/'.$p->post_image)); ?>">
                        </div>
                        <div class="singleblogtxt">
                            <span>Posted By <?php echo e(date('d M, Y', strtotime($p->created_at))); ?></span>
                            <h2><?php echo e($p->title); ?></h2>
                            <p>
                                <?php echo $p->content; ?>

                            </p>
                        </div>

                    </div>


                </div>
                <div class="col-md-3">
                    <div class="blogsidebar">
                        <div class="recent_post">
                            <h2>Recent Post</h2>
                            <ul>
                                <?php $__currentLoopData = \App\Post::where('status', '1')->orderBy('created_at', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(url('/blog/'.$rp->url)); ?>">
                                        <div class="reblogs_img">
                                            <img src="<?php echo e(url('/images/frontend/post_images/small/'.$rp->post_image)); ?>">
                                        </div>
                                        <div class="reblogtxt">
                                            <span>Posted By <?php echo e(date('d M, Y', strtotime($rp->created_at))); ?></span>
                                            <h6><?php echo e($rp->title); ?></h6>
                                            <p><?php echo e(strip_tags($rp->content)); ?> </p>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.home_design_2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\rapid deals\server code\resources\views/frontend/posts/single_post.blade.php ENDPATH**/ ?>