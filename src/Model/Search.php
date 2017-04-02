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

    protected $labels;


    public function __construct(
        \Magento\Config\Model\Config\Structure\Data $structureData
    )
    {
        $this->structureDate = $structureData;
    }


    public function byKeyword($keyword)
    {
        $config = $this->structureDate->get();
        if (isset($config['sections'])) {
            $sections = $config['sections'];
            return $this->getAllLabels($sections);
        }


        //return $config;
    }


    public function getAllLabels($sections)
    {
        if (!$this->labels) {
            $this->labels = [];
            array_map([$this, 'exploreSection'], $sections);
        }

        return $this->labels;
    }


    public function exploreSection($section)
    {
        array_map([$this, 'exploreSectionChildren'], $section['children']);
    }


    public function exploreSectionChildren($field)
    {
        if (isset($field['label'])) {
            $this->labels[] = $field['label'];
        }
    }


    public function byKeyword1($keyword)
    {
        $config = $this->structureDate->get();

        if (isset($config['system'])) {
            $sections = $config['system']['sections'];

            foreach ($sections as $section) {

            }
        }

        return $this->data;
    }
}
