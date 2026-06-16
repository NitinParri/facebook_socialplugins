# Facebook Social Plugins for TYPO3

[![Donate](https://img.shields.io/badge/PayPal-Donate-green?style=for-the-badge&logo=paypal&logoColor=002991&labelColor=dddddd)](https://paypal.me/NitinParri)
[![TYPO3](https://img.shields.io/badge/TYPO3-facebook__socialplugins-FF8600?style=for-the-badge&logo=typo3&logoColor=FF8600&labelColor=dddddd)](https://extensions.typo3.org/extension/facebook_socialplugins)
[![Repo](https://img.shields.io/badge/Github-repo-blue?style=for-the-badge&logo=github&logoColor=181717&labelColor=dddddd)](https://github.com/NitinParri/facebook_socialplugins)
[![Latest Stable version](https://img.shields.io/packagist/v/refresj/facebook-socialplugins?style=for-the-badge&logo=packagist&logoColor=181717&labelColor=dddddd)](https://packagist.org/packages/refresj/facebook-socialplugins)

TYPO3 extension that integrates [Facebook Social Plugins](https://developers.facebook.com/docs/plugins/) as a content element with full configuration.

## Requirements

- TYPO3 14.3+
- PHP 8.5+

## Plugins

The extension provides a plugin that supports four Facebook Social Plugins:

- **Share Button** — Share any URL or the current page
- **Page Plugin** — Embed a Facebook page with configurable tabs, dimensions and display options
- **Embedded Post** — Embed a public Facebook post
- **Embedded Video / Live Video Player** — Embed a Facebook video or live stream

## Installation

Install via Composer:

```bash
composer require refresj/facebook-socialplugins
```

Add the Site Set to your site configuration (`config/sites/<your-site>/config.yaml`):

```yaml
dependencies:
    - refresj/facebook-socialplugins
```

Or add it as a dependency of your own Site Set.

## Configuration

Settings are managed via **_Sites → Setup → Gear icon button (bottom right of your site)_** under the **Facebook Social Plugins** category.

| Setting  | Description                                                                                      | Default   |
| -------- | ------------------------------------------------------------------------------------------------ | --------- |
| `appId`  | Facebook App ID — create one at [developers.facebook.com](https://developers.facebook.com/apps/) | _(empty)_ |
| `locale` | SDK locale, e.g. `nl_NL`, `en_US`, `de_DE`                                                       | `en_US`   |

These can also be set directly in TypoScript:

```typo3_typoscript
plugin.tx_facebooksocialplugins.settings {
    appId  = your-app-id
    locale = nl_NL
}
```

## Facebook JavaScript SDK

The SDK is loaded automatically via TYPO3's `AssetCollector`. When multiple Facebook Social Plugin content elements are placed on the same page, the SDK is only loaded once.

The SDK version used is `v25.0` (current stable).

## Languages

The backend labels are available in English and Dutch. Translation files are located in `Resources/Private/Language/`.

## License

GPL-2.0-or-later
