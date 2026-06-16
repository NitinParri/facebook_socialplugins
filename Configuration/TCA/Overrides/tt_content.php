<?php

declare(strict_types=1);

use Refresj\FacebookSocialplugins\Preview\PluginPreviewRenderer;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::registerPlugin(
    'FacebookSocialplugins',
    'Plugin',
    'Facebook Social Plugin',
    'content-facebooksocialplugins-plugin',
    'Refresj',
    'Embed Facebook Social Plugins',
    'FILE:EXT:facebook_socialplugins/Configuration/FlexForms/Plugin.xml'
);

$pluginSignature = 'facebooksocialplugins_plugin';

$GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['previewRenderer'] = PluginPreviewRenderer::class;
