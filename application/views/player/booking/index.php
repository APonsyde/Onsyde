<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="booking manager-dashboard">
                    <div style="overflow-x:auto;" class="wid100 mt-3">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" width="20%">Turf</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col" width="20%">Time Slot</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col" colspan="2"></th>
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
                                                    <a href="<?php echo site_url('booking/cancel/'.$booking['id']); ?>">Cancel</a>
                                                <?php } else { ?>
                                                    <?php if($booking['status'] == TURF_STATUS_CANCELLED) { ?>
                                                        <span class="text text-danger">Cancelled</span>
                                                    <?php } else { ?>
                                                        <span class="text text-success">Confirmed</span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a class="mr-2" href="<?php echo site_url('booking/view/'.$booking['booking_key']); ?>">View</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="7">No bookings done yet!</th>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>