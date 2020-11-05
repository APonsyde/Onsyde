    <footer class="main-block gray">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 responsive-wrap">
                    <div class="footer-logo_wrap">
                        <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('resources/front/images/logo.png'); ?>" alt="#" class="img-fluid"></a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="copyright">
                        <p class="mb-3">Copyright © 2020 Rabona Integrated Solutions LLP. All rights reserved</p>
                        <a href="<?php echo site_url('about-us'); ?>">About Us</a>
                        <a href="<?php echo site_url('contact-us'); ?>">Contact Us</a>
                        <a href="<?php echo site_url('blogs'); ?>">Blogs</a>
                        <a href="<?php echo site_url('privacy'); ?>">Privacy Policy</a>
                        <a href="<?php echo site_url('terms'); ?>">Terms & Conditions</a>
                    </div>
                    <ul class="social-icons">
                        <li><a href="https://twitter.com/getonsyde" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.facebook.com/onsyde.in" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.instagram.com/getonsyde" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="mailto:hello@onsyde.in"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                        <li><a href="tel:+91 9372965837"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
    </footer>
    <?php $this->load->view('front/layout/foot'); ?>
</body>
</html>