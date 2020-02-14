<p>You have a new contact from website,</p>
<table cellpadding="10" cellspacing="0" border="1" width="100%">
	<tr>
		<td width="25%">Name</td>
		<td width="75%"><?php echo $data['name']; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo $data['email']; ?></td>
	</tr>
	<tr>
		<td>Subject</td>
		<td><?php echo $data['subject']; ?></td>
	</tr>
	<tr>
		<td>Message</td>
		<td><?php echo $data['message']; ?></td>
	</tr>
</table>