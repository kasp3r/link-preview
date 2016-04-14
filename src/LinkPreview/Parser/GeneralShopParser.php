<?php

namespace LinkPreview\Parser;

/**
 * Class GeneralShopParser
 * @author Alex Schwarz <alexschwarz@live.de>
 * @package LinkPreview\Parser
 */
class GeneralShopParser extends GeneralParser implements ParserInterface
{
    /**
     * Extends the parent method and searches for price information
     *
     * @param $html
     * @return array
     */
    protected function parseHtml($html)
    {
        $data = parent::parseHtml($html);
        $doc = new \DOMDocument();
        $doc->loadHTML($html);
        $xpath = new \DOMXPath($doc);
        $nodes = $xpath->query('//*[@itemprop="price"]');
        if (count($nodes) > 0) {
            foreach ($nodes as $node) {
                $data['prices'][] =  $node->hasAttribute('content') ? $node->getAttribute('content') : trim($node->textContent);
            }
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function parseLink()
    {
        $link = parent::parseLink();
        $htmlData = $this->parseHtml($link->getContent());
        if (isset($htmlData['prices'])) {
            $link->setPrices($htmlData['prices']);
        }

        return $link;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return 'generalShop';
    }
}