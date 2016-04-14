<?php

namespace LinkPreview\Tests\Parser;

use LinkPreview\Parser\GeneralShopParser;

class GeneralShopParserTest extends GeneralParserTest
{
    /**
     * @dataProvider urlProvider
     * @param string $url
     * @param bool $expectedResult
     */
    public function testIsValidParser($url, $expectedResult)
    {
        $linkMock = $this->getMock('LinkPreview\Model\ShopLink', null);

        $parser = new GeneralShopParser();
        $parser->setLink($linkMock->setUrl($url));
        self::assertEquals($parser->isValidParser(), $expectedResult);
    }
}