<?php
declare(strict_types=1);

/**
 * @author Laura Folco <me@laurafolco.com>
 * @copyright Copyright (c) 2017 FireGento e.V.
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Stroopwafel\StoreConfigSearch\Model;


/**
 * @covers Search
 */
class SearchTest extends \PHPUnit\Framework\TestCase
{


    /** @var ParseConfig */
    private $parseConfig;

    /** @var \Magento\Config\Model\Config\Structure\Data */
    private $structureDataMock;

    /** @var \Magento\Backend\Model\Url */
    private $urlModelMock;


    protected function setUp()
    {
        $this->urlModelMock = $this->getMockBuilder(\Magento\Backend\Model\Url::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->getMock();

//        $structureData           = require dirname(__DIR__) . '/_files/structured_data.php';
//        $this->structureDataMock = $this->getMockBuilder(\Magento\Config\Model\Config\Structure\Data::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//        $this->structureDataMock->expects(static::once())
//            ->method('get')
//            ->willReturn($structureData['config']['system']);
//        $this->structureDataMock->merge($structureData);

        $this->parseConfig = $this->getMockBuilder(\Stroopwafel\StoreConfigSearch\Model\ParseConfig::class)
            ->disableOriginalConstructor()
            ->getMock();
        $parsedData           = require dirname(__DIR__) . '/_files/parsed_data.php';
        $this->parseConfig->expects(static::once())
            ->method('getParsedData')
            ->willReturn($parsedData);
    }


    protected function tearDown()
    {
        unset($this->structureDataMock);
        unset($this->parseConfig);
        unset($this->urlModelMock);
    }


    protected function setupSearch()
    {
        $model = new \Stroopwafel\StoreConfigSearch\Model\Search(
            $this->parseConfig,
            $this->urlModelMock
        );
        return $model;
    }


    /**
     * @var Search::byKeyword
     */
    public function testByKeyword()
    {
        $search = $this->setupSearch();
        $hits   = $search->byKeyword('Field 2');
        $result = $hits[0];

        static::assertEquals(['Field 2' => [
            'label' => 'City',
            'path'  => 'general/store_information',
            'tab'   => 'Store Information'
        ]], $hits);
    }
}
