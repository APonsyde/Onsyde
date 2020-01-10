<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Turf Bookings</h4>
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
                                    <th scope="col">Customer</th>
                                    <th scope="col">Booking Date</th>
                                    <th scope="col">Time Slot</th>
                                    <th scope="col">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($bookings)) { ?>
                                    <?php foreach($bookings as $booking) { ?>
                                        <tr>
                                            <td><?php echo $booking['name']; ?><br><?php echo $booking['address']; ?></td>
                                            <td><?php echo $booking['player']; ?><br><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
                                            <td><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
                                            <td><?php echo $booking['time_slot']; ?></td>
                                            <td>Rs. <?php echo $booking['amount']; ?>/-</td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <th scope="row" colspan="5">No bookings done yet!</th>
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