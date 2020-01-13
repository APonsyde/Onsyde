<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Turf Slots Messaging - <?php echo $turf['name']; ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Turfs</li>
                    <li class="breadcrumb-item" aria-current="page">Slots</li>
                    <li class="breadcrumb-item active" aria-current="page">Messaging</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<div class="contentbar">
    <?php $this->load->view('manager/layout/alert'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Message</label>
                                <textarea class="form-control" name="message" placeholder="Slot messaging template" rows="12"><?php echo $message; ?></textarea>
                                <small class="form-text text-muted">This message will be sent to all the players that have booked this turf previously.</small>
                                <?php echo form_error('message'); ?>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-outline-primary">Send</button>
                        <a href="<?php echo site_url('manager/turf/listing'); ?>" class="btn btn-outline-danger float-right">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>