<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
	<div class="content py-5 text-center">
		<nav class="breadcrumb bg-body-light mb-0">
			<a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
			<a class="breadcrumb-item" href="<?php echo site_url('sport/listing'); ?>">Sports</a>
			<span class="breadcrumb-item active">Edit</span>
		</nav>
	</div>
</div>
<h2 class="content-heading">Sport - Edit</h2>
	<div class="row gutters-tiny">
		<div class="col-md-4">
			<div class="list-group">
				<a href="<?php echo site_url('sport/edit/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start ">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Info</h5>
					</div>
					<p class="mb-1">Personal, contact info and status related to Sport.</p>
				</a>
				<a href="<?php echo site_url('sport/sport_skill_set/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Skill Sets</h5>
                    </div>
                    <p class="mb-1">Manage Sport Skill Sets.</p>
                </a>
                <a href="<?php echo site_url('sport/images/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start ">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">Sport Icon</h5>
					</div>
					<p class="mb-1">Upload icon for the Sport.</p>
				</a>
                <a href="<?php echo site_url('sport/rules/'.$sport['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Sport Rules</h5>
                    </div>
                    <p class="mb-1">Add rules for the Sport.</p>
                </a>
			</div>
		</div>
	<div class="col-md-8">
        <div class="row gutters-tiny">
            <div class="col-md-12">
                <div class="block block-rounded block-themed">
                    <form method="post">
                        <div class="block-header bg-gd-primary">
                            <h3 class="block-title">Add Rules</h3>
                            <div class="block-options">
                                <button type="submit" class="btn btn-sm btn-alt-primary">
                                    <i class="fa fa-save mr-5"></i>Add
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label class="form-control-label">Add Rules below</label>
                            <br>
                            <input type="text" placeholder="Rules" name="name" value="<?php echo $this->input->post('$name'); ?>" class="form-control">
                            <p class="text-muted">Add <code>{}</code> to specify a field to enter while adding in tournament rules.<br>
                            Eg. {} teams of {} players each.</p>
                            <br>
                            <?php echo form_error('name'); ?>
                        </div>
                    </form>
                    <br>
                    <div class="col-md-12">
                    <label class="form-control-label">Sport Rules listing</label>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer" role="grid">
                            <thead>
                                <tr class="border-double">
                                    <th></th>
                                    <th> Sport Rules</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($rules)) { ?>
                                    <?php foreach($rules as $key => $rule) { ?>
                                        <tr>
                                            <td> <?php echo $key + 1; ?></td>
                                            <td> <?php echo $rule['name']; ?></td>
                                            <td class="text-center">
                                                <a class=" float-left btn-sm btn btn-alt-danger delete-confirm" href="<?php echo site_url('sport/delete-sport-rule/'.$rule['id']); ?>">
                                                <i class="fa fa-trash fa"></i>
                                                Delete
                                            </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="2">No Rules Sets added yet</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>