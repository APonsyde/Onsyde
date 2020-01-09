<p>Hi <?php echo $data['name']; ?>,</p>
<p>Thank you for registering with us.</p>
<hr>
<p>Your login details are,</p>
<p>Email: <?php echo $data['email']; ?></p>
<p>Password: <?php echo ($data['password']) ? $data['password'] : '-- Set by you --'; ?></p>