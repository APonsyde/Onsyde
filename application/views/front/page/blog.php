<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Blogs</h4>
        </div>
    </div>          
</div>
<div class="contentbar">                
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="text-center mt-3 mb-5">
                <h4><?php echo $blog['title'] ?></h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="accordion" id="accordionwithicon">
                        <div class="card">
                            <div class="card-header">
                                <img class="card-img-top" src="<?php echo show_image(base_url('uploads/blogs/images/'.$blog['image'])); ?>" alt="blog">
                            </div>
                            <div class="card-body">
                                <?php echo $blog['description'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>