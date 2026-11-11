<?php

declare(strict_types=1);

namespace Refresj\FacebookSocialplugins\Preview;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\Preview\StandardContentPreviewRenderer;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools;
use TYPO3\CMS\Core\Localization\LanguageService;

#[Autoconfigure(public: true)]
final readonly class PluginPreviewRenderer implements PreviewRendererInterface
{

    private const DOMAIN = 'facebook_socialplugins.backend:';

    private const PLUGIN_LABELS = [
        'share_button'   => 'plugin.share_button',
        'page_plugin'    => 'plugin.page_plugin',
        'embedded_post'  => 'plugin.embedded_post',
        'embedded_video' => 'plugin.embedded_video',
    ];

    public function __construct(
        private StandardContentPreviewRenderer $standardContentPreviewRenderer,
        private FlexFormTools $flexFormTools,
    ) {}

    public function renderPageModulePreviewHeader(GridColumnItem $item): string
    {
        return $this->standardContentPreviewRenderer->renderPageModulePreviewHeader($item);
    }

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $row      = $item->getRow();
        $flexForm = $this->flexFormTools->convertFlexFormContentToArray((string)($row['pi_flexform'] ?? ''));

        $settings = $flexForm['settings'] ?? [];
        $plugin   = (string)($settings['plugin'] ?? '');

        if ($plugin === '') {
            return '<p><em>' . htmlspecialchars($this->getLabel('plugin.select')) . '</em></p>';
        }

        $pluginLabel = isset(self::PLUGIN_LABELS[$plugin])
            ? $this->getLabel(self::PLUGIN_LABELS[$plugin])
            : $plugin;

        $href = (string)($settings['href'] ?? '');

        if ($plugin === 'share_button') {
            $href = ($settings['share_href_type'] ?? 'custom') === 'current'
                ? $this->getLabel('share_href_type.current')
                : (string)($settings['share_href'] ?? '');
        }

        $out = '<strong>' . htmlspecialchars($pluginLabel) . '</strong>';

        if ($href !== '') {
            $out .= '<br><small>' . htmlspecialchars($href) . '</small>';
        }

        return $out;
    }

    public function renderPageModulePreviewFooter(GridColumnItem $item): string
    {
        return $this->standardContentPreviewRenderer->renderPageModulePreviewFooter($item);
    }

    public function wrapPageModulePreview(string $previewHeader, string $previewContent, GridColumnItem $item): string
    {
        return $this->standardContentPreviewRenderer->wrapPageModulePreview($previewHeader, $previewContent, $item);
    }

    private function getLabel(string $key): string
    {
        // label() can return null or a Stringable, so cast it (strict types)
        return (string)$this->getLanguageService()->label(self::DOMAIN . $key, [], $key);
    }

    private function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
