<?php

declare(strict_types=1);

use Refresj\FacebookSocialplugins\Controller\PluginController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'FacebookSocialplugins',
    'Plugin',
    [PluginController::class => 'index'],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
