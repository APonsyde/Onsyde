<div class="booking manager-dashboard mr-5">
	<h4 class="page-title mb-3">
        Booking - #<?php echo $booking['booking_key']; ?>
        <?php if($booking['status'] == TURF_STATUS_BOOKED) { ?>
            <small class="badge badge-success float-right" style="font-size: 14px;font-weight: 100;padding: 6px;">CONFIRMED</small>
        <?php } else { ?>
            <small class="badge badge-danger float-right" style="font-size: 14px;font-weight: 100;padding: 6px;">CANCELLED</small>
        <?php } ?>
    </h4>
    <hr class="mb-4">
    <div class="mb-4">
        <p><?php echo $booking['address']; ?></p>
        <p><?php echo $booking['time_slot']; ?></p>
        <p><?php echo CURRENCY_SYMBOL; ?> <?php echo $booking['amount']; ?>/-</p>
    </div>
    <?php if($booking['status'] == TURF_STATUS_BOOKED) { ?>
        <?php if($this->player['id'] == $booking['player_id']) { ?>
            <div class="card m-b-30">
                <div class="card-header">
                    Invite new players
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Mobile</td>
                                        <td width="20%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input placeholder="name" name="name" type="text" class="form-control"></td>
                                        <td><input placeholder="mobile" name="mobile" type="number" class="form-control"></td>
                                        <td><button class="greyBtn green">Invite</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="card m-b-30">
                <form method="post">
                    <div class="card-header">
                        Join as a player
                    </div>
                    <div class="card-body p-4">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <input placeholder="Enter your mobile number" name="mobile" type="number" class="form-control" value="<?php echo $this->input->post('mobile'); ?>">
                            </div>
                        </div>
                        <?php if($this->input->post('mobile')) { ?>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input placeholder="Enter your name" name="name" type="text" class="form-control" value="<?php echo $name; ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="card-footer p-4">
                        <button class="greyBtn green"><?php echo ($this->input->post('mobile')) ? 'Confirm' : 'Join'; ?></button>
                    </div>
                </form>
            </div>
        <?php } ?>
    	<div class="card m-b-30">
            <div class="card-header">
            	Confirmed players
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                    	<thead>
                    		<tr>
                        		<td>Name</td>
                        		<td>Mobile</td>
                                <?php if($this->player['id'] == $booking['player_id']) { ?>
                        		  <td width="20%"></td>
                                <?php } ?>
                        	</tr>
                    	</thead>
                        <tbody>
                            <tr>
                                <?php $message .= "\r\n".$booking['player']; ?>
                                <td><?php echo $booking['player']; ?></td>
                                <td><?php echo $booking['player_mobile']; ?></td>
                                <?php if($this->player['id'] == $booking['player_id']) { ?>
                                    <td></td>
                                <?php } ?>
                            </tr>
                            <?php if(!empty($invited_players)) { ?>
                            	<?php foreach ($invited_players as $key => $invited_player) { ?>
                                    <?php if($invited_player['status'] == 'accepted') { ?>
                                        <?php $message .= "\r\n".$invited_player['name']; ?>
                                    	<tr>
                                    		<td><?php echo $invited_player['name']; ?></td>
                                    		<td><?php echo $invited_player['mobile']; ?></td>
                                            <?php if($this->player['id'] == $booking['player_id']) { ?>
                                        		<td>
                                        			<a class="greyBtn" href="<?php echo site_url('booking/invite-remove/'.$invited_player['id']); ?>">Remove</a>
                                        		</td>
                                            <?php } ?>
                                    	</tr>
                                        <?php unset($invited_players[$key]); ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php if($this->player['id'] == $booking['player_id']) { ?>
            <?php if(!empty($invited_players)) { ?>
                <div class="card m-b-30">
                    <div class="card-header">
                        Invited players
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Mobile</td>
                                        <td width="20%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invited_players as $key => $invited_player) { ?>
                                        <tr>
                                            <td><?php echo $invited_player['name']; ?></td>
                                            <td><?php echo $invited_player['mobile']; ?></td>
                                            <td>
                                                <?php if($invited_player['status'] == 'invited') { ?>
                                                    <a class="greyBtn green" href="<?php echo site_url('booking/invite-resend/'.$invited_player['id']); ?>">Reinvite</a>
                                                <?php } ?>
                                                <a class="greyBtn" href="<?php echo site_url('booking/invite-remove/'.$invited_player['id']); ?>">Remove</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        	<?php if(!empty($recent_players)) { ?>
                <div class="card m-b-30">
                    <div class="card-header">
                    	Recent players
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                            	<thead>
                            		<tr>
                                		<td>Name</td>
                                		<td>Mobile</td>
                                		<td width="20%"></td>
                                	</tr>
                            	</thead>
                                <tbody>
                                	<?php foreach ($recent_players as $key => $recent_player) { ?>
                                    	<tr>
                                    		<td><?php echo $recent_player['name']; ?></td>
                                    		<td><?php echo $recent_player['mobile']; ?></td>
                                    		<td><a class="greyBtn green" href="<?php echo site_url('booking/invite-add/'.$recent_player['id'].'/'.$booking['id']); ?>">Invite</a></td>
                                    	</tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if($this->player['id'] == $booking['player_id']) { ?>
            <textarea class="form-control" id="message" onkeyup="textAreaAdjust(this);" style="cursor: pointer;overflow:hidden;border-bottom-left-radius: 0;border-bottom-right-radius: 0;"><?php echo $message; ?></textarea>
            <button class="greyBtn green btn-block mb-3 clipboard" data-clipboard-target="#message" style="border-top-left-radius: 0;border-top-right-radius: 0;cursor: pointer;">Copy Text</button>
        <?php } ?>
        <h6 class="page-title mb-3">Booking URL - <code id="bookingUrl" class="clipboard" data-clipboard-text="<?php echo site_url('booking/view/'.$booking['booking_key']); ?>" data-clipboard-target="#bookingUrl" style="cursor: pointer;"><?php echo site_url('booking/view/'.$booking['booking_key']); ?></code> <button class="greyBtn green ml-3 clipboard" class="clipboard" data-clipboard-text="<?php echo site_url('booking/view/'.$booking['booking_key']); ?>" data-clipboard-target="#bookingUrl" style="cursor: pointer;">Copy Booking URL</button></h6>
    <?php } ?>
</div>

<script>
    function textAreaAdjust(o) {
        o.style.height = "1px";
        o.style.height = (25+o.scrollHeight)+"px"; 
    }
    textAreaAdjust(document.getElementById('message'));
</script>