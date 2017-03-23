<section>
	<?php if (!empty($imageUrl)) { ?>
		<img src="<?php echo $imageUrl; ?>" alt="">
	<?php } else if (ipIsManagementState()) { ?>
		<div class="no-image">
			Select an image
		</div>
	<?php } ?>
	<?php echo ipBlock($blockName)->render($revisionId); ?>
</section>
