<?php

namespace LinkPreview\Reader;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\TransferStats;
use LinkPreview\Model\LinkInterface;

/**
 * Class GeneralReader
 */
class GeneralReader implements ReaderInterface
{
    /**
     * @var Client $client
     */
    private $client;
    /**
     * @inheritdoc
     */
    private $link;

    /**
     * @return Client
     */
    public function getClient()
    {
        if (!$this->client) {
            // Add a 30s timeout as a fallback - some sites block us indefinitely and never return.
            $this->client = new Client([RequestOptions::COOKIES => true, timeout => 30]);
        }

        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @inheritdoc
     */
    public function setLink(LinkInterface $link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function readLink()
    {
        $link = $this->getLink();

        $client = $this->getClient();
        $response = $client->request(
            'GET',
            $link->getUrl(),
            [
                'on_stats' => function (TransferStats $stats) use (&$effectiveUrl) {
                    $effectiveUrl = $stats->getEffectiveUri();
                }
            ]
        );

        $headerContentType = $response->getHeader('content-type');
        $contentType = '';
        if (is_array($headerContentType) && count($headerContentType) > 0) {
            $contentType = current(explode(';', current($headerContentType)));
        }

        $link->setContent((string)$response->getBody())
            ->setContentType($contentType)
            ->setRealUrl($effectiveUrl);

        return $link;
    }
}