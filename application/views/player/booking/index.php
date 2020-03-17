<div class="booking manager-dashboard mr-5">
    <div style="overflow-x:auto;" class="wid100 mt-3">
        <table>
            <thead>
                <tr>
                    <th scope="col">ID</th>
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
                            <td>#<?php echo $booking['booking_key']; ?></td>
                            <td><?php echo $booking['name']; ?><br><?php echo $booking['address']; ?></td>
                            <td><a href="tel:<?php echo $booking['mobile']; ?>"><?php echo $booking['mobile']; ?></a><br><a href="tel:<?php echo $booking['alternate_number']; ?>"><?php echo $booking['alternate_number']; ?></a></td>
                            <td><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
                            <td><?php echo $booking['time_slot']; ?></td>
                            <td><?php echo CURRENCY_SYMBOL; ?> <?php echo $booking['amount']; ?>/-</td>
                            <td>
                                <?php $time_slot_data = explode(" - ", $booking['time_slot']); ?>
                                <?php if(in_array($booking['status'], [TURF_STATUS_BOOKED]) && time() < strtotime($booking['booking_date'].$time_slot_data[1])) { ?>
                                    <a class="greyBtn btn-confirm" data-title="Cancel Booking" data-text="Are you sure you want to cancel the booking?" href="<?php echo site_url('booking/otp/'.$booking['id']); ?>">Cancel</a>
                                <?php } else { ?>
                                    <?php if($booking['status'] == TURF_STATUS_CANCELLED) { ?>
                                        <span class="text text-danger">Cancelled</span>
                                    <?php } else { ?>
                                        <span class="text text-success">Confirmed</span>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td>
                                <a class="greyBtn green mr-2" href="<?php echo site_url('booking/view/'.$booking['booking_key']); ?>">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <th scope="row" colspan="8">No bookings done yet!</th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".btn-confirm", function(e) {
            var _this = $(this);
            e.preventDefault();
            var href = _this.attr('href');
            var title = _this.attr('data-title');
            var text = _this.attr('data-text');
            $.confirm({
                title: title,
                content: text,
                buttons: {
                    confirm: function () {
                        window.location.href = href;
                    },
                    cancel: function () {}
                }
            });
        });
    });
</script>