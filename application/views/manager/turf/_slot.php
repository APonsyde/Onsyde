<div class="col-sm-12 box" data-day="<?php echo $day; ?>">
    <div class="card border-light m-b-30">
        <div class="card-header bg-transparent border-light"><?php echo $day; ?></div>
        <div class="card-body p-2">
            <?php foreach ($data['slots'] as $key => $slot) { ?>
                <span data-id="<?php echo $slot['id']; ?>" data-time="<?php echo $slot['time']; ?>" class="badge-set badge badge-pill badge-<?php echo ($slot['price']) ? 'success' : 'dark' ?>"><?php echo $slot['time']; ?> / Rs. <?php echo $slot['price']; ?></span>
            <?php } ?>
        </div>
        <div class="card-footer bg-transparent border-light">
            <a class="btn btn-primary btn-add mr-2" href="#" data-toggle="modal" data-target="#priceModal">Add Slot Prices</a>
            <a class="btn btn-danger btn-reset" href="javascript:void(0);">Reset Selection</a>
        </div>
    </div>  
</div>