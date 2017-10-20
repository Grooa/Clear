<?php echo ipDoctypeDeclaration(); ?>
<html<?php echo ipHtmlAttributes(); ?>>

<head>
    <?php ipAddCss('assets/theme.css'); ?>
    <?php echo ipHead(); ?>
    <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false) { ?>
        <style type="text/css">
            .cover {
                display: block !important;
            }
        </style>
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach (array(16, 32, 192) as $size) { ?>
        <link rel="icon" type="image/png" href="<?php echo ipThemeUrl("assets/icons/icon$size.png") ?>"
              sizes="<?php echo "${size}x${size}" ?>">
    <?php } ?>
</head>

<body>

<header>
    <div class="logo">
        <img src="<?php echo ipThemeUrl('assets/img/logopurple.svg'); ?>" alt="The CLEAR Mindset">
        <a href="<?= ipConfig()->baseUrl() ?>" title="home">
            <h1 class="title">The C.L.E.A.R.&trade; Mindset</h1>
        </a>
        <span class="subtitle">
                A product by
                <a href="http://grooa.com" target="_blank">
                    Grooa - Leading with a smile
                </a>
        </span>
    </div>

    <div class="navigation">
        <?php
        $secondaryMenu = \Ip\Menu\Helper::getMenuItems('menu2', 1, 1);

        // Load profile page or user-login, if User-plugin is activated
        $modules = \Ip\Internal\Plugins\Service::getActivePluginNames();

        if (in_array('User', $modules)) {
            $userMenu = new \Ip\Menu\Item();
            $loggedIn = ipUser()->isLoggedIn();
            $path = ipRequest()->getRelativePath();

            $userMenu->setPageTitle($loggedIn ? 'My Page' : 'Login');
            $userMenu->setTitle($loggedIn ? 'My Page' : 'Login');
            $userMenu->setUrl($loggedIn ?
                ipConfig()->baseUrl() . ipGetOption('User.urlAfterLogin', 'profile') :
                ipRouteUrl('User_login'));

            if (($loggedIn && $path == 'my-page') ||
                (!$loggedIn && $path == 'login')
            ) {
                $userMenu->markAsCurrent(true);
            }

            $secondaryMenu[] = $userMenu;
        }

        echo ipSlot('menu', array(
            'items' => $secondaryMenu,
            'attributes' => array('class' => 'menu secondary')
        ));
        ?>

        <?php $result = \Ip\Menu\Helper::getMenuItems('menu1', 1, 1); ?>

        <?= ipSlot('menu', array(
            'items' => $result,
            'attributes' => array('class' => 'menu primary')
        )) ?>

</header>
