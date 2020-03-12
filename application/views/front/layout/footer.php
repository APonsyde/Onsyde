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
                        <p>Copyright © 2020 Listed Inc. All rights reserved</p>
                        <a href="<?php echo site_url('manager'); ?>">Manager Login</a>
                        <a href="<?php echo site_url('about-us'); ?>">About Us</a>
                        <a href="<?php echo site_url('contact-us'); ?>">Contact Us</a>
                        <a href="<?php echo site_url('blogs'); ?>">Blogs</a>
                        <a href="<?php echo site_url('privacy'); ?>">Privacy Policy</a>
                        <a href="<?php echo site_url('terms'); ?>">Terms & Conditions</a>
                    </div>
                    <ul class="social-icons">
                        <li><a href="https://twitter.com/getonsyde"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.facebook.com/onsyde.in/?modal=admin_todo_tour"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.instagram.com/getonsyde/?hl=en"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="mailto:hello@onsyde.in"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                        <li><a href="tel:+91 9372965837"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
                    </ul>
                    <hr>
                    <p class="text-center">Made with <i class="fa fa-heart" style="color: #f18d8d;"></i> by <a target="_blank" href="http://www.thelazybaboons.com/"><img src="<?php echo base_url('resources/theme/images/TLB.svg'); ?>" width="24"></a></p>
                </div>
            </div>
        </div>
    </footer>
    <?php $this->load->view('front/layout/foot'); ?>
</body>
</html>