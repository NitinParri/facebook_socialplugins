<?php

declare(strict_types=1);

use Refresj\FacebookSocialplugins\Preview\PluginPreviewRenderer;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

$pluginSignature = ExtensionUtility::registerPlugin(
    'FacebookSocialplugins',
    'Plugin',
    'facebook_socialplugins.backend:plugin.title',
    'content-facebooksocialplugins-plugin',
    'Refresj',
    'facebook_socialplugins.backend:plugin.description',
    'FILE:EXT:facebook_socialplugins/Configuration/FlexForms/Plugin.xml'
);

$GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['previewRenderer'] = PluginPreviewRenderer::class;
