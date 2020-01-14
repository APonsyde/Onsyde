<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title"><?php echo $player['full_name']; ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Players</li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<div class="contentbar">
    <?php $this->load->view('front/layout/alert'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="col" width="50%">Mobile</th>
                                    <td><?php echo $player['mobile'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="col" width="50%">Email</th>
                                    <td><?php echo $player['email'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="col" width="50%">I usually play in</th>
                                    <td>
                                        <?php
                                            if(in_array($player['play_in'], ['one_area', 'two_three_areas'])) {
                                                $text_arr = @json_decode($player['play_in_locations'], true);
                                                echo implode(", ", $text_arr);
                                            } else {
                                                echo 'Anywhere';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col" width="50%">Favourite turf</th>
                                    <td>
                                        <?php
                                            $favourite = [];

                                            if(!empty($player['favourite_turf_name']))
                                                $favourite[] = $player['favourite_turf_name'];

                                            if(!empty($player['favourite_turf_location']))
                                                $favourite[] = $player['favourite_turf_location'];
                                        ?>
                                        <?php echo !empty($favourite) ? implode(", ", $favourite) : '-'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col" width="50%">Favourite club (Football or Cricket)</th>
                                    <td><?php echo !empty($player['favourite_club']) ? $player['favourite_club'] : '-'; ?></td>
                                </tr>
                                <tr>
                                    <th scope="col" width="50%">I prefer to play</th>
                                    <td>
                                        <?php echo !empty($player['prefer_to_play']) ? get_prefer_to_play_by_value($player['prefer_to_play']) : '-'; ?>
                                        <?php echo ($player['prefer_to_play'] && $player['prefer_to_play'] !== 'all') ? "<br>".get_prefer_to_play_good_as_by_value($player['prefer_to_play_good_as']) : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col" width="50%">I would like to get notified for games during the</th>
                                    <td><?php echo !empty($player['notified_for_games']) ? get_notified_for_games_by_value($player['notified_for_games']) : '-'; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>