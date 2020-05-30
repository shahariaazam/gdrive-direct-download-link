<?php
/**
 * GoogleDriveLinkTest class
 *
 * @package  ShahariaAzam\GDriveLinkExtractor\Tests
 */


namespace ShahariaAzam\GDriveLinkExtractor\Tests;


use PHPUnit\Framework\TestCase;
use ShahariaAzam\GDriveLinkExtractor\GoogleDriveLink;
use ShahariaAzam\GDriveLinkExtractor\LinkException;

class GoogleDriveLinkTest extends TestCase
{
    public function testExtraction()
    {
        $sharableLink = "https://drive.google.com/file/d/FAKE_FILE_ID/view?usp=sharing";
        $extractor = new GoogleDriveLink($sharableLink);
        $extractor->extract();
        $this->assertEquals("https://drive.google.com/uc?export=download&id=FAKE_FILE_ID", $extractor->getDirectLink());
    }

    public function testExtractionInvalidLink()
    {
        $this->expectException(LinkException::class);

        $sharableLink = "FAKE_URL.com";
        $extractor = new GoogleDriveLink($sharableLink);
        $extractor->extract();
        $this->assertEquals("https://drive.google.com/uc?export=download&id=FAKE_FILE_ID", $extractor->getDirectLink());
    }

    public function testGet()
    {
        $sharableLink = "https://drive.google.com/file/d/FAKE_FILE_ID/view?usp=sharing";
        $this->assertEquals('https://drive.google.com/uc?export=download&id=FAKE_FILE_ID', GoogleDriveLink::get($sharableLink));
    }

    public function testWithoutAnyLink()
    {
        $this->expectException(LinkException::class);

        $extractor = new GoogleDriveLink();
        $extractor->extract();
        $extractor->getDirectLink();
    }

    public function testExtractionWithoutProvidingLinkToConstructor()
    {
        $sharableLink = "https://drive.google.com/file/d/FAKE_FILE_ID/view?usp=sharing";

        $extractor = new GoogleDriveLink();
        $extractor->extract($sharableLink);
        $extractor->getDirectLink();

        $this->assertEquals($sharableLink, $extractor->getSharableLink());
        $this->assertEquals('https://drive.google.com/uc?export=download&id=FAKE_FILE_ID', $extractor->getDirectLink());
    }
}