<div class="cover" style="background-image: <?php echo isset($imageUrl) ? 'url(\'' . escAttr($imageUrl) . '\')' : 'none'; ?>;">

	<div class="box-container">

	<?php foreach($blockNames as $blockName) { ?>
		<section class="box">
			<?php if(ipIsManagementState()) { ?>
			<a href="#" class="button ipWidgetCoverImageRemove" title="Remove">x</a>
			<?php } ?>
			<?php echo ipBlock($blockName)->render($revisionId); ?>
		</section>
		<?php } ?>
	</div>

</div>
