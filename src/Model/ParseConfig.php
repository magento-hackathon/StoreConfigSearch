<?php
declare(strict_types=1);

namespace Stroopwafel\StoreConfigSearch\Model;

/**
 * @author Laura Folco <me@laurafolco.com>
 * @copyright Copyright (c) 2017 FireGento e.V.
 * @license https://opensource.org/licenses/MIT MIT
 */

use Magento\Framework\DataObject;
use Magento\Config\Model\Config\Structure\Data as StructureData;


/**
 * Parses the currently loaded config for labels.
 *
 * TODO: should we use DataObject?
 * TODO: caching
 * TODO: translation
 *
 * @package Stroopwafel\StoreConfigSearch\Model
 */
class ParseConfig extends DataObject
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $labels;

    /** @var array */
    protected $parsedConfig;

    /**
     * @var string
     */
    protected $tabLabel;


    /**
     * TODO: get structured data from cache? (Is it already coming from the cache?)
     *
     * @param StructureData $structureData
     * @param array $data
     */
    public function __construct(StructureData $structureData, array $data = [])
    {
        parent::__construct($data);
        $this->config = $structureData->get();
    }


    /**
     * TODO: cache this?
     *
     * @return array
     */
    public function getParsedData()
    {
        if (!$this->parsedConfig) {
            $this->parsedConfig = [];

            if (isset($this->config['sections'])) {
                foreach ($this->config['sections'] as $sectionId => $section) {

                    // TODO: why don't some sections have labels?
                    if (!isset($section['label'])) {
                        continue;
                    }

                    $sectionLabel = $section['label'];
                    $tabId        = $section['tab'];

                    if (isset($section['children'])) {
                        foreach ($section['children'] as $groupId => $group) {
                            // TODO: why don't some groups have labels?
                            if (!isset($group['label'])) {
                                continue;
                            }
                            $groupLabel = $group['label'];
                            //$groupPath  = $this->prependPathWithTab($tab, $group['path']);

                            if (isset($group['children'])) {
                                foreach ($group['children'] as $fieldId => $field) {

                                    // TODO: why don't some fields have labels?
                                    // seems to be other elements in there; for example, Validate Vat button
                                    // is part of a field
                                    if (!isset($field['label'])) {
                                        continue;
                                    }

                                    $fieldComment         = isset($field['comment']) ? $field['comment'] : '';
                                    $this->parsedConfig[] = [
                                        'tab_id'        => $tabId,
                                        'tab_label'     => $this->lookupTabLabel($tabId),
                                        'section_id'    => $sectionId,
                                        'section_label' => $sectionLabel,
                                        'group_id'      => $groupId,
                                        'group_label'   => $groupLabel,
                                        'field_id'      => $fieldId,
                                        'field_label'   => $field['label'],
                                        'field_comment' => $fieldComment,
                                        'path'          => sprintf('%s/%s/%s', $sectionId, $groupId, $fieldId),
                                        'fieldset_id'   => sprintf('%s_%s', $sectionId, $groupId),
                                        'row_id'        => sprintf('%s_%s_%s', $sectionId, $groupId, $fieldId),
//                                        'path'    => $this->prependPathWithTab($tab, $field['path']),
//                                        'fieldset_id' => "{$section_tag}_{$group_tag}",
//                                        'row_id'      => "{$section_tag}_{$group_tag}_{$field_tag}",
//                                        'description' => "$section_label: $group_label: $field_label"
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this->parsedConfig;
    }


    /**
     * @param string $tabId
     * @return string|null
     */
    private function lookupTabLabel($tabId)
    {
        if (isset($this->config['tabs']) &&
            isset($this->config['tabs'][$tabId]) &&
            isset($this->config['tabs'][$tabId]['label'])) {
            return $this->config['tabs'][$tabId]['label'];
        }
    }


    /**
     * Get all the labels in the currently loaded config.
     *
     * @deprecated
     * @return array
     */
    public function getAllLabels()
    {
        if (!$this->labels) {
            $this->labels = [];

            if (isset($this->config['sections'])) {
                array_map([$this, 'walkSection'], $this->config['sections']);
                $this->labels = array_filter($this->labels, function ($value) {
                    return null !== $value;
                });
            }
        }

        return $this->labels;
    }


    /**
     * Walk the given section array to get children.
     *
     * @deprecated
     * @param array $section
     */
    private function walkSection($section)
    {
        if (isset($section['children'])) {
            array_map([$this, 'walkTab'], $section['children']);
        }
    }


    /**
     * Walk the given tab array to get children.
     *
     * @deprecated
     *
     * @param $tab
     * @return array
     */
    private function walkTab($tab)
    {
        if (isset($tab['label'])) {
            $this->tabLabel = $tab['label'];
        }
        if (isset($tab['children'])) {
            $this->labels = array_merge(
                $this->labels, array_map([$this, 'walkSectionChildren'], $tab['children'])
            );
        }
    }


    /**
     * Walk the given section children array.
     *
     * @deprecated
     *
     * @param $field
     * @return array
     */
    private function walkSectionChildren($field)
    {
        if (isset($field['label'], $field['path'])) {
            return [
                'label' => $field['label'],
                'path'  => $field['path'],
                'group' => $this->tabLabel
            ];
        }
    }
}
