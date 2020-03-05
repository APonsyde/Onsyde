<?php $today = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d'); ?>
<section class="hero-wrap d-flex align-items-centern turfBanner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="<?php echo base_url('resources/theme/images/l1.jpg'); ?>"></div>
            <div class="swiper-slide"><img src="<?php echo base_url('resources/theme/images/l2.jpg'); ?>"></div>
            <div class="swiper-slide"><img src="<?php echo base_url('resources/theme/images/l3.jpg'); ?>"></div>
        </div>
    </div>
    <div class="hero-title">
        <h1>Find your next game</h1>
        <form action="<?php echo site_url('find-a-turf/grouped'); ?>">
            <input type="hidden" name="date" id="date" value="<?php echo $today; ?>">
            <div class="search-box">
                <div class="flexpanel">
                    <div class="datepicker" style="background: #fff; cursor: pointer; padding: 5px 10px; width: 100%">
                    <span></span> 
                        <img src="<?php echo base_url('resources/front/images/calendar.svg'); ?>" alt="logo" class="calendar">
                    </div>
                    <div class="btn-search">
                        <button class="btn btn-simple">Find Turfs →</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="titile-block">
                    <h2>How Onsyde Works?</h2>
                    <p>Its really simple. Follow the steps and get started today!</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="howit-bg"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="howit-icon-wrap">
                    <div class="howit-img-block">
                    <img src="<?php echo base_url('resources/theme/images/Turf.png'); ?>" alt="logo" class="">
                    </div>
                    <h4>Your Turf</h4>
                    <p>Find. Book. Play. No app to download.<span>No login required. It's that simple.</span></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="howit-icon-wrap">
                    <div class="howit-img-block">
                    <img src="<?php echo base_url('resources/theme/images/Team.png'); ?>" alt="logo" class="">
                    </div>
                    <h4>Your Team</h4>
                    <p>Need a few players or a match with <span>
                    your team? We help find your game</span></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="howit-icon-wrap">
                    <div class="howit-img-block">
                    <img src="<?php echo base_url('resources/theme/images/Game.png'); ?>" alt="logo" class="">
                    </div>
                    <h4>Your Game</h4>
                    <p>Engage and share your moments of the <span>
                    game with the world</span></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="green">
    <div class="row no-gutters justify-content-center">
        <div class="col-md-12">
            <div class="row marg0">
                <div class="col-md-6 padding0">
                    <div class="turfManager contact-form">
                        <h3>Your Sports Venue Partner</h3>
                        <ul class="sport">
                            <li>Manage multiple bookings daily</li>
                            <li>Reduce calls & cancellations </li>
                            <li>Increase turf exposure & boost sales</li>
                        </ul>
                     
                        <form action="<?php echo site_url('demo-ajax'); ?>" id="managerForm" method="post">
                            <div class="submitForm flexpanel">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="mobile" placeholder="Enter Your Mobile Number">
                                </div>
                                <div class="subBtn">
                                    <a href="javascript:void(0)" id="submitManagerForm">Request Demo →</a>
                                </div>
                            </div>
                            <div class="error"></div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure class="pos"><img src="<?php echo base_url('resources/front/images/gardner.jpg'); ?>" class="wid100"></figure>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="main-block gray">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="titile-block">
                    <h2 class="rightLine">About Onsyde</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                </div>
                <div class="btn-wrap btn-wrap2">
                    <a href="<?php echo site_url('about-us'); ?>" class="btn btn-simple">Know More <i class="icon-arrow-down"></i>→</a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<?php if(!empty($blogs)) { ?>
    <section class="main-block">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="titile-block">
                        <h2 class="leftLine">Our Blogs</h2>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis</p> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($blogs as $key => $blog) { ?>
                    <div class="col-md-6 col-lg-3 article-first">
                    <a href="<?php echo site_url('blog/'.$blog['id']); ?>" class="blog2-link"><div class="news-block">
                            <img src="<?php echo show_image(base_url('uploads/blogs/images/'.$blog['image'])); ?>" alt="#" class="img-fluid">
                            <div class="news-title">
                                <p><?php echo convert_db_time($blog['created_on'], "M d, Y") ?></p>
                                <h5><?php echo $blog['title']; ?></h5>
                               Read More ➝
                            </div>
                        </div></a>
                    </div>
                <?php } ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="btn-wrap">
                        <a href="<?php echo site_url('blogs'); ?>" class="btn btn-simple">Read More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<section class="main-block <?php echo !empty($blogs) ? 'gray' : ''; ?>">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="titile-block">
                    <h2 class="rightLine">Podcast</h2>
                    <p>Listen to conversations from <span class="bld">founders</span>, <span class="bld">personalities</span> and <span class="bld">fans</span> who live and breathe the game</p>
                </div>
                <div class="flexpanel">
                    <ul class="podcast flexpanel flex-wrap justify-content-center  wid100">
                        <?php foreach ($podcasts as $key => $podcast) { ?>
                            <li>
                                <a href="<?php echo $podcast['url']; ?>" target="_blank"><img src="<?php echo show_image(base_url('uploads/podcasts/images/'.$podcast['image'])); ?>">
                                    <span><?php echo $podcast['title']; ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main-block gray padding0">
    <div class="row no-gutters justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 padding0">
                    <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2nd%20Floor%204/8%20Santacruz%20Mansions%20Santacruz%20Mumbai%20400055&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
                </div>
                <div class="col-md-8 padding0 green">
                    <div class="contact-form">
                        <h3>Contact Us</h3>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p> -->
                        <form action="<?php echo site_url('contact-us-ajax'); ?>" id="contactform" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="Your Email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" name="message" rows="3" placeholder="Message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-simple btn submit" id="js-contact-btn">Submit →</button>
                            </div>
                            <div class="error"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        var swiper = new Swiper('.swiper-container', {
            autoplay: {
                delay: 3000,
              },
        });
        $("#contactform").on("submit", function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                dataType: "json",
                data: form.serializeArray(),
                type: "post",
                url: form.attr('action'),
                success: function(response) {
                    if(response.success)
                        form[0].reset();

                    $("#contactform").find(".error").html(response.message);
                }
            })
        })
        $("#managerForm").on("submit", function(e) {
            e.preventDefault();
            submitDemoForm();
        })
        $("#submitManagerForm").on("click", function(e) {
            e.preventDefault();
            submitDemoForm();
        })
    });
    function submitDemoForm()
    {
        var form = $("#managerForm");
        $.ajax({
            dataType: "json",
            data: form.serializeArray(),
            type: "post",
            url: form.attr('action'),
            success: function(response) {
                if(response.success)
                    form[0].reset();

                $("#managerForm").find(".error").html(response.message);
            }
        })
    }
    $(function() {
        var start = moment('<?php echo $today; ?>');
        $('.datepicker').daterangepicker({
            startDate: start,
            singleDatePicker: true,
            autoApply: true,
            minDate: moment(),
            locale: {
                format: 'Y-MM-DD'
            }
        }, cb);
        cb(start);
        function cb(start) {
            $('.datepicker span').html(start.format('MMMM D, YYYY'));
            $('#date').val(start.format('Y-MM-DD'));
        }
        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $("#dayForm").submit();
        });
    });
</script>