<?php

namespace Stroopwafel\StoreConfigSearch\Model;

class Search
{

    /**
     * @var \Magento\Config\Model\Config\Structure
     */
    protected $structure;

    /**
     * @var \Magento\Config\Model\Config\Structure\Data
     */
    protected $data;


    public function __construct(
        \Magento\Config\Model\Config\Structure\Data $structureData
    )
    {
        $this->structureDate = $structureData;
    }


    public function byKeyword($keyword)
    {
        $this->data = $this->structureDate->get();

        return $this->data;
    }
}
