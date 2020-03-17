<section class="">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center  min-height-block">
            <div class="col-md-12">
                <div class="confirmation-wrap">
                    <span class="ti-check"></span>
                    <h2>Thank you for your Booking</h2>
                    <p>You'll receive a confirmation email at <?php echo $this->player['email']; ?></p>
                </div>
                <div class="text-center">
                    <a class="btn btn-success" href="<?php echo site_url('bookings'); ?>">View Booking</a>
                </div>
            </div>
        </div>
    </div>
</section>