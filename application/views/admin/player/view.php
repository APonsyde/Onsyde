<div class="booking manager-dashboard pb-0">
    <h4>Details</h4>
    <div style="overflow-x:auto;" class="wid100 mt-3">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="col" width="50%">Name</th>
                    <td><?php echo $player['full_name'] ?></td>
                </tr>
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
<div class="booking manager-dashboard">
    <h4>Preferences</h4>
    <div style="overflow-x:auto;" class="wid100 mt-3">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="col" width="50%">I usually play in</th>
                    <td>
                        <?php
                            if(in_array($player['play_in'], ['one_area', 'two_three_areas'])) {
                                $text_arr = @json_decode($player['play_in_locations'], true);
                                if(!empty($text_arr)) {
                                    foreach ($text_arr as $key => $ta) {
                                        if(!strlen($ta)) {
                                            unset($text_arr[$key]);
                                        }
                                    }
                                }
                                echo !empty($text_arr) ? implode(", ", $text_arr) : "-";
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
                        <?php echo ($player['prefer_to_play'] && $player['prefer_to_play'] !== 'all') ? " - ".get_prefer_to_play_good_as_by_value($player['prefer_to_play_good_as']) : ''; ?>
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