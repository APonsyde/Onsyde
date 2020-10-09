<?php $today = ($this->input->get('date')) ? $this->input->get('date') : date('Y-m-d'); ?>
<section class="hero-wrap d-flex align-items-centern turfBanner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="<?php echo base_url('resources/theme/images/banner.jpg'); ?>"></div>
        </div>
    </div>
    <div class="hero-title">
        <h1>Your Ultimate Sports Guide. Made for India</h1>
    </div>
</section>
<?php if(!empty($blogs)) { ?>
  <section class="main-block">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="titile-block">
            <h2 class="">Our Latest Posts</h2>
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
            <a href="<?php echo site_url('blogs'); ?>" class="btn btn-simple">View All Posts →</a>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>
<section class="main-block howit-work-wrap gray">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="titile-block">
                    <h2>What is Onsyde?</h2>
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
                    <img src="<?php echo base_url('resources/theme/images/discover.png'); ?>" alt="logo" class="">
                    </div>
                    <h4>Discover</h4>
                    <p>Reviews and recommendations of sports brands, products, media & more</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="howit-icon-wrap">
                    <div class="howit-img-block">
                    <img src="<?php echo base_url('resources/theme/images/play.png'); ?>" alt="logo" class="">
                    </div>
                    <h4>Play</h4>
                    <p>Play our sports quiz every day & get a chance to win. Also play from our archive of 100+ quizzes</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="howit-icon-wrap">
                    <div class="howit-img-block">
                    <img src="<?php echo base_url('resources/theme/images/learn.png'); ?>" alt="logo" class="">
                    </div>
                    <h4>Learn</h4>
                    <p>Read our stories that inspire, educate and celebrate the love of the game</p>
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
                        <h3>Play The Onsyder Quiz</h3>
                        <ul class="sport">
                            <li>Get Smarter With Our Daily Quiz</li>
                            <li>Earn Points and Climb the Leaderboard</li>
                            <li>Top Players Get A Chance To Win</li>
                        </ul>
                        <form action="<?php echo site_url('quiz'); ?>" id="managerForm" method="get">
                            <div class="submitForm flexpanel">
                                <div class="subBtn w-100">
                                    <a href="<?= site_url('quiz'); ?>" id="submitManagerForm">Play Now →</a>
                                </div>
                            </div>
                            <div class="error"></div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure class="pos"><img src="<?php echo base_url('resources/theme/images/quiz.png'); ?>" class="wid100"></figure>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main-block <?php echo !empty($blogs) ? 'gray' : ''; ?>">
    <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="titile-block">
              <h2 class="">Subscribe</h2>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="titile-block">
                  <p class="mb-4">Listen to conversations from <span class="bld">founders</span>, <span class="bld">personalities</span> and <span class="bld">fans</span> who live and breathe the game</p>
                </div>
                <div class="flexpanel">
                  <ul class="podcast flexpanel flex-wrap justify-content-center wid100 p-0 bg-white py-3">
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
              <div class="col-md-6">
                <div class="titile-block mt-3">
                  <p class="mb-4">Our flagship <span class="bld">sport-focused</span> newsletter</p>
                </div>
                <div class="flexpanel mt-5">
                  <iframe src="https://onsyde.substack.com/embed" width="480" height="330" style="border:1px solid #EEE; background:white;" frameborder="0" scrolling="no"></iframe>
                </div>
              </div>
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

<style>
  .howit-img-block {
    width: 200px;
    height: 200px;
    border-radius: unset;
  }
  .pos {
    top: 0px;
  }
  .pos img {
    height: 100%;
    object-fit: cover;
  }
</style>
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
        // $("#managerForm").on("submit", function(e) {
        //     e.preventDefault();
        //     submitDemoForm();
        // })
        // $("#submitManagerForm").on("click", function(e) {
        //     e.preventDefault();
        //     submitDemoForm();
        // })
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
            timeZone: null,
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