<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">My Bookings</h4>
        </div>
    </div>          
</div>
<div class="contentbar">                
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="20%">Turf</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col" width="20%">Time Slot</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($bookings)) { ?>
                                    <?php foreach($bookings as $booking) { ?>
                                        <tr>
                                            <td><?php echo $booking['name']; ?><br><?php echo $booking['address']; ?></td>
                                            <td><a href="tel:<?php echo $booking['mobile']; ?>"><?php echo $booking['mobile']; ?></a><br><a href="tel:<?php echo $booking['alternate_number']; ?>"><?php echo $booking['alternate_number']; ?></a></td>
                                            <td><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
                                            <td><?php echo $booking['time_slot']; ?></td>
                                            <td>Rs. <?php echo $booking['amount']; ?>/-</td>
                                            <td>
                                                <?php if(in_array($booking['status'], [TURF_STATUS_BOOKED]) && $booking['player_cancellation']) { ?>
                                                    <a href="<?php echo site_url('player/booking/cancel/'.$booking['id']); ?>">Cancel</a>
                                                <?php } else { ?>
                                                    <?php if($booking['status'] == TURF_STATUS_CANCELLED) { ?>
                                                        <span class="text text-danger">Cancelled</span>
                                                    <?php } else { ?>
                                                        <span class="text text-success">Confirmed</span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="6">No bookings done yet!</th>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>