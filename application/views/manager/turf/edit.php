<section class="main-block howit-work-wrap">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="booking manager-dashboard">
                    <div class="">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="latitude" id="latitude" value="<?php echo ($this->input->post('latitude')) ? $this->input->post('latitude') : $turf['latitude']; ?>">
                            <input type="hidden" class="form-control" name="longitude" id="longitude" value="<?php echo ($this->input->post('longitude')) ? $this->input->post('longitude') : $turf['longitude']; ?>">
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
                                <div class="form-group col-md-4">
                                    <label>Area</label>
                                    <input type="text" class="form-control" name="area" placeholder="Area" value="<?php echo ($this->input->post('area')) ? $this->input->post('area') : $turf['area']; ?>">
                                    <?php echo form_error('area'); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo ($this->input->post('city')) ? $this->input->post('city') : $turf['city']; ?>">
                                    <?php echo form_error('city'); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Pin Code</label>
                                    <input type="text" class="form-control" name="pincode" placeholder="Pin Code" value="<?php echo ($this->input->post('pincode')) ? $this->input->post('pincode') : $turf['pincode']; ?>">
                                    <?php echo form_error('pincode'); ?>
                                </div>
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
                            <div class="flexpanel justify-between">
                                <button type="submit" class="greyBtn green">Create</button>
                                <a href="<?php echo site_url('manager/turf/listing'); ?>" class="redbg">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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