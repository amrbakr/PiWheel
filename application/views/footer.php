
<footer class="footer">
	<div class="container">
		<p class="copyright">Copyright &copy; 2013 , PiWheel , All Rights Reserved.</p>
	</div>
</footer>


<!-- ==============
	jLightbox
=============== -->

<!-- jLightbox overlay -->
<div id="jLightbox-overlay" class="jLightbox-overlay"></div>
<!-- jLightbox -->
<div id="jLightbox" class="jLightbox">
	<div class="lightbox-head"></div>
	<div class="lightbox-body"></div>
</div>

<!-- ==============
	jLightbox Contents
=============== -->

<!-- Edit Email -->
<div id="edit_email_box" class="dn">
<form action="/PiWheel/changeEmail" method="POST" onsubmit="
	var emailCheck = changeMail();
	if(emailCheck == false)
		return false;
	else
		return true;
">
	<table class="dark-fields">
		<tr>
			<th><label>New Email</label></th>
			<td><input type="text" id="newEmail" name="newEmail" placeholder="email@email.com"></td>
			<input type="hidden" name="currentURl" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
		</tr>
		<tr>
			<th></th>
			<td><input class="form-btn red medium fl" type="submit" value="Change Email" name="submitChangeEmail"></td>
			<!-- <td><a href="javascript:void(0);" onclick="changeMail();" class="form-btn red medium fl" style="padding: 0 15px;">Change Email</a></td> -->
		</tr>
		<tr>
			<td colspan="2"><br><p>“A confirmation Email will be sent to this email, please click on the link in it”</p></td>
		</tr>
	</table>
</form>
</div>

<!-- Edit Password -->

<div id="edit_password_box" class="dn">
<form action="/PiWheel/changePassword" method="POST" onsubmit="

		var newPasswordCheck = newPassowordCheck();
		if(newPasswordCheck == false)
			return false;
		else
			return true;
">
	<table class="dark-fields">
		<tr>
			<th><label>New Password</label></th>
			<td><input type="password" id="newPassword_1" name="pass1"></td>
		</tr>
		<tr>
			<th><label>New Password Confirmation</label></th>
			<td><input type="password" id="newPassword_2" name="pass2"></td>
		</tr>
		<tr>
			<th><label>Old Password</label></th>
			<td><input type="password" id="oldPassword" name="pass3"></td>
		</tr>
		<tr>
			<th></th>
			<td><input class="form-btn red medium fl" type="submit" value="Change Password" name="submitChangePassword"></td>
			<!-- <td><a href="" class="form-btn red medium fl" style="padding: 0 15px;">Change Password</a></td> -->
		</tr>
		<tr>
			<input type="hidden" name="currentURl" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<td colspan="2"><br><p>“Done, Next time login with your new password”</p></td>
		</tr>
	</table>
</form>
</div>


<!-- Withdrawal options -->
<div id="withdrawal_options_box" class="dn">
	<table class="dark-fields" style="margin: 0 0 -30px;">
		<tr class="with-option">
			<th></th>
			<td>Paypal  ( yourname@mail.com)</td>
			<td><a href="" class="remove"></a></td>
		</tr>
		<tr class="with-option">
			<th></th>
			<td>Skrill  ( yourname@mail.com)</td>
			<td><a href="" class="remove"></a></td>
		</tr>
		<tr>
			<th></th>
			<td colspan="2">
				<br>
				<span class="underline"><label for="option_name">Add withdrwal Option</label></span>
				<select name="option_name" id="option_name">
					<option value="">Select new withdrawal option</option>
					<option value="Western Union">Western Union</option>
					<option value="U.S. Delivery">U.S. Delivery</option>
				</select>
			</td>
		</tr>
		<tr>
			<th></th>
			<td colspan="2">
				<input type="text" name="option_email" placeholder="yourname@email.com">
			</td>
		</tr>
		<tr>
			<th></th>
			<td colspan="2"><a href="" class="form-btn red medium fl" style="margin:25px 0 0 125px;">Update Info</a></td>
		</tr>
	</table>
</div>

<!-- Withdrawal options -->
<div id="transactions_box" class="dn reduce-padding">
	<div class="transactions">
	<table>
		<tr>
			<th>Method</th>
			<th>Date</th>
			<th>Amout</th>
			<th>Print</th>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<tr>
			<td>Paypal (you@mail.com)</td>
			<td>16/9/13</td>
			<td>200</td>
			<td><a href="" class="print" title="Print"></a></td>
		</tr>
		<!-- <tr>
			<th></th>
			<td colspan="2"><a href="" class="form-btn red medium fl" style="margin:25px 0 0 125px;">Update Info</a></td>
		</tr> -->
	</table>
	</div>
</div>


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>application/js/jquery.min.js"><\/script>');</script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js"></script>-->
<script>
if (typeof jQuery.migrateWarnings == 'undefined') { // or typeof jQuery.fn.live == 'undefined'
	document.write('<script src="<?php echo base_url(); ?>application/js/jquery-migrate-1.2.1.min.js"><\/script>');
}
</script>
<!--[if (gte IE 6)&(lte IE 8)]>
<script src="<?php echo base_url(); ?>js/selectivizr-min.js"></script>
<![endif]-->
<script src="<?php echo base_url(); ?>application/js/plugins.js"></script>
<script src="<?php echo base_url(); ?>application/js/main.js"></script>
<script src="<?php echo base_url(); ?>application/js/course-form.js"></script>
<script src="<?php echo base_url(); ?>application/js/ajaxupload.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID.
<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
</script> -->

</body>
</html>