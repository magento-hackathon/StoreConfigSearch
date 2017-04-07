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
     * @var string
     */
    protected $tabLabel;


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
                $this->labels = array_filter($this->labels, function($value) {
                    return null!==$value;
                });
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


    /**
     * Walk the given tab array to get children.
     * @param $tab
     * @return array
     */
    public function walkTab($tab)
    {
        if (isset($tab['label'])) {
            $this->tabLabel = $tab['label'];
        }
        if (isset($tab['children'])) {
            $this->labels = array_merge($this->labels, array_map([$this, 'walkSectionChildren'], $tab['children']));
        }
    }


    /**
     * Walk the given section children array.
     * @param $field
     * @return array
     */
    public function walkSectionChildren($field)
    {
        if (isset($field['label'], $field['path'])) {
            return [
                'label' => $field['label'],
                'path' => $field['path'],
                'tab' => $this->tabLabel
            ];
        }
    }
}
