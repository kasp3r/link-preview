<?php

namespace LinkPreview\Model;

/**
 * Interface LinkInterface
 */
interface LinkInterface
{
    /**
     * Get source code
     * @return string
     */
    public function getContent();

    /**
     * Get source content type (example: text/html, image/jpg)
     * @return string
     */
    public function getContentType();

    /**
     * Get description
     * @return string
     */
    public function getDescription();

    /**
     * Get image url
     * @return string
     */
    public function getImage();

    /**
     * Get image url
     * @return string
     */
    public function getPictures();

    /**
     * Get real url after all redirects
     * @return string
     */
    public function getRealUrl();

    /**
     * Get title
     * @return string
     */
    public function getTitle();

    /**
     * Get page title
     * @return string
     */
    public function getPageTitle();

    /**
     * Get website url
     * @return string
     */
    public function getUrl();

    /**
     * Set source code
     * @param string $content
     * @return $this
     */
    public function setContent($content);

    /**
     * Set source content type (example: text/html, image/jpg)
     * @param string $contentType
     * @return $this
     */
    public function setContentType($contentType);

    /**
     * Set description
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Set image url
     * @param string $image
     * @return $this
     */
    public function setImage($image);

    /**
     * Set real url after all redirects
     * @param string $realUrl
     * @return $this
     */
    public function setRealUrl($realUrl);

    /**
     * Set title
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set title
     * @param string $title
     * @return $this
     */
    public function setPageTitle($title);

    /**
     * Set website url
     * @param string $url
     * @return $this
     */
    public function setUrl($url);

    /**
     * Set website pictures
     * @param string $url
     * @return $this
     */
    public function setPictures(array $urls);
}