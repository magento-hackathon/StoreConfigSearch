<?php

namespace Stroopwafel\StoreConfigSearch\Model;


/**
 * Parses the currently loaded config for labels.
 *
 * @package Stroopwafel\StoreConfigSearch\Model
 */
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
     *
     * @param array $config
     */
    public function __construct(
        array $config
    )
    {
        $this->config = $config;
    }


    /**
     * Get all the labels in the currently loaded config.
     * @return array
     */
    public function getAllLabels()
    {
        if (!$this->labels) {
            $this->labels = [];

            if (isset($this->config['sections'])) {
                array_map([$this, 'walkSection'], $this->config['sections']);
            }
        }

        return $this->labels;
    }


    /**
     * Walk the given section array to get children.
     * @param array $section
     */
    public function walkSection($section)
    {
        if (isset($section['children'])) {
            array_map([$this, 'walkTab'], $section['children']);
        }
    }


    public function walkTab($tab)
    {
        if (isset($tab['children'])) {
            array_map([$this, 'walkSectionChildren'], $tab['children']);
        }
    }


    /**
     * Walk the given array.
     * @param $field
     */
    public function walkSectionChildren($field)
    {
        if (isset($field['label'])) {
            $this->labels[] = [
                'label' => $field['label'],
                'activity_path' => $field['activity_path']
            ];
        }
    }
}
