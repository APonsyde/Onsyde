<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Blogs</h4>
        </div>
    </div>          
</div>
<div class="contentbar">                
    <div class="row">
        <?php if(!empty($blogs)) { ?>
            <?php foreach ($blogs as $key => $blog) { ?>
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card m-b-30">
                        <img class="card-img-top" src="<?php echo show_image(base_url('uploads/blogs/images/'.$blog['image'])); ?>" alt="blog">
                        <div class="card-body">
                            <h5 class="card-title font-18"><?php echo $blog['title']; ?></h5>
                            <p class="card-text mb-0"><?php echo trim_text($blog['description'], 230); ?></p>                                
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="blog-link">
                                        <a href="<?php echo site_url('blog/'.$blog['id']); ?>" class="btn btn-primary-rgba">More<i class="feather icon-arrow-right ml-2"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="blog-meta">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><?php echo convert_db_time($blog['created_on'], "d M") ?></li>
                                        </ul>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>