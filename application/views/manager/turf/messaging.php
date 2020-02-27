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
                <a class="greyBtn green">Send</a>
                <a href="<?php echo site_url('manager/turf/listing'); ?>" class="back">Back →</a>
            </div>
            <div id="js-contact-result" data-success-msg="Success, We will get back to you soon" data-error-msg="Oops! Something went wrong"></div>
        </form>
    </div>
</div>