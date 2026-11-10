<?php

declare(strict_types=1);

namespace Refresj\FacebookSocialplugins\Preview;

use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PluginPreviewRenderer extends StandardContentPreviewRenderer
{

    private const DOMAIN = 'facebook_socialplugins.backend:';

    private const PLUGIN_LABELS = [
        'share_button'   => 'plugin.share_button',
        'page_plugin'    => 'plugin.page_plugin',
        'embedded_post'  => 'plugin.embedded_post',
        'embedded_video' => 'plugin.embedded_video',
    ];

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $record   = $item->getRecord()->getRawRecord()->toArray();
        $flexForm = GeneralUtility::makeInstance(FlexFormTools::class)
            ->convertFlexFormContentToArray((string)($record['pi_flexform'] ?? ''));

        $settings    = $flexForm['settings'] ?? [];
        $plugin      = (string)($settings['plugin'] ?? '');
        $langService = $this->getLanguageService();

        if ($plugin === '') {
            return '<p><em>' . htmlspecialchars($langService->label(self::DOMAIN . 'plugin.select')) . '</em></p>';
        }

        $pluginLabel = isset(self::PLUGIN_LABELS[$plugin])
            ? $langService->label(self::DOMAIN . self::PLUGIN_LABELS[$plugin])
            : $plugin;

        $href = match ($plugin) {
            'share_button' => ($settings['share_href_type'] ?? 'custom') === 'current'
                ? $langService->label(self::DOMAIN . 'share_href_type.current')
                : (string)($settings['share_href'] ?? ''),
            default        => (string)($settings['href'] ?? ''),
        };

        $out = '<strong>' . htmlspecialchars($pluginLabel) . '</strong>';

        if ($href !== '') {
            $out .= '<br><small>' . htmlspecialchars($href) . '</small>';
        }

        return $out;
    }

    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
