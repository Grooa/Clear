<?php
$hasPageImage = false;

if (in_array('PageImage', \Ip\Internal\Plugins\Service::getActivePluginNames()) &&
    !empty(ipContent()->getCurrentPage())) {
    $hasPageImage = !empty(\Plugin\PageImage\Model::getPageImages(ipContent()->getCurrentPage()->getId()));
} ?>