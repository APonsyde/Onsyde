<div class="booking manager-dashboard">
    <div class="slots">
        <?php if(!empty($days)) { ?>
            <?php foreach ($days as $day => $data) { ?>
                <?php $this->load->view('manager/turf/_slot', ['data' => $data, 'day' => $day]); ?>
            <?php } ?>
        <?php } else { ?>
            <div class="col-sm-12">
                <div class="alert alert-danger" role="alert">
                    No turfs added yet!
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Slot Prices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="turf_id" id="turf_id">
                    <input type="hidden" name="day" id="day">
                    <input type="hidden" name="slot_ids" id="slot_ids">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" step="any" min="0" class="form-control" name="amount" placeholder="Amount for selected slots">
                        <?php echo form_error('amount'); ?>
                    </div>
                    <div id="data"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn slotbtn add" data-dismiss="modal">Close</button>
                <button type="button" class="btn slotbtn add modal-add">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".badge-set", function() {
            var _this = $(this);
            var timeslots = _this.parents('.timeslots');
            var start = timeslots.find(".badge-set.badge-select").length;
            if(start == 0) {
                _this.addClass('badge-select selection');
            } else if(start >= 2) {
                timeslots.find(".badge-set").removeClass('badge-select selection');
                _this.addClass('badge-select selection');
            } else {
                if(_this.hasClass('badge-select')) {
                    _this.removeClass('badge-select');
                } else {
                    _this.addClass('current');
                    var startIndex = 0;
                    var endIndex = 0;
                    timeslots.find(".badge-set").each(function() {
                        var index = $(this).index();
                        if($(this).hasClass('badge-select')) {
                            startIndex = index;
                        }
                        if($(this).hasClass('current')) {
                            endIndex = index;
                        }
                    });
                    _this.removeClass('current');
                    if(startIndex < endIndex) {
                        _this.prevUntil(timeslots.find(".badge-set.badge-select")).addClass('selection');
                    } else {
                        _this.nextUntil(timeslots.find(".badge-set.badge-select")).addClass('selection');
                    }

                    if(timeslots.find(".badge-set.selectable").length) {
                        timeslots.find(".selectable").removeClass('selection');
                    } else {
                        timeslots.find(".selectable").removeClass('selection');
                        if(startIndex < endIndex) {
                            _this.prevUntil(timeslots.find(".badge-set.badge-select")).addClass('badge-select selection');
                        } else {
                            _this.nextUntil(timeslots.find(".badge-set.badge-select")).addClass('badge-select selection');
                        }
                        _this.addClass('selection');
                    }
                }
            }
        })
    });
</script>

<script>
    $(document).ready(function() {

        $(document).on("click", ".btn-add", function() {
            var _this = $(this);
            var box = _this.parents('.box');
            var id = "<?php echo $turf['id']; ?>";
            var day = box.attr('data-day');
            var selected = box.find('.selection').length;
            var text = "<p><b>" + day + "</b>, slot timings selected:</p>";
            var slot_ids = [];

            if(selected)
            {
                box.find('.selection').each(function(i, v) {
                    text += "<p class='text-primary'>" + $(v).attr('data-time') + "</p>";
                    slot_ids.push($(v).attr('data-id'));
                })
                $(".modal-add").show();
            }
            else
            {
                text += "<p class='text-danger'>None</p>";
                $(".modal-add").hide();
            }

            $("#priceModal").find("#turf_id").val(id);
            $("#priceModal").find("#day").val(day);
            $("#priceModal").find("#slot_ids").val(slot_ids.join());
            $("#priceModal").find("#data").html(text);
        });

        $(document).on("click", ".modal-add", function() {
            var form = $("#priceModal").find("form");
            $.ajax({
                data: form.serializeArray(),
                type: "post",
                url: SITE_URL+"manager/turf/slot-manage",
                success: function(html) {
                    var day = $("#priceModal").find("#day").val();
                    $(".box[data-day='"+day+"']").replaceWith(html);
                    $("#priceModal").modal('hide');
                }
            });
        });

        $(document).on("click", ".btn-reset", function() {
            var _this = $(this);
            _this.parents('.box').find('.badge-set').removeClass('badge-select selection');
        });
    });
</script>