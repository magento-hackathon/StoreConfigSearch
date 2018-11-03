<?php
declare(strict_types=1);

/**
 * @author Laura Folco <me@laurafolco.com>
 * @copyright Copyright (c) 2017 FireGento e.V.
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Stroopwafel\StoreConfigSearch\Model;


/**
 * see \Magento\Config\Test\Unit\Model\Config\StructureTest
 *
 * @covers ParseConfig
 */
class ParseConfigTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var ParseConfig
     */
    protected $parseConfig;

    /**
     * @var \Magento\Config\Model\Config\Structure\Data
     */
    protected $_structureDataMock;


    protected function setUp()
    {
        $structureData     = require dirname(__DIR__) . '/_files/structured_data.php';
        $this->_structureDataMock = $this->getMockBuilder(\Magento\Config\Model\Config\Structure\Data::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->_structureDataMock->expects(static::once())
            ->method('get')
            ->willReturn($structureData['config']['system']);
        $this->_structureDataMock->merge($structureData);
        $this->parseConfig = new ParseConfig($this->_structureDataMock);
    }


    public function testGetParsedData()
    {
        $expected = require dirname(__DIR__) . '/_files/parsed_data.php';
        $parsedData = $this->parseConfig->getParsedData();
        static::assertEquals($expected, $parsedData);
    }
//
//    /**
//     * @var ParseConfig::walkSectionChildren
//     */
//    public function testWalkSectionChildren()
//    {
//        $label = $this->parseConfig->walkSectionChildren([
//            'id' => 'name',
//            'translate' => 'label',
//            'type' => 'text',
//            'sortOrder' => '10',
//            'showInDefault' => '1',
//            'showInWebsite' => '1',
//            'showInStore' => '1',
//            'label' => 'Store Name',
//            '_elementType' => 'field',
//            'path' => 'general/store_information',
//        ]);
//
//        $this->assertEquals('Store Name', $label['label']);
//        $this->assertEquals('general/store_information', $label['path']);
//        $this->assertNull($label['tab']);
//        $this->assertCount(3, $label);
//    }
//
//    /**
//     * @var ParseConfig::getAllLabels
//     */
//    public function testGetAllLabels()
//    {
//        $label = $this->parseConfig->getAllLabels();
//
//        $this->assertCount(5, $label);
//
//        $this->assertEquals([
//            'name' => [
//                'label' => 'Store Name',
//                'path' => 'general/store_information',
//                'tab' => 'Store Information',
//            ],
//            'city' => [
//                'label' => 'City',
//                'path' => 'general/store_information',
//                'tab' => 'Store Information',
//            ],
//            'street_line1' => [
//                'label' => 'Street Address',
//                'path' => 'general/store_information',
//                'tab' => 'Store Information',
//            ],
//            'street_line2' => [
//                'label' => 'Street Address Line 2',
//                'path' => 'general/store_information',
//                'tab' => 'Store Information',
//            ],
//            'merchant_vat_number' => [
//                'label' => 'VAT Number',
//                'path' => 'general/store_information',
//                'tab' => 'Store Information',
//            ]], $label);
//    }
}
