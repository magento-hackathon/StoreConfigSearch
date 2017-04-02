<?php

namespace Stroopwafel\StoreConfigSearchTests\Model;

use Stroopwafel\StoreConfigSearch\Model\ParseConfig;
use Stroopwafel\StoreConfigSearchTests\Mock\StructuredData;

/**
 * @covers ParseConfig
 */
class ParseConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ParseConfig
     */
    protected $parseConfig;

    protected function setUp()
    {
        $this->parseConfig = new ParseConfig(StructuredData::provideData());
    }

    /**
     * @var ParseConfig::walkSectionChildren
     */
    public function testWalkSectionChildren()
    {
        $label = $this->parseConfig->walkSectionChildren([
            'id' => 'name',
            'translate' => 'label',
            'type' => 'text',
            'sortOrder' => '10',
            'showInDefault' => '1',
            'showInWebsite' => '1',
            'showInStore' => '1',
            'label' => 'Store Name',
            '_elementType' => 'field',
            'path' => 'general/store_information',
        ]);

        $this->assertEquals('Store Name', $label['label']);
        $this->assertEquals('general/store_information', $label['path']);
        $this->assertNull($label['tab']);
        $this->assertCount(3, $label);
    }

    /**
     * @var ParseConfig::getAllLabels
     */
    public function testGetAllLabels()
    {
        $label = $this->parseConfig->getAllLabels();

        $this->assertCount(5, $label);

        $this->assertEquals([
            'name' => [
                'label' => 'Store Name',
                'path' => 'general/store_information',
                'tab' => 'Store Information',
            ],
            'city' => [
                'label' => 'City',
                'path' => 'general/store_information',
                'tab' => 'Store Information',
            ],
            'street_line1' => [
                'label' => 'Street Address',
                'path' => 'general/store_information',
                'tab' => 'Store Information',
            ],
            'street_line2' => [
                'label' => 'Street Address Line 2',
                'path' => 'general/store_information',
                'tab' => 'Store Information',
            ],
            'merchant_vat_number' => [
                'label' => 'VAT Number',
                'path' => 'general/store_information',
                'tab' => 'Store Information',
            ]], $label);
    }
}