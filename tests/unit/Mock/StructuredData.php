<?php

namespace Stroopwafel\StoreConfigSearch\Tests\Mock;

class StructuredData
{
    /**
     * returns an array with a snippet of store configuration data
     * @return array
     */
    public static function get()
    {
        return [
            'sections' => [
                'general' => [
                    'id' => 'general',
                    'translate' => 'label',
                    'type' => 'text',
                    'sortOrder' => '10',
                    'showInDefault' => '1',
                    'showInWebsite' => '1',
                    'showInStore' => '1',
                    'children' => [
                        'store_information' => [
                            'id' => 'store_information',
                            'translate' => 'label',
                            'type' => 'text',
                            'sortOrder' => '100',
                            'showInDefault' => '1',
                            'showInWebsite' => '1',
                            'showInStore' => '1',
                            'label' => 'Store Information',
                            'children' => [
                                'name' => [
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
                                ],

                                'city' => [
                                    'id' => 'city',
                                    'translate' => 'label',
                                    'type' => 'text',
                                    'sortOrder' => '45',
                                    'showInDefault' => '1',
                                    'showInWebsite' => '1',
                                    'showInStore' => '0',
                                    'label' => 'City',
                                    '_elementType' => 'field',
                                    'path' => 'general/store_information',
                                ],

                                'street_line1' => [
                                    'id' => 'street_line1',
                                    'translate' => 'label',
                                    'type' => 'text',
                                    'sortOrder' => '55',
                                    'showInDefault' => '1',
                                    'showInWebsite' => '1',
                                    'showInStore' => '0',
                                    'label' => 'Street Address',
                                    '_elementType' => 'field',
                                    'path' => 'general/store_information',
                                ],

                                'street_line2' => [
                                    'id' => 'street_line2',
                                    'translate' => 'label',
                                    'type' => 'text',
                                    'sortOrder' => '60',
                                    'showInDefault' => '1',
                                    'showInWebsite' => '1',
                                    'showInStore' => '0',
                                    'label' => 'Street Address Line 2',
                                    '_elementType' => 'field',
                                    'path' => 'general/store_information',
                                ],

                                'merchant_vat_number' => [
                                    'id' => 'merchant_vat_number',
                                    'translate' => 'label',
                                    'type' => 'text',
                                    'sortOrder' => '61',
                                    'showInDefault' => '1',
                                    'showInWebsite' => '1',
                                    'showInStore' => '0',
                                    'label' => 'VAT Number',
                                    'can_be_empty' => '1',
                                    '_elementType' => 'field',
                                    'path' => 'general/store_information',
                                ],

                                'validate_vat_number' => [
                                    'id' => 'validate_vat_number',
                                    'translate' => 'button_label',
                                    'sortOrder' => '62',
                                    'showInDefault' => '1',
                                    'showInWebsite' => '1',
                                    'showInStore' => '0',
                                    'button_label' => 'Validate VAT Number',
                                    'frontend_model' => 'Magento\Customer\Block\Adminhtml\System\Config\Validatevat',
                                    '_elementType' => 'field',
                                    'path' => 'general/store_information',
                                ],

                            ],

                            '_elementType' => 'group',
                            'path' => 'general',
                        ]
                    ]
                ]
            ]
        ];
    }
}

