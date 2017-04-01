<?php

namespace Stroopwafel\Sysconfsearch\Model;

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
        \Magento\Config\Model\Config\Structure $structure,
        \Magento\Config\Model\Config\Structure\Data $structureData
    ) {
        $this->structure = $structure;
        $this->data = $structureData->get();

        var_dump($this->data);exit;
    }

    public function byKeyword(string $keyword):array
    {
        return $this->data;
    }
}
