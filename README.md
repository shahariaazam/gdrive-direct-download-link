# Google Drive Download Link Extractor

![Code Checks](https://github.com/shahariaazam/gdrive-direct-download-link/workflows/Tests/badge.svg)
![Build](https://scrutinizer-ci.com/g/shahariaazam/gdrive-direct-download-link/badges/build.png)
![Code Coverage](https://scrutinizer-ci.com/g/shahariaazam/gdrive-direct-download-link/badges/coverage.png)
![Code Rating](https://scrutinizer-ci.com/g/shahariaazam/gdrive-direct-download-link/badges/quality-score.png)
![Code Intellegence](https://scrutinizer-ci.com/g/shahariaazam/gdrive-direct-download-link/badges/code-intelligence.svg)

Get direct download link from any Google Drive sharable link. So you don't need to open Google Drive
webpage to download the file.

Also it can help you to embed assets anywhere because the link you will extract from this library
will directly download the assets without going to any middle-page.


### Installation

It's very easy to use with `composer`. Run the following command -

```bash
composer require shahariaazam/gdrive-direct-download-link
```

It will add the package `shahariaazam/gdrive-direct-download-link` in your project.

## Usage

### Via Composer

```php
<?php
use ShahariaAzam\GDriveLinkExtractor\GoogleDriveLink;

require "vendor/autoload.php";

$sharableURL = 'GOOGLE_DRIVE_SHARABLE_LINK';
$downloadLink = GoogleDriveLink::get($sharableURL);
```

### Without Installation
It's a very tiny library. But if you don't want to install it. Here is the function that you can
use.

```php
<?php

function downloadLink($sharableLink)
{
    return preg_replace("/\/file\/d\/(.+)\/(.+)/", "/uc?export=download&id=$1", $sharableLink);
}

echo downloadLink('https://drive.google.com/file/d/FAKE_FILE_ID/view?usp=sharing');
```

Yes, it's that simple. 

**Note:** I just made this as a composer package because I wanted to make it testable for future
compatibility