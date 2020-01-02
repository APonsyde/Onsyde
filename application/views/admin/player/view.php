<?php $this->load->view('admin/layout/alert'); ?>
<div class="bg-body-light border-b">
    <div class="content py-5 text-center">
        <nav class="breadcrumb bg-body-light mb-0">
            <a class="breadcrumb-item" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
            <a class="breadcrumb-item" href="<?php echo site_url('player/listing'); ?>">Players</a>
            <span class="breadcrumb-item active">View</span>
        </nav>
    </div>
</div>
<h2 class="content-heading">
    <?php echo $player['full_name']; ?>
    <?php if($player['inactive']) { ?>
        <span class="badge badge-danger pull-right">Inactive</span>
    <?php } else { ?>
        <span class="badge badge-success pull-right">Active</span>
    <?php } ?>
</h2>
<div class="row gutters-tiny">
    <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow">
            <div class="block-content block-content-full block-sticky-options">
                <div class="block-options">
                    <div class="block-options-item">
                        <i class="fa fa-line-chart fa-2x text-body-bg-dark"></i>
                    </div>
                </div>
                <div class="py-20 text-center">
                    <div class="font-size-h2 font-w700 mb-0" data-toggle="countTo" data-to="<?php echo $total_orders; ?>">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Orders</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow">
            <div class="block-content block-content-full block-sticky-options">
                <div class="block-options">
                    <div class="block-options-item">
                        <i class="fa fa-shopping-cart fa-2x text-body-bg-dark"></i>
                    </div>
                </div>
                <div class="py-20 text-center">
                    <div class="font-size-h2 font-w700 mb-0" data-toggle="countTo" data-to="<?php echo $total_cart_products; ?>">0</div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">In Cart</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow" href="<?php echo site_url('player/edit/'.$player['id']); ?>">
            <div class="block-content block-content-full block-sticky-options">
                <div class="block-options">
                    <div class="block-options-item">
                        <i class="fa fa-user fa-2x text-info-light"></i>
                    </div>
                </div>
                <div class="py-20 text-center">
                    <div class="font-size-h2 font-w700 mb-0 text-info">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Edit Player</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-xl-3">
        <a class="block block-rounded block-link-shadow delete-confirm" href="<?php echo site_url('player/delete/'.$player['id']); ?>">
            <div class="block-content block-content-full block-sticky-options">
                <div class="block-options">
                    <div class="block-options-item">
                        <i class="fa fa-user fa-2x text-danger-light"></i>
                    </div>
                </div>
                <div class="py-20 text-center">
                    <div class="font-size-h2 font-w700 mb-0 text-danger">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Remove Player</div>
                </div>
            </div>
        </a>
    </div>
</div>
<h2 class="content-heading">Addresses (Default)</h2>
<div class="row row-deck gutters-tiny">
    <?php if(!empty($billing_address)) { ?>
        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Billing Address</h3>
                </div>
                <div class="block-content">
                    <address>
                        <?php echo $billing_address['address_line_1']; ?><br>
                        <?php echo $billing_address['address_line_2']; ?><br>
                        <?php echo $billing_address['landmark']; ?><br>
                        <?php echo $billing_address['city']; ?>, <?php echo $billing_address['state']; ?>, <?php echo $billing_address['country']; ?><br>
                        <?php echo $billing_address['pin_code']; ?>
                    </address>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if(!empty($shipping_address)) { ?>
        <div class="col-md-6">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Shipping Address</h3>
                </div>
                <div class="block-content">
                    <address>
                        <?php echo $shipping_address['address_line_1']; ?><br>
                        <?php echo $shipping_address['address_line_2']; ?><br>
                        <?php echo $shipping_address['landmark']; ?><br>
                        <?php echo $shipping_address['city']; ?>, <?php echo $shipping_address['state']; ?>, <?php echo $shipping_address['country']; ?><br>
                        <?php echo $shipping_address['pin_code']; ?>
                    </address>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<h2 class="content-heading">Cart</h2>
<div class="block block-rounded">
    <div class="block-content">
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Product</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Added On</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($cart_products)) { ?>
                    <?php foreach ($cart_products as $key => $cart_product) { ?>
                        <tr>
                            <td><a href="<?php echo site_url('product/edit/'.$cart_product['id']); ?>"><?php echo $cart_product['id']; ?></a></td>
                            <td class="text-center"><?php echo $cart_product['category']; ?></td>
                            <td class="text-center"><?php echo $cart_product['name']; ?></td>
                            <td class="text-center"><?php echo $cart_product['quantity']; ?></td>
                            <td class="text-center"><?php echo show_price($cart_product['price']); ?></td>
                            <td class="text-center"><?php echo convert_db_time($cart_product['created_on']); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">No products added yet</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<h2 class="content-heading">Wallet Total <?php echo show_price($wallet); ?></h2>
<div class="block block-rounded">
    <div class="block-content">
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th style="width: 100px;">Date</th>
                    <th class="text-center">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($wallet_transactions)) { ?>
                    <?php foreach($wallet_transactions as $wallet_transaction) { ?>
                        <tr>
                            <td scope="row"><?php echo convert_db_time($wallet_transaction['created_on'], "d/m/Y H:i"); ?></td>
                            <td class="text-center"><?php echo show_price($wallet_transaction['amount']); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="2">No transactions done yet</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<h2 class="content-heading">Past Orders</h2>
<div class="block block-rounded">
    <div class="block-content">
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Placed On</th>
                    <th class="text-center">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($orders)) { ?>
                    <?php foreach ($orders as $key => $order) { ?>
                        <tr>
                            <td><a href="<?php echo site_url('order/view/'.$order['id']); ?>">#<?php echo $order['order_id']; ?></a></td>
                            <td class="text-center"><?php echo get_order_status_text($order['status']); ?></td>
                            <td class="text-center"><?php echo convert_db_time($order['created_on']); ?></td>
                            <td class="text-center"><?php echo show_price($order['total']); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="4">No orders yet</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>