<?php if ($logged): ?>
<?php if ($this->session->userdata['IsActive'] == 0): ?>
	<h4 class="alert_warning">
		Thank you !
        Please validate your account throught your email address
	</h4>
<?php endif ?>


<?php if (isset($this->session->userdata['notifications'])): ?>
	<?php if (is_array($this->session->userdata['notifications'])): ?>
		<?php foreach ($this->session->userdata['notifications'] as $notification): ?>
		<input type="hidden" class="notification_" data-url="<?php echo base_url(); ?>" data-id="<?php echo $notification->ID; ?>" value="<?php echo $notification->Text;?>" 
		data-type="<?php echo $notification->Type;?>">
		<?php endforeach ?>
		<?php 
			$this->session->unset_userdata('notifications');
		 ?>
	<?php endif ?>
<?php endif ?>
<?php endif ?>
