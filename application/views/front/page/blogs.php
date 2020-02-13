<section class="main-block">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="titile-block">
                    <h2 class="leftLine">Our Blogs</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if(!empty($blogs)) { ?>
                <?php foreach ($blogs as $key => $blog) { ?>
                    <div class="col-md-6 col-lg-3 article-first">
                        <div class="news-block">
                            <img src="<?php echo show_image(base_url('uploads/blogs/images/'.$blog['image'])); ?>" alt="#" class="img-fluid">
                            <div class="news-title">
                                <p><?php echo convert_db_time($blog['created_on'], "M d, Y") ?></p>
                                <h5><?php echo $blog['title']; ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>