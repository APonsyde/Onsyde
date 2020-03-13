<div class="booking manager-dashboard">
    <?php echo $turf['name']; ?>
    <hr>
    <div class="">
        <form method="post" novalidate="novalidate">
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" placeholder="Slot messaging template" rows="12"><?php echo $message; ?></textarea>
                <p>This message will be sent to all the players that have booked this turf previously.</p>
                <?php echo form_error('message'); ?>
            </div>
            <div class="flexpanel justify-between">
                <button class="greyBtn green">Send</button>
                <a href="<?php echo site_url('manager/turf/listing'); ?>" class="back">Back →</a>
            </div>
        </form>
    </div>
</div>