<?php

declare(strict_types=1);

namespace Refresj\FacebookSocialplugins\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class PluginController extends ActionController
{

    public function __construct(
        private readonly ContentObjectRenderer $contentObjectRenderer
    ) {}

    public function indexAction(): ResponseInterface
    {
        $settings = $this->settings;
        $plugin   = (string)($settings['plugin'] ?? '');

        if ($plugin === 'share_button') {
            $hrefType = (string)($settings['share_href_type'] ?? 'custom');

            $settings['share_href'] = $hrefType === 'current'
                ? $this->getCurrentPageUrl()
                : $this->sanitizeUrl((string)($settings['share_href'] ?? ''));
        } else {
            $settings['href'] = $this->sanitizeUrl((string)($settings['href'] ?? ''));
        }

        $this->view->assign('settings', $settings);

        return $this->htmlResponse();
    }

    private function getCurrentPageUrl(): string
    {
        return $this->contentObjectRenderer->typoLink_URL([
            'parameter'        => 't3://page?uid=current',
            'forceAbsoluteUrl' => true,
        ]);
    }

    private function sanitizeUrl(string $url): string
    {
        $url = trim($url);

        if ($url === '' || !GeneralUtility::isValidUrl($url)) {
            return '';
        }

        $scheme = strtolower((string)parse_url($url, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https'], true) ? $url : '';
    }
}
