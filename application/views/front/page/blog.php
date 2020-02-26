<section class="main-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 responsive-wrap">
                <div class="full-blog">
                    <figure class="img-holder">
                        <a href="#"><img src="<?php echo show_image(base_url('uploads/blogs/images/'.$blog['image'])); ?>" class="img-fluid" alt="#"></a>
                        <div class="blog-post-date">
                            <?php echo convert_db_time($blog['created_on'], "M d, Y") ?>
                        </div>
                    </figure>
                    <h4 class="mt-5 mb-3"><?php echo $blog['title'] ?></h4>
                    <div class="blog-content">
                        <div class="blog-text">
                            <?php echo $blog['description'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>