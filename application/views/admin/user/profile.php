<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Profile</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('manager/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                            <div class="form-group col-md-6">
                                <label>Company name</label>
                                <input type="text" class="form-control" placeholder="Company name" name="company_name" value="<?php echo ($this->input->post('company_name')) ? $this->input->post('company_name') : $manager['company_name']; ?>">
                                <?php echo form_error('company_name'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Contact person</label>
                                <input type="text" class="form-control" placeholder="Contact person" name="contact_person" value="<?php echo ($this->input->post('contact_person')) ? $this->input->post('contact_person') : $manager['contact_person']; ?>">
                                <?php echo form_error('contact_person'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo ($this->input->post('email')) ? $this->input->post('email') : $manager['email']; ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <hr>
                        <h6 class="card-subtitle">Enter the password to update or leave it blank.</h6>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $this->input->post('password'); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Retype password</label>
                                <input type="password" class="form-control" placeholder="Retype password" name="retype_password" value="<?php echo $this->input->post('retype_password'); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>