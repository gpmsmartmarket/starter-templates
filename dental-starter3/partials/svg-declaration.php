<?php 
					
	$icon_style = "square";
	if (function_exists('contact_detail')) { 
		$fb = contact_detail('facebook', '' , '', false); 
		$twitter = contact_detail('twitter', '' , '', false);
		$google = contact_detail('google+', '' , '', false);
		$linkedin = contact_detail('linkedin', '' , '', false);
		$youtube = contact_detail('youtube', '' , '', false);
	} 
?>
<?php if (!empty($fb) || !empty($twitter) || !empty($google) || !empty($linkedin) || !empty($youtube)) : ?>
<div class="social-links">
	<?php if (!empty($fb)) : ?>
		<a href="<?php echo $fb; ?>" target="_blank" class="icon-facebook-<?php echo $icon_style; ?>">
			<i class="fab fa-facebook-square"></i>
	    </a>
	<?php endif; ?>
	<?php if (!empty($twitter)) : ?>
		<a href="<?php echo $twitter; ?>" target="_blank" class="icon-twitter-<?php echo $icon_style; ?>">
			<i class="fab fa-twitter"></i>
	    </a>
	<?php endif; ?>
	<?php if (!empty($google)) : ?>
		<a href="<?php echo $google; ?>" target="_blank" class="icon-googleplus-<?php echo $icon_style; ?>">
			<i class="fab fa-google"></i>
	    </a>
	<?php endif; ?>
	<?php if (!empty($linkedin)) : ?>
		<a href="<?php echo $linkedin; ?>" target="_blank" class="icon-linkedin-<?php echo $icon_style; ?>">
			<i class="fab fa-linkedin"></i>
	    </a>
	<?php endif; ?>
	<?php if (!empty($youtube)) : ?>
	<a href="<?php echo $youtube; ?>" target="_blank" class="icon-youtube-<?php echo $icon_style; ?>">
		<i class="fab fa-youtube"></i>
	</a>
	<?php endif; ?>
</div>
<?php endif; ?>