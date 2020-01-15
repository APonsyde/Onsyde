<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Profile</h4>
        </div>
    </div>          
</div>
<form method="post">
    <div class="contentbar">
        <?php $this->load->view('manager/layout/alert'); ?>
        <div class="row">
            <div class="col-lg-12">
                <h5 class="card-title font-18">Your details</h5>
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="full_name" value="<?php echo ($this->input->post('full_name')) ? $this->input->post('full_name') : $player['full_name']; ?>">
                                <?php echo form_error('full_name'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo ($this->input->post('email')) ? $this->input->post('email') : $player['email']; ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <hr>
                        <h6 class="card-subtitle">Enter the password to update or leave it blank.</h6>
                        <div class="form-row" id="preferences">
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $this->input->post('password'); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Retype password</label>
                                <input type="password" class="form-control" placeholder="Retype password" name="retype_password" value="<?php echo $this->input->post('retype_password'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="card-title font-18">Your preferences</h5>
                <div class="card m-b-30 preferences">
                    <div class="card-body">
                        <h6>I usually play in</h6>
                        <div class="group-btns">
                            <button type="button" class="btn btn-<?php echo($player['play_in'] == 'one_area') ? '' : 'outline-'; ?>dark btn-sm" data-show=".play_in_main" data-hide=".play_in_multiple">One area<input type="radio" name="play_in" value="one_area" class="d-none" <?php echo($player['play_in'] == 'one_area') ? 'checked' : ''; ?>></button>&nbsp;
                            <button type="button" class="btn btn-<?php echo($player['play_in'] == 'two_three_areas') ? '' : 'outline-'; ?>dark btn-sm" data-show=".play_in_main,.play_in_multiple" data-hide="">Two to three areas<input type="radio" name="play_in" value="two_three_areas" class="d-none" <?php echo($player['play_in'] == 'two_three_areas') ? 'checked' : ''; ?>></button>&nbsp;
                            <button type="button" class="btn btn-<?php echo($player['play_in'] == 'anywhere') ? '' : 'outline-'; ?>dark btn-sm" data-show="" data-hide=".play_in_main,.play_in_multiple">I’m okay traveling anyway for a game<input type="radio" name="play_in" value="anywhere" class="d-none" <?php echo($player['play_in'] == 'anywhere') ? 'checked' : ''; ?>></button>
                        </div>
                        <div class="play_in_main" style="<?php echo ($player['play_in'] !== 'anywhere') ? '' : 'display: none;' ?>">
                            <br>
                            <div class="row">
                                <?php
                                    $locations = @json_decode($player['play_in_locations']);
                                    $location_1 = isset($locations[0]) ? $locations[0] : "";
                                    $location_2 = isset($locations[1]) ? $locations[1] : "";
                                    $location_3 = isset($locations[2]) ? $locations[2] : "";
                                ?>
                                <div class="col-sm-3">
                                    <input class="form-control" name="location_1" value="<?php echo ($this->input->post('location_1')) ? $this->input->post('location_1') : $location_1; ?>" placeholder="Location" type="text">
                                </div>
                                <div class="col-sm-3 play_in_multiple" style="<?php echo ($player['play_in'] == 'two_three_areas') ? '' : 'display: none;' ?>">
                                    <input class="form-control" name="location_2" value="<?php echo ($this->input->post('location_2')) ? $this->input->post('location_2') : $location_2; ?>" placeholder="Location" type="text">
                                </div>
                                <div class="col-sm-3 play_in_multiple" style="<?php echo ($player['play_in'] == 'two_three_areas') ? '' : 'display: none;' ?>">
                                    <input class="form-control" name="location_3" value="<?php echo ($this->input->post('location_3')) ? $this->input->post('location_3') : $location_3; ?>" placeholder="Location" type="text">
                                </div>
                            </div>
                        </div>
                        <br>
                        <h6>Favourite Turf</h6>
                        <div class="row">
                            <div class="col-sm-3">
                                <input class="form-control" name="favourite_turf_name" placeholder="Turf Name" type="text" value="<?php echo ($this->input->post('favourite_turf_name')) ? $this->input->post('favourite_turf_name') : $player['favourite_turf_name']; ?>">
                            </div>
                            <div class="col-sm-3">
                                <input class="form-control" name="favourite_turf_location" placeholder="Location" type="text" value="<?php echo ($this->input->post('favourite_turf_location')) ? $this->input->post('favourite_turf_location') : $player['favourite_turf_location']; ?>">
                            </div>
                        </div>
                        <br>
                        <h6>Favourite Club (Football or Cricket)</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" name="favourite_club" placeholder="Club Name" type="text" value="<?php echo ($this->input->post('favourite_club')) ? $this->input->post('favourite_club') : $player['favourite_club']; ?>">
                            </div>
                        </div>
                        <br>
                        <h6>I prefer to play</h6>
                        <div class="group-btns">
                            <button type="button" class="btn btn-<?php echo($player['prefer_to_play'] == 'cricket') ? '' : 'outline-'; ?>dark btn-sm" data-show=".prefer_to_play_main,.prefer_to_play_multiple_cricket" data-hide=".prefer_to_play_multiple_football">Cricket<input type="radio" name="prefer_to_play" value="cricket" class="d-none" <?php echo($player['prefer_to_play'] == 'cricket') ? 'checked' : ''; ?>></button>&nbsp;
                            <button type="button" class="btn btn-<?php echo($player['prefer_to_play'] == 'football') ? '' : 'outline-'; ?>dark btn-sm" data-show=".prefer_to_play_main,.prefer_to_play_multiple_football" data-hide=".prefer_to_play_multiple_cricket">Football<input type="radio" name="prefer_to_play" value="football" class="d-none" <?php echo($player['prefer_to_play'] == 'football') ? 'checked' : ''; ?>></button>&nbsp;
                            <button type="button" class="btn btn-<?php echo($player['prefer_to_play'] == 'all') ? '' : 'outline-'; ?>dark btn-sm" data-show="" data-hide=".prefer_to_play_main,.prefer_to_play_multiple_cricket,.prefer_to_play_multiple_football">Available for both<input type="radio" name="prefer_to_play" value="all" class="d-none" <?php echo($player['prefer_to_play'] == 'all') ? 'checked' : ''; ?>></button>
                        </div>
                        <div class="prefer_to_play_main" style="<?php echo ($player['prefer_to_play'] !== 'all') ? '' : 'display: none;' ?>">
                            <br>
                            <h6>I’m really good as a</h6>
                            <div class="group-btns prefer_to_play_multiple_cricket" style="<?php echo ($player['prefer_to_play'] == 'cricket') ? '' : 'display: none;' ?>">
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'batsman') ? '' : 'outline-'; ?>dark btn-sm">Batsman<input type="radio" name="prefer_to_play_good_as" value="batsman" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'batsman') ? 'checked' : ''; ?>></button>&nbsp;
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'bowler') ? '' : 'outline-'; ?>dark btn-sm">Bowler<input type="radio" name="prefer_to_play_good_as" value="bowler" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'bowler') ? 'checked' : ''; ?>></button>&nbsp;
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'all_rounder') ? '' : 'outline-'; ?>dark btn-sm">All-rounder<input type="radio" name="prefer_to_play_good_as" value="all_rounder" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'all_rounder') ? 'checked' : ''; ?>></button>&nbsp;
                            </div>
                            <div class="group-btns prefer_to_play_multiple_football" style="<?php echo ($player['prefer_to_play'] == 'football') ? '' : 'display: none;' ?>">
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'goalkeeper') ? '' : 'outline-'; ?>dark btn-sm">Goalkeeper<input type="radio" name="prefer_to_play_good_as" value="goalkeeper" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'goalkeeper') ? 'checked' : ''; ?>></button>&nbsp;
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'defender') ? '' : 'outline-'; ?>dark btn-sm">Defender<input type="radio" name="prefer_to_play_good_as" value="defender" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'defender') ? 'checked' : ''; ?>></button>&nbsp;
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'midfielder') ? '' : 'outline-'; ?>dark btn-sm">Midfielder<input type="radio" name="prefer_to_play_good_as" value="midfielder" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'midfielder') ? 'checked' : ''; ?>></button>&nbsp;
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'striker') ? '' : 'outline-'; ?>dark btn-sm">Striker<input type="radio" name="prefer_to_play_good_as" value="striker" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'striker') ? 'checked' : ''; ?>></button>&nbsp;
                                <button type="button" class="btn btn-<?php echo($player['prefer_to_play_good_as'] == 'any') ? '' : 'outline-'; ?>dark btn-sm">Any preference, I just love to play!<input type="radio" name="prefer_to_play_good_as" value="any" class="d-none" <?php echo($player['prefer_to_play_good_as'] == 'any') ? 'checked' : ''; ?>></button>&nbsp;
                            </div>
                        </div>
                        <br>
                        <h6>I would like to get notified for games during the</h6>
                        <div class="group-btns">
                            <button type="button" class="btn btn-<?php echo($player['notified_for_games'] == 'mornings') ? '' : 'outline-'; ?>dark btn-sm">Mornings<input type="radio" name="notified_for_games" value="mornings" class="d-none" <?php echo($player['notified_for_games'] == 'mornings') ? 'checked' : ''; ?>></button>&nbsp; 
                            <button type="button" class="btn btn-<?php echo($player['notified_for_games'] == 'evenings') ? '' : 'outline-'; ?>dark btn-sm">Evenings<input type="radio" name="notified_for_games" value="evenings" class="d-none" <?php echo($player['notified_for_games'] == 'evenings') ? 'checked' : ''; ?>></button>&nbsp; 
                            <button type="button" class="btn btn-<?php echo($player['notified_for_games'] == 'late_nights') ? '' : 'outline-'; ?>dark btn-sm">Late nights<input type="radio" name="notified_for_games" value="late_nights" class="d-none" <?php echo($player['notified_for_games'] == 'late_nights') ? 'checked' : ''; ?>></button>&nbsp; 
                            <button type="button" class="btn btn-<?php echo($player['notified_for_games'] == 'anytime') ? '' : 'outline-'; ?>dark btn-sm">Anytime, I am always ready for a game!<input type="radio" name="notified_for_games" value="anytime" class="d-none" <?php echo($player['notified_for_games'] == 'anytime') ? 'checked' : ''; ?>></button>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<script>
    $(document).ready(function() {
        $(document).on("click", ".preferences button", function() {
            var _this = $(this);
            _this.parents(".group-btns").find("button").removeClass("btn-dark").addClass("btn-outline-dark");
            _this.removeClass("btn-outline-dark").addClass("btn-dark");

            _this.parents(".group-btns").find("button").find("input").prop("checked", false);
            _this.find("input").prop("checked", true);

            var show = _this.attr("data-show");
            var hide = _this.attr("data-hide");

            if(show.length) {
                $(show).show();
            }

            if(hide.length) {
                $(hide).hide();
            }
        });
    });
</script>