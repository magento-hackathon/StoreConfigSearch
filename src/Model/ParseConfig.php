<?php

namespace Stroopwafel\StoreConfigSearch\Model;

class ParseConfig
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $labels;

    /**
     * ParseConfig constructor.
     * @param array $config
     */
    public function __construct(
        array $config
    )
    {
        $this->config = $config;
    }


    public function getAllLabels()
    {
        if (!$this->labels) {
            $this->labels = [];

            if (isset($this->config['sections'])) {
                array_map([$this, 'exploreSection'], $this->config['sections']);
            }
        }

        return $this->labels;
    }


    public function exploreSection($section)
    {
        if (isset($section['children'])) {
            array_map([$this, 'exploreSectionChildren'], $section['children']);
        }
    }


    public function exploreSectionChildren($field)
    {
        if (isset($field['label'])) {
            $this->labels[] = $field['label'];
        }
    }
}
