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
                <form enctype="multipart/form-data" method="get" id="list-form">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Turf :</label>
                                    <select name="turf_id" class="form-control" onchange="$('#list-form').submit();">
                                        <option value="">-- All --</option>
                                        <?php foreach ($turfs as $turf) { ?>
                                            <option value="<?php echo $turf['id']; ?>" <?php echo ($this->input->get('turf_id') == $turf['id']) ? 'selected' : ''; ?>><?php echo $turf['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Status :</label>
                                    <select name="status" class="form-control" onchange="$('#list-form').submit();">
                                        <option value="">-- All --</option>
                                        <option value="<?php echo TURF_STATUS_BOOKED; ?>" <?php echo ($this->input->get('status') == TURF_STATUS_BOOKED) ? 'selected' : ''; ?>>Confirmed</option>
                                        <option value="<?php echo TURF_STATUS_CANCELLED; ?>" <?php echo ($this->input->get('status') == TURF_STATUS_CANCELLED) ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="20%">Turf</th>
                                    <th scope="col">Customer</th>
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
                                            <td><?php echo $booking['player']; ?><br><a href="tel:<?php echo $booking['player_mobile']; ?>"><?php echo $booking['player_mobile']; ?></a></td>
                                            <td><?php echo convert_db_time($booking['booking_date'], "jS M, Y"); ?></td>
                                            <td><?php echo $booking['time_slot']; ?></td>
                                            <td>Rs. <?php echo $booking['amount']; ?>/-</td>
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