<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('ground/listing'); ?>">Grounds</a>
			<span class="breadcrumb-item active">Edit</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">Ground - Edit</h2>
<form method="post">
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('ground/edit/'.$ground['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Personal, contact info and status related to ground.</p>
				</a>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row gutters-tiny">
				<div class="col-md-12">
					<div class="block block-rounded block-themed">
						<div class="block-header">
							<h3 class="block-title">Basic Info</h3>
							<div class="block-options">
								<button type="submit" class="btn btn-sm btn-alt-primary">
									<i class="fa fa-save mr-5"></i>Save
								</button>
							</div>
						</div>
						<div class="block-content block-content-full">
							<div class="form-group row">
								<div class="col-md-12">
									<label class="form-control-label">Ground Name <span class="text-danger">*</span></label>
									<input type="text" name="ground_name" placeholder="Ground Name" value="<?php echo ($this->input->post('ground_name')) ? $this->input->post('ground_name') : $ground['ground_name']; ?>" class="form-control">
									<?php echo form_error('ground_name'); ?>
									<br>
								</div>
								<div class="col-md-12">
									<label class="form-control-label">Pincode <span class="text-danger">*</span></label>
									<input type="text" name="pincode" placeholder="Pincode" value="<?php echo ($this->input->post('pincode')) ? $this->input->post('pincode') : $ground['pincode']; ?>" class="form-control">
									<?php echo form_error('pincode'); ?>
									<br>
								</div>
								<div class="col-md-12">
									<label class="form-control-label">Latitude <span class="text-danger">*</span></label>
									<input type="text" name="latitude" placeholder="Latitude" value="<?php echo ($this->input->post('latitude')) ? $this->input->post('latitude') : $ground['latitude']; ?>" class="form-control">
									<?php echo form_error('latitude'); ?>
									<br>
								</div>
								<div class="col-md-12">
									<label class="form-control-label">Longitude <span class="text-danger">*</span></label>
									<input type="text" name="longitude" placeholder="Longitude" value="<?php echo ($this->input->post('longitude')) ? $this->input->post('longitude') : $ground['longitude']; ?>" class="form-control">
									<?php echo form_error('longitude'); ?>
									<br>
								</div>
								<div class="col-md-12">
									<div id="map"></div>
								</div>
							</div>
						</div>
						<div class="block block-rounded block-themed">
							<div class="block-header">
								<h3 class="block-title">Status</h3>
								<div class="block-options">
									<button type="submit" class="btn btn-sm btn-alt-primary">
										<i class="fa fa-save mr-5"></i>Save
									</button>
								</div>
							</div>
							<div class="block-content block-content-full">
								<div class="form-group row">
									<label class="col-12">Active</label>
									<div class="col-12">
										<label class="css-control css-control-primary css-radio">
											<input type="radio" class="css-control-input" id="ground-active" name="inactive" value="0" <?php echo ($this->input->post('inactive') == "0" || $ground['inactive'] == "0") ? "checked" : ""; ?>>
											<span class="css-control-indicator"></span> Yes
										</label>
										<label class="css-control css-control-secondary css-radio">
											<input type="radio" class="css-control-input" id="ground-inactive" name="inactive" value="1" <?php echo ($this->input->post('inactive') == "1" || $ground['inactive'] == "1") ? "checked" : ""; ?>>
											<span class="css-control-indicator"></span> No
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<style>
	#map {
	  height: 200px;
	  width: 100%;
	}
</style>
<script>
	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 8,
			center: {lat: 0, lng: 0}
		});
		var geocoder = new google.maps.Geocoder;
		var infowindow = new google.maps.InfoWindow;
		geocodeLatLng(geocoder, map, infowindow);
	}
	function geocodeLatLng(geocoder, map, infowindow) {
		var input = "<?php echo ($this->input->post('latitude')) ? $this->input->post('latitude') : $ground['latitude']; ?>,<?php echo ($this->input->post('longitude')) ? $this->input->post('longitude') : $ground['longitude']; ?>";
		var latlngStr = input.split(',', 2);
		var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === 'OK') {
				if (results[0]) {
					map.setZoom(11);
					var marker = new google.maps.Marker({
						position: latlng,
						map: map
					});
					infowindow.setContent(results[0].formatted_address);
					infowindow.open(map, marker);
				} else {
					// window.alert('No results found');
				}
			} else {
				// window.alert('Geocoder failed due to: ' + status);
			}
		});
	}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5SUEvSbvabTTD4ai9fDIDAdRLuqx5DC0&callback=initMap">
</script>
