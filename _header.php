<?php echo ipDoctypeDeclaration(); ?>
<html<?php echo ipHtmlAttributes(); ?>>

	<head>
		<?php ipAddCss('assets/theme.css'); ?>
		<?php echo ipHead(); ?>
		<?php if (strpos($_SERVER['HTTP_USER_AGENT'],'Trident') !== false) {?>
		<style type="text/css">
			.cover {
				display: block !important;
			}
		</style>
		<?php } ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php foreach (array(16, 32, 192) as $size) { ?>
		<link rel="icon" type="image/png" href="<?php echo ipThemeUrl("assets/icons/icon$size.png") ?>" sizes="<?php echo "${size}x${size}" ?>">
		<?php } ?>
	</head>

	<body>

		<header class="hidden">

			<div>
			<div class="top-logo">
				<img src="<?php echo ipThemeUrl('assets/img/logopurple.svg'); ?>" alt="">
				<div class="title">The C.L.E.A.R.&trade; Mindset</div><br>
				<div class="subtitle">
					A product by
					<a href="http://grooa.com" target="_blank">
						Grooa - Leading with a smile
					</a>
				</div>
			</div>

<?php

			$menu_items = \Ip\Menu\Helper::getMenuItems('menu1', 1, 1);

			echo ipSlot('menu', array(
				'items' => $menu_items,
				'attributes' => array('class' => 'menu inverted')
			));

			if (count(ipContent()->getLanguages()) > 1) {
				echo ipSlot('languages', array(
					'attributes' => array('class' => 'languages menu inverted')
				));
			}


?>
			<ul class="menu inverted"><li>
<?php
			if (ipUser()->loggedIn()) {
				echo '<a href="' . ipGetOption('User.urlAfterRegistration') . '">My page</a>';
			} else {
				echo '<a href="' . ipRouteUrl('User_login') . '">Log in</a>';
			}
?>
			</li></ul>
			</div>

		</header>
		<nav>
<?php
			echo ipSlot('menu', array(
				'items' => $menu_items,
				'attributes' => array('class' => 'menu')
			));

			if (count(ipContent()->getLanguages()) > 1) {
				echo ipSlot('languages', array(
					'attributes' => array('class' => 'languages menu')
				));
			}
?>
			<ul class="menu"><li>
<?php
			if (ipUser()->loggedIn()) {
				echo '<a href="' . ipGetOption('User.urlAfterRegistration') . '">My page</a>';
			} else {
				echo '<a href="' . ipRouteUrl('User_login') . '">Log in</a>';
			}
?>
			</li></ul>
		</nav>
