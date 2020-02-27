<div class="booking manager-dashboard">
    <form enctype="multipart/form-data" method="get" id="list-form">
        <div class="flexpanel justify-between align-center mar-40">
            <div class="wid-50">Turf :
                <select name="turf_id" class="date" onchange="$('#list-form').submit();">
                    <option value="">-- All --</option>
                    <?php foreach ($turfs as $turf) { ?>
                        <option value="<?php echo $turf['id']; ?>" <?php echo ($this->input->get('turf_id') == $turf['id']) ? 'selected' : ''; ?>><?php echo $turf['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="wid-50">Status :
                <select name="status" class="date" onchange="$('#list-form').submit();">
                    <option value="">-- All --</option>
                    <option value="<?php echo TURF_STATUS_BOOKED; ?>" <?php echo ($this->input->get('status') == TURF_STATUS_BOOKED) ? 'selected' : ''; ?>>Confirmed</option>
                    <option value="<?php echo TURF_STATUS_CANCELLED; ?>" <?php echo ($this->input->get('status') == TURF_STATUS_CANCELLED) ? 'selected' : ''; ?>>Cancelled</option>
                  
                </select>
               
            </div>
        </div>
    </form>
    <div style="overflow-x:auto;" class="wid100 mt-3">
        <table>
            <thead>
                <th scope="col" width="20%">Turf</th>
                <th scope="col">Customer</th>
                <th scope="col">Booking Date</th>
                <th scope="col" width="20%">Time Slot</th>
                <th scope="col">Total Amount</th>
                <th scope="col"></th>
            </thead>
            <tbody>
                <?php if(!empty($bookings)) { ?>
                    <?php foreach($bookings as $booking) { ?>
                        <tr>
                            <td><?php echo $booking['name']; ?><br><?php echo $booking['address']; ?></td>
                            <td><?php echo $booking['player']; ?><br><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
                            <td><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
                            <td><?php echo $booking['time_slot']; ?></td>
                            <td><?php echo CURRENCY_SYMBOL; ?> <?php echo $booking['amount']; ?>/-</td>
                            <td>
                                <?php if($booking['status'] == TURF_STATUS_CANCELLED) { ?>
                                    <span class="text text-danger">Cancelled</span>
                                <?php } else { ?>
                                    <span class="text text-success">Confirmed</span>
                                <?php } ?>
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