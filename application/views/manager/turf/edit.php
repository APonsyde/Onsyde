<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Edit Turf - <?php echo $turf['name']; ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Turfs</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<div class="contentbar">
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" class="form-control" name="latitude" id="latitude" value="1.000">
                        <input type="hidden" class="form-control" name="longitude" id="longitude" value="1.000">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Turf Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Turf Name" value="<?php echo ($this->input->post('name')) ? $this->input->post('name') : $turf['name']; ?>">
                                <?php echo form_error('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" placeholder="1234 Main St" id="autocomplete" value="<?php echo ($this->input->post('address')) ? $this->input->post('address') : $turf['address']; ?>">
                            <?php echo form_error('address'); ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="<?php echo ($this->input->post('mobile')) ? $this->input->post('mobile') : $turf['mobile']; ?>">
                                <?php echo form_error('mobile'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Alternate Number</label>
                                <input type="text" class="form-control" name="alternate_number" placeholder="Alternate Number" value="<?php echo ($this->input->post('alternate_number')) ? $this->input->post('alternate_number') : $turf['alternate_number']; ?>">
                                <?php echo form_error('alternate_number'); ?>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-outline-primary">Save</button>
                        <a href="<?php echo site_url('manager/turf/listing'); ?>" class="btn btn-outline-danger float-right">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var autocomplete;
    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), {types: ['geocode']});
        autocomplete.setFields(['address_component']);
        autocomplete.addListener('place_changed', fillInAddress);
    }
    function fillInAddress() {
        var place = autocomplete.getPlace();
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&libraries=places&callback=initAutocomplete" async defer></script>