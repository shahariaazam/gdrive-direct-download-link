<?php
/**
 * GoogleDriveLink class
 *
 * @package  ShahariaAzam\GDriveLinkExtractor
 */


namespace ShahariaAzam\GDriveLinkExtractor;


class GoogleDriveLink
{
    /**
     * @var string
     */
    private $sharableLink;

    /**
     * @var string
     */
    private $directLink;

    /**
     * GoogleDriveLink constructor.
     * @param null $sharableLink
     */
    public function __construct($sharableLink = null)
    {
        $this->sharableLink = $sharableLink;
    }

    /**
     * @param $sharableLink
     * @return string
     * @throws LinkException
     */
    public static function get($sharableLink)
    {
        $extractor = new static();
        $extractor->setSharableLink($sharableLink);
        $extractor->extract();
        return $extractor->getDirectLink();
    }

    /**
     * @param null $sharableLink
     * @return $this
     * @throws LinkException
     */
    public function extract($sharableLink = null)
    {
        if (!empty($sharableLink)) {
            $this->setSharableLink($sharableLink);
        }

        if (empty($this->sharableLink)) {
            throw new LinkException('There is no sharable link to extract');
        }

        if (!$this->validate()) {
            throw new LinkException("Invalid link");
        }

        $directLink = preg_replace("/\/file\/d\/(.+)\/(.+)/", "/uc?export=download&id=$1", $this->sharableLink);
        $this->setDirectLink($directLink);

        return $this;
    }

    protected function validate()
    {
        preg_match('/drive.google.com\/file\/d\/(.*)\/view\?usp=sharing/', $this->sharableLink, $matches,
            PREG_OFFSET_CAPTURE, 0);
        if (empty($matches)) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getDirectLink()
    {
        return $this->directLink;
    }

    /**
     * @param string $directLink
     * @return GoogleDriveLink
     */
    public function setDirectLink($directLink)
    {
        $this->directLink = $directLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getSharableLink()
    {
        return $this->sharableLink;
    }

    /**
     * @param string $sharableLink
     * @return GoogleDriveLink
     */
    public function setSharableLink($sharableLink)
    {
        $this->sharableLink = $sharableLink;
        return $this;
    }

}