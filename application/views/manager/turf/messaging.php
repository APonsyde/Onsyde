<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="booking manager-dashboard">
                    <?php echo $turf['name']; ?>
                    <hr>
                    <div class="">
                        <form action="php/contact.php" id="message" method="post" novalidate="novalidate">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" name="message" placeholder="Slot messaging template" rows="12"><?php echo $message; ?></textarea>
                                <p>This message will be sent to all the players that have booked this turf previously.</p>
                                <?php echo form_error('message'); ?>
                            </div>
                            <div class="flexpanel justify-between">
                                <button class="greyBtn green">Send</button>
                                <a href="<?php echo site_url('manager/turf/listing'); ?>" class="redbg">Cancel</a>
                            </div>
                            <div id="js-contact-result" data-success-msg="Success, We will get back to you soon" data-error-msg="Oops! Something went wrong"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>