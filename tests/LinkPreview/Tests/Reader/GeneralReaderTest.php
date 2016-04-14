<?php

namespace LinkPreview\Tests\Reader;

use LinkPreview\Reader\GeneralReader;

class GeneralReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testReadLink()
    {
        $responseMock = $this->getMock(
            'GuzzleHttp\Psr7\Response',
            ['getBody', 'getHeader'],
            [],
            '',
            false
        );
        $responseMock->expects(self::once())
            ->method('getBody')
            ->will(self::returnValue('body'));
        $responseMock->expects(self::once())
            ->method('getHeader')
            ->will(self::returnValue(array('text/html; UTF-8')));

        $clientMock = $this->getMock('GuzzleHttp\Client');
        $clientMock->expects(self::once())
            ->method('request')
            ->will(self::returnValue($responseMock));

        $linkMock = $this->getMock('LinkPreview\Model\Link', null);

        $reader = new GeneralReader();
        $reader->setClient($clientMock);
        $reader->setLink($linkMock);
        $link = $reader->readLink();

        self::assertEquals('body', $link->getContent());
        self::assertEquals('text/html', $link->getContentType());
    }
}
