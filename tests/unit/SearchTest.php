<?php

namespace Stroopwafel\Searchsysconf\Tests;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 * @covers
 */
class SearchTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Stroopwafel\Sysconfsearch\Model\Search
     */
    protected $dataModel;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->dataModel = $objectManager->getObject(\Stroopwafel\Sysconfsearch\Model\Search::class);
    }

    public function testSearchPhrase()
    {
        $raw = $this->dataModel->byKeyword('foobar');
        var_dump($raw);
    }
}