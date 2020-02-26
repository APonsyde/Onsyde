<section class="hero-wrap d-flex align-items-centern turfBanner">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="hero-title">
                <h1>Whats your plan today?</h1>
                <h3>Find your next game and book your turf now</h3>
                <form action="<?php echo site_url('find-a-turf/grouped'); ?>">
                    <div class="search-box">
                        <div class="flexpanel">
                            <?php $days = get_upcoming_days();?>
                            <select class="date" name="date">
                                <?php foreach ($days as $key => $day) { ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($this->input->get('date') == $key) ? 'selected' : ''; ?>><?php echo $day; ?></option>
                                <?php } ?>
                            </select>
                            <div class="btn-search">
                                <button class="btn btn-simple">Find Turfs →</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="titile-block">
                    <h2>How We Work?</h2>
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
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                            <style type="text/css">
                                .st0{fill:#47A854;}
                            </style>
                            <path class="st0" d="M61,0v512h390V0H61z M181,61V30h150v31H181z M282,91c-5.2,9-14.9,15-26,15s-20.8-6-26-15H282z M151,30v61h46.9
                            c6.7,25.8,30.2,45,58.1,45s51.4-19.2,58.1-45H361V30h60v211h-76.3c-7.2-42.5-44.2-75-88.7-75s-81.6,32.5-88.7,75H91V30H151z
                            M197.9,241c6.7-25.8,30.2-45,58.1-45s51.4,19.2,58.1,45H197.9z M314.1,271c-6.7,25.8-30.2,45-58.1,45s-51.4-19.2-58.1-45H314.1z
                            M331,451v31H181v-31H331z M230,421c5.2-9,14.9-15,26-15s20.8,6,26,15H230z M361,482v-61h-46.9c-6.7-25.8-30.2-45-58.1-45
                            s-51.4,19.2-58.1,45H151v61H91V271h76.3c7.2,42.5,44.2,75,88.7,75s81.6-32.5,88.7-75H421v211H361z"/>
                        </svg>
                    </div>
                    <h4>Your Turf</h4>
                    <p>Find. Book. Play. No app to download.<span>No login required. It's that simple.</span></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="howit-icon-wrap">
                    <div class="howit-img-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="howit-svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 33 33" style="enable-background:new 0 0 33 33;" xml:space="preserve" width="512px" height="512px"><g><g>
                            <path d="M29.3,15.817c-1.364,0-2.558-0.742-3.2-1.843c-0.642,1.102-1.836,1.843-3.2,1.843s-2.559-0.742-3.2-1.843   c-0.641,1.102-1.835,1.843-3.199,1.843c-1.364,0-2.559-0.742-3.2-1.843c-0.642,1.102-1.836,1.843-3.202,1.843   c-1.364,0-2.558-0.742-3.2-1.843c-0.642,1.102-1.836,1.843-3.2,1.843C1.66,15.817,0,14.158,0,12.119V7.195   c0-0.062,0.012-0.124,0.034-0.182l2.363-6.055c0.075-0.192,0.26-0.318,0.466-0.318h27.273c0.206,0,0.391,0.126,0.466,0.318   l2.363,6.055C32.988,7.071,33,7.133,33,7.195v4.924C33,14.158,31.34,15.817,29.3,15.817z M26.101,11.619c0.276,0,0.5,0.224,0.5,0.5   c0,1.488,1.211,2.698,2.7,2.698s2.7-1.21,2.7-2.698v-4.83l-2.205-5.649H3.205L1,7.289v4.83c0,1.488,1.211,2.698,2.699,2.698   c1.489,0,2.7-1.21,2.7-2.698c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5c0,1.488,1.211,2.698,2.7,2.698   c1.49,0,2.702-1.21,2.702-2.698c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5c0,1.488,1.211,2.698,2.7,2.698   c1.488,0,2.699-1.21,2.699-2.698c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5c0,1.488,1.211,2.698,2.7,2.698s2.7-1.21,2.7-2.698   C25.601,11.843,25.824,11.619,26.101,11.619z" data-original="#39b54a" class="active-path" data-old_color="#ff6b6b" fill="#39b54a"/>
                            <path d="M28.39,32.361H4.611c-1.199,0-2.174-0.975-2.174-2.174V19.651c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5v10.536   c0,0.647,0.526,1.174,1.174,1.174H28.39c0.648,0,1.175-0.526,1.175-1.174V19.651c0-0.276,0.224-0.5,0.5-0.5s0.5,0.224,0.5,0.5   v10.536C30.564,31.385,29.589,32.361,28.39,32.361z" data-original="#39b54a" class="active-path" data-old_color="#39b54a" fill="#39b54a"/>
                            <g>
                                <path d="M14.433,32.16H7.194c-0.276,0-0.5-0.224-0.5-0.5V19.306c0-0.276,0.224-0.5,0.5-0.5h7.238c0.276,0,0.5,0.224,0.5,0.5V31.66    C14.933,31.936,14.709,32.16,14.433,32.16z M7.694,31.16h6.238V19.806H7.694V31.16z" data-original="#39b54a" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                                <path d="M25.805,26.38h-8.566c-0.276,0-0.5-0.224-0.5-0.5v-6.573c0-0.276,0.224-0.5,0.5-0.5h8.566c0.276,0,0.5,0.224,0.5,0.5    v6.573C26.305,26.156,26.081,26.38,25.805,26.38z M17.738,25.38h7.566v-5.573h-7.566V25.38z" data-original="#39b54a" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g></g> </svg>
                    </div>
                    <h4>Your Team</h4>
                    <p>Need a few players or a match with <span>
                    your team? We help find your game</span></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="howit-icon-wrap">
                    <div class="howit-img-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="howit-svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 416.768 416.768" style="enable-background:new 0 0 416.768 416.768;" xml:space="preserve" width="512px" height="512px"><g><g>
                            <g>
                                <path d="M207.639,0c-2.56,0-5.12,2.048-5.12,5.12l-0.512,26.112c0,3.072,2.56,5.12,5.12,5.12c3.072,0,5.12-2.048,5.12-5.12    l0.512-26.112C212.759,2.048,210.711,0,207.639,0z" data-original="#000000" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g><g>
                            <g>
                                <path d="M247.575,23.552c-2.048-2.048-5.12-2.048-7.168,0l-18.944,17.92c-2.048,2.048-2.048,5.12,0,7.168    c1.024,1.024,2.048,1.536,3.584,1.536c1.024,0,2.56-0.512,3.584-1.536l18.944-17.92C249.623,28.672,249.623,25.6,247.575,23.552z" data-original="#000000" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g><g>
                            <g>
                                <path d="M193.815,41.472l-18.944-17.92c-2.048-2.048-5.12-2.048-7.168,0c-2.048,2.048-2.048,5.12,0,7.168l18.944,17.92    c1.024,1.024,2.048,1.536,3.584,1.536s2.56-0.512,3.584-1.536C195.863,46.592,195.863,43.52,193.815,41.472z" data-original="#000000" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g><g>
                            <g>
                                <path d="M390.423,392.704c-0.512-2.56-3.584-4.608-6.144-3.584l-32.256,7.68l-28.16-115.712    c28.672-12.8,38.4-70.656,22.016-136.192c-5.12-19.968-19.456-68.608-28.16-87.04c-1.024-2.048-3.584-3.072-5.632-2.56    l-92.16,22.528c-2.56,0.512-4.096,2.56-4.096,5.12c0.512,20.48,10.24,70.144,15.36,90.112c15.872,64,50.176,110.08,80.896,110.08    c0.512,0,1.024,0,2.048,0l28.16,115.712l-32.256,7.68c-2.56,0.512-4.608,3.584-3.584,6.144c0.512,2.56,2.56,4.096,5.12,4.096    c0.512,0,1.024,0,1.024,0l74.24-17.92C389.399,398.336,391.447,395.264,390.423,392.704z M226.583,86.016l83.968-20.48    c3.584,8.192,7.68,19.968,11.776,32.256l-91.136,21.504C229.143,106.496,227.095,94.72,226.583,86.016z M241.431,169.984    c-2.048-9.216-5.632-24.576-8.704-40.448l92.16-22.016c4.608,15.36,8.704,30.208,10.752,38.912    c15.36,62.464,6.656,119.808-18.944,125.952S256.279,231.936,241.431,169.984z" data-original="#000000" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g><g>
                            <g>
                                <path d="M318.231,138.752c-0.512-2.56-3.072-4.096-6.144-3.584c-2.56,0.512-4.608,3.584-3.584,6.144    c11.264,45.056,9.216,83.456,4.608,94.72c-1.024,2.56,0,5.632,2.56,6.656c0.512,0.512,1.536,0.512,2.048,0.512    c2.048,0,4.096-1.024,4.608-3.072C327.959,226.816,330.007,186.88,318.231,138.752z" data-original="#000000" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g><g>
                            <g>
                                <path d="M196.887,77.312l-92.16-22.528c-2.56-0.512-4.608,0.512-5.632,2.56c-8.704,18.432-23.04,67.072-28.16,87.04    c-16.384,66.048-6.144,123.904,22.016,136.192l-28.16,115.712l-32.256-7.68c-2.56-0.512-5.632,1.024-6.144,3.584    c-1.024,3.072,0.512,5.632,3.584,6.656l74.24,17.92c0.512,0,1.024,0,1.024,0c2.048,0,4.608-1.536,5.12-4.096    c0.512-2.56-1.024-5.632-3.584-6.144l-32.256-7.68l28.16-115.712c0.512,0,1.024,0,2.048,0c30.72,0,65.024-46.08,80.896-110.592    c5.12-19.968,14.848-70.144,15.36-90.112C200.983,79.872,199.447,77.824,196.887,77.312z M174.871,170.496    c-15.36,61.952-49.664,108.544-75.264,102.4c-25.088-6.656-34.304-64-18.944-125.952c2.048-9.216,6.144-24.064,10.752-38.912    l92.16,22.016C180.503,145.92,177.431,161.28,174.871,170.496z M185.623,119.296L94.487,97.792    c4.096-12.288,8.192-24.064,11.776-32.256l83.968,20.48C189.719,94.72,187.671,106.496,185.623,119.296z" data-original="#000000" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g><g>
                            <g>
                                <path d="M104.727,135.68c-2.56-0.512-5.632,1.024-6.144,3.584c-11.776,48.128-9.216,88.064-4.096,101.376    c1.024,2.048,2.56,3.072,4.608,3.072c0.512,0,1.536,0,2.048-0.512c2.56-1.024,3.584-4.096,2.56-6.656    c-4.608-11.776-6.656-49.664,4.608-94.72C108.823,139.264,107.287,136.192,104.727,135.68z" data-original="#000000" class="active-path" data-old_color="#ff6b6b" fill="#ff6b6b"/>
                            </g>
                        </g></g> </svg>
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
                        <h3>Are You A <span>Turf Manager?</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                        <form action="<?php echo site_url('manager'); ?>" id="managerForm" method="post">
                            <div class="submitForm flexpanel">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="mobile" placeholder="Enter Your Mobile Number">
                                </div>
                                <div class="subBtn">
                                    <a href="javascript:void(0)" onclick="document.getElementById('managerForm').submit()">Enroll→</a>
                                </div>
                            </div>
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
<section class="main-block gray">
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
</section>
<?php if(!empty($blogs)) { ?>
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
                <?php foreach ($blogs as $key => $blog) { ?>
                    <div class="col-md-6 col-lg-3 article-first">
                        <div class="news-block">
                            <img src="<?php echo show_image(base_url('uploads/blogs/images/'.$blog['image'])); ?>" alt="#" class="img-fluid">
                            <div class="news-title">
                                <p><?php echo convert_db_time($blog['created_on'], "M d, Y") ?></p>
                                <h5><?php echo $blog['title']; ?></h5>
                                <a href="<?php echo site_url('blog/'.$blog['id']); ?>" class="blog2-link">Read More ➝</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="btn-wrap">
                        <a href="<?php echo site_url('blogs'); ?>" class="btn btn-simple">Visit Blog Section →</a>
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
                    <ul class="podcast flexpanel flex-wrap">
                        <?php foreach ($podcasts as $key => $podcast) { ?>
                            <li>
                                <a href="<?php echo $podcast['url']; ?>" target="_blank"><img src="<?php echo show_image(base_url('uploads/podcasts/images/'.$podcast['image'])); ?>">
                                    <span>Listen On <?php echo $podcast['title']; ?></span>
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
                    <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.crocothemes.net/divi-discount-code-elegant-themes-coupon/"></a></div></div>
                </div>
                <div class="col-md-8 padding0 green">
                    <div class="contact-form">
                        <h3>Write Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, </p>
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

                    $(".error").html(response.message);
                }
            })
        })
    });
</script>