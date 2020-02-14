<section class="">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center  min-height-block">
            <div class="col-md-12">
                <div class="confirmation-wrap">
                    <h2><?php echo $invite['name'] ?></h2>
                    <p>You have been invited by <?php echo $invite['invited_by_player']; ?> to play on <?php echo $invite['time_slot'] ?> on <?php echo convert_db_time($invite['booking_date'], "d M, Y"); ?></p>
                    <p>Please update your availability for the invitation -</p>
                </div>
                <div class="text-center">
                    <form method="post">
                        <?php if($invite['invited_status'] == "accepted") { ?>
                            You selected "Yes"
                        <?php } else { ?>
                            <button class="btn btn-success mr-2" name="status" value="accepted">Yes</button>
                        <?php } ?>
                        <?php if($invite['invited_status'] == "rejected") { ?>
                            You selected "No"
                        <?php } else { ?>
                            <button class="btn btn-danger ml-2" name="status" value="rejected">No</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>