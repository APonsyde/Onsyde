<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="<?php echo site_url(); ?>">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">My Account</strong></div>
        </div>
    </div>
</div>
<div class="site-section">
	<div class="container">
        <?php $this->load->view('front/layout/alert'); ?>
		<div class="row">
			<div class="col-md-4 ml-auto">
				<ul class="list-group">
					<li class="list-group-item mb-2">
						<a href="#details" data-toggle="tab">
							<h4 class="list-group-item-heading">Details</h4>
							<p class="list-group-item-text text-muted mb-0">Update your personal details.</p>
						</a>
					</li>
					<li class="list-group-item mb-2">
						<a href="#addresses" data-toggle="tab">
							<h4 class="list-group-item-heading">Addresses</h4>
							<p class="list-group-item-text text-muted mb-0">Manage your billing / shipping addresses.</p>
						</a>
					</li>
					<li class="list-group-item mb-2">
						<a href="#orders" data-toggle="tab">
							<h4 class="list-group-item-heading">Orders</h4>
							<p class="list-group-item-text text-muted mb-0">Check your order history.</p>
						</a>
					</li>
					<li class="list-group-item mb-2">
						<a href="#wishlist" data-toggle="tab">
							<h4 class="list-group-item-heading">Wishlist</h4>
							<p class="list-group-item-text text-muted mb-0">View your wishlisted products.</p>
						</a>
					</li>
					<li class="list-group-item mb-2">
						<a href="#wallet" data-toggle="tab">
							<h4 class="list-group-item-heading">Wallet</h4>
							<p class="list-group-item-text text-muted mb-0">View your total wallet.</p>
						</a>
					</li>
					<li class="list-group-item mb-2">
						<a href="<?php echo site_url('logout'); ?>">
							<h4 class="list-group-item-heading">Logout</h4>
							<p class="list-group-item-text text-muted mb-0">Log off from this account.</p>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-md-8 tab-content">
				<div class='panel panel-default tab-pane active' id='details'>
					<h2 class="h3 mb-3 text-black"><span class="text-uppercase">Details</span> : <?php echo $customer['email']; ?></h2>
					<form method="post">
	                    <div class="p-3 p-lg-5 border">
	                        <div class="form-group row">
	                            <div class="col-md-6">
	                                <label class="text-black">First Name <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" name="r_first_name"  value="<?php echo ($this->input->post('r_first_name')) ? $this->input->post('r_first_name') : $customer['first_name']; ?>">
	                                <?php echo form_error('r_first_name'); ?>
	                            </div>
	                            <div class="col-md-6">
	                                <label class="text-black">Last Name <span class="text-danger">*</span></label>
	                                <input type="text" class="form-control" name="r_last_name" value="<?php echo ($this->input->post('r_last_name')) ? $this->input->post('r_last_name') : $customer['last_name']; ?>">
	                                <?php echo form_error('r_last_name'); ?>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-md-6">
	                                <label class="text-black">Password</label>
	                                <input type="password" class="form-control" name="r_password" placeholder="" value="<?php echo $this->input->post('r_password'); ?>">
	                                <?php echo form_error('r_password'); ?>
	                            </div>
	                            <div class="col-md-6">
	                                <label class="text-black">Retype Password</label>
	                                <input type="password" class="form-control" name="r_retype_password" placeholder="" value="<?php echo $this->input->post('r_retype_password'); ?>">
	                                <?php echo form_error('r_retype_password'); ?>
	                            </div>
	                            <div class="col-md-12">
		                            <small class="form-text text-muted">
										Leave both the password fields blank for not updating the password.
									</small>
								</div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-md-12">
	                                <label class="text-black">Mobile</label>
	                                <input type="text" class="form-control" name="r_mobile" placeholder="" value="<?php echo ($this->input->post('r_mobile')) ? $this->input->post('r_mobile') : $customer['mobile']; ?>">
	                                <?php echo form_error('r_mobile'); ?>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-md-6">
	                                <label class="text-black">Gender</label>
	                                <select class="form-control" name="r_gender">
	                                    <option>-- Choose --</option>
	                                    <option value="male" <?php echo ($this->input->post('r_gender') == 'male' || $customer['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
	                                    <option value="female" <?php echo ($this->input->post('r_gender') == 'female' || $customer['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
	                                    <option value="other" <?php echo ($this->input->post('r_gender') == 'other' || $customer['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
	                                </select>
	                                <?php echo form_error('r_gender'); ?>
	                            </div>
	                            <div class="col-md-6">
	                                <label class="text-black">Date of Birth</label>
	                                <input type="date" class="form-control" name="r_date_of_birth" placeholder="" value="<?php echo ($this->input->post('r_date_of_birth')) ? $this->input->post('r_date_of_birth') : $customer['date_of_birth']; ?>">
	                                <?php echo form_error('r_date_of_birth'); ?>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-lg-12">
	                                <label>
	                                    <input type="checkbox" name="r_newsletter" value="1" <?php echo ($this->input->post('r_newsletter') || $customer['newsletter']) ? 'checked' : ''; ?>>&nbsp;&nbsp;&nbsp;Subscribe to newsletter
	                                </label>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-lg-12">
	                                <input type="submit" class="btn btn-primary btn-lg btn-block" name="type" value="Update">
	                            </div>
	                        </div>
	                    </div>
	                </form>
				</div>
				<div class='panel panel-default tab-pane' id='addresses'>
					<h2 class="h3 mb-4 text-black"><span class="text-uppercase">My Addresses</span><a class="btn btn-primary float-right" href="<?php echo site_url('customer/address/add'); ?>"><small>Add new address</small></a></h2>
					<div class="row">
						<?php if(!empty($addresses)) { ?>
		                    <?php foreach($addresses as  $address) { ?>
				                <div class="col-md-6">
									<div class="border p-3 mb-4">
										<address class="mb-0">
											<h5><?php echo ucwords($address['name']); ?> [<?php echo ucwords($address['type']); ?>]</h5>
											<hr>
											<?php echo $address['address_line_1']; ?><br>
											<?php echo $address['address_line_2']; ?><br>
											<?php echo $address['city']; ?>, <?php echo $address['state']; ?>, <?php echo $address['country']; ?><br>
											<?php echo $address['pin_code']; ?><br>
											<span>
												<a href="<?php echo site_url('customer/address/edit/'.$address['id']); ?>">Edit</a> | 
												<a href="<?php echo site_url('customer/address/delete/'.$address['id']); ?>">Delete</a>
											</span>
										</address>
									</div>
								</div>
				            <?php } ?>
			            <?php } ?>
					</div>
				</div>
				<div class='panel panel-default tab-pane' id='orders'>
					<h2 class="h3 mb-3 text-black"><span class="text-uppercase">My Orders</span></h2>
					<?php if(!empty($orders)) { ?>
						<div class="border">
							<table class="table table-striped table-borderless mb-0">
								<thead>
									<tr>
										<th scope="col">Order Number</th>
										<th scope="col">Order Date</th>
										<th scope="col">Status</th>
										<th scope="col">Total</th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($orders as $key => $order) { ?>
										<tr>
											<th scope="row">#<?php echo $order['order_id'] ?></th>
											<td><?php echo convert_db_time($order['created_on'], "F j, Y"); ?></td>
											<td><?php echo get_order_status_text($order['status']); ?></td>
											<td><?php echo show_price($order['total']); ?></td>
											<td>
												<a href="<?php echo site_url('order/'.$order['id']); ?>">
													View
												</a>
												<?php if(!in_array($order['status'], ['pending', 'cancelled'])) { ?>
													&nbsp;&nbsp;
													<a href="<?php echo site_url('order/invoice/'.$order['id']); ?>" target="_blank">
														Invoice
													</a>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					<?php } else { ?>
						<div class="p-3 p-lg-5 border">
		                    <h3>You haven't placed any orders yet!.</h3>
		                    <hr>
		                    <p class="mb-0">Browse the <a href="<?php echo site_url('shop'); ?>">shop</a> to find a product you would like for yourself / gift for someone!</p>
						</div>
					<?php } ?>
				</div>
				<div class='panel panel-default tab-pane' id='wishlist'>
					<h2 class="h3 mb-3 text-black"><span class="text-uppercase">Wishlist</span></h2>
					<?php if(!empty($wishlist_products)) { ?>
						<?php foreach($wishlist_products as $wishlist_product) { ?>
							<div class="p-4 border mb-2">
								<div class="row">
									<div class="col-md-3">
										<a href="<?php echo site_url('product/'.$wishlist_product['id']); ?>"><img class="img-fluid" src="<?php echo show_image(base_url('uploads/products/images/'.$wishlist_product['image']), ['thumbnail' => '500_500']); ?>"></a>
									</div>
									<div class="col-md-8">
										<h4><a href="<?php echo site_url('product/'.$wishlist_product['id']); ?>"><?php echo $wishlist_product['name']; ?></a></h4>
										<p><a href="<?php echo site_url('product/'.$wishlist_product['id']); ?>"><?php echo $wishlist_product['description']; ?></a></p>
										<p class="card-text"><?php echo show_price($wishlist_product['price']); ?></p>
									</div>
									<div class="col-md-1 footer">
										<a href="#" data-id="179" class="btn-wishlist" data-action="remove"><i class="fa fa-remove"></i></a>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
				<div class='panel panel-default tab-pane' id='wallet'>
					<h2 class="h3 mb-3 text-black"><span class="text-uppercase">Balance</span> : <?php echo show_price($wallet); ?></h2>
					<?php if(!empty($wallet_transactions)) { ?>
						<div class="border">
							<table class="table table-striped table-borderless mb-0">
								<thead>
									<tr>
										<th scope="col">Date</th>
										<th scope="col">Amount</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($wallet_transactions as $key => $wallet_transactions) { ?>
										<tr>
											<td scope="row"><?php echo convert_db_time($wallet_transactions['created_on'], "F j, Y"); ?></td>
											<td><?php echo show_price($wallet_transactions['amount']); ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					<?php } else { ?>
						<div class="p-3 p-lg-5 border">
		                    <h3>No transactions completed yet!.</h3>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>