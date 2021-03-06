<div class="pad-bot-0 mb-5 box" data-day="<?php echo $day; ?>">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="slots">
                <h4><?php echo $day; ?></h4>
                <div class="slots">
                    <div class="timeslots">
                        <ul class="flexpanel wrp">
                            <?php foreach ($data['slots'] as $key => $slot) { ?>
                                <?php
                                    $unavailable = false;
                                    if($slot['price'] <= 0) {
                                        $unavailable = true;
                                    }
                                ?>
                                <li class="badge-set <?php echo ($unavailable) ? '' : 'booked'; ?>" data-id="<?php echo $slot['id']; ?>" data-time="<?php echo $slot['time']; ?>" style="cursor: pointer;">
                                    <?php echo $slot['time']; ?> / <?php echo CURRENCY_SYMBOL; ?> <?php echo $slot['price']; ?>
                                </li>
                            <?php } ?>
                        </ul> 
                    </div>
                    <div class="bookslot">
                        <a class="btn slotbtn add mt-4 mr-2 btn-add" href="#" data-toggle="modal" data-target="#priceModal">Add Slot Prices</a>
                        <a class="btn slotbtn add btn-reset mt-4" href="javascript:void(0);">Reset Selection</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>