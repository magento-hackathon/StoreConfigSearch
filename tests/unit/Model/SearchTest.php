<?php

namespace Stroopwafel\StoreConfigSearchTests\Model;

use Stroopwafel\StoreConfigSearch\Model\Search;
use Stroopwafel\StoreConfigSearchTests\Mock\StructuredData;

/**
 * @covers Search
 */
class SearchTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Magento\Config\Model\Config\Structure\Data
     */
    protected $dataMock;

    protected function setUp()
    {
        $this->dataMock = $this->getMockBuilder(\Magento\Config\Model\Config\Structure\Data::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();

        $this->dataMock->method('get')
            ->willReturn(StructuredData::provideData());
    }

    /**
     * @var Search::byKeyword
     */
    public function testByKeyword()
    {
        $search = new Search($this->dataMock);
        $hits = $search->byKeyword('city');

        $this->assertEquals(['city' => [
            'label' => 'City',
            'path' => 'general/store_information',
            'tab' => 'Store Information'
        ]], $hits);
    }
}