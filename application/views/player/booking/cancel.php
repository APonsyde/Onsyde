<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('front/layout/head'); ?>
</head>
<body>
    <section class="loginPage">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-4 ml-auto mr-auto center-screen">
                    <a class="logo">
                        <img src="<?php echo base_url('resources/theme/images/logo.png'); ?>">
                    </a>
                    <div class="titile-block">
                        <h2 class="">One Time Password</h2>
                        <p>OTP has been sent to your mobile number please enter it below to cancel your booking </p>
                        <form method="post" class="register otp">
                            <input type="hidden" class="form-control" name="mobile" value="<?php echo $this->input->get('mobile'); ?>">
                            <div class="flexpanel">
                                <div class="mb-20 pad-10">
                                    <input type="text" class="inpt" placeholder="0" name="code[1]" data-maxlength="1">
                                </div>
                                <div class="mb-20 pad-10">
                                    <input type="text" class="inpt" placeholder="0" name="code[2]" data-maxlength="1">
                                </div>
                                <div class="mb-20 pad-10">
                                    <input type="text" class="inpt" placeholder="0" name="code[3]" data-maxlength="1">
                                </div>
                                <div class="mb-20 pad-10">
                                    <input type="text" class="inpt" placeholder="0" name="code[4]" data-maxlength="1">
                                </div>
                                <div class="mb-20 pad-10">
                                    <input type="text" class="inpt" placeholder="0" name="code[5]" data-maxlength="1">
                                </div>
                                <div class="mb-20 pad-10">
                                    <input type="text" class="inpt" placeholder="0" name="code[6]" data-maxlength="1">
                                </div>
                            </div>
                            <?php echo form_error('otp'); ?>
                            <div class="btn-search">
                                <button class="btn btn-simple">Enter OTP →</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('front/layout/foot'); ?>
    <script>
        $(document).on("input", "input[name^=code]", function(e) {

            var _this = $(this);
            var text = $(this).val();

            if (text.length == 6) {
                for (var i=1 ; i<=text.length ; i++) {
                    $("input[name^=code]").eq(i-1).val(text[i-1]);
                }    
            } else if (text.length > 1) {
                _this.val(text[0]);
            }

            if (this.value.length == _this.attr('data-maxlength')) {
                _this.parent("div").next('div').find('input[name^=code]').focus();
            }
        });
    </script>
</body>
</html>