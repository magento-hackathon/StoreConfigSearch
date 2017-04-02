<?php

namespace Stroopwafel\Searchsysconf\Tests;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 * @covers
 */
class SearchTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Stroopwafel\StoreConfigSearch\Model\Search
     */
    protected $dataModel;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->dataModel = $objectManager->getObject(\Stroopwafel\StoreConfigSearch\Model\Search::class);
    }

    public function testSearchPhrase()
    {
        $raw = $this->dataModel->byKeyword('foobar');
        var_dump($raw);
    }
}
