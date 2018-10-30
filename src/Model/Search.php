<?php

namespace Stroopwafel\StoreConfigSearch\Model;

use Magento\Backend\Model\Url as AdminUrl;

/**
 * Search the store config for keywords.
 *
 * @package Stroopwafel\StoreConfigSearch\Model
 */
class Search
{

    /**
     * @var ParseConfig
     */
    private $parseConfig;

    /**
     * @var AdminUrl
     */
    private $url;


    /**
     * Search constructor.
     *
     * @param ParseConfigFactory $parseConfigFactory
     * @param AdminUrl $url
     */
    public function __construct(
        ParseConfigFactory $parseConfigFactory,
        AdminUrl $url
    )
    {
        $this->parseConfig = $parseConfigFactory->create();
        $this->url         = $url;
    }


    public function byKeyword($keyword)
    {
        $fields  = $this->parseConfig->getParsedData();
        $results = [];

        foreach ($fields as $field) {
            $label = $field['field_label'];

            if ($this->_isMatch($keyword, $label) !== false) {
                $results[] = $this->buildUrl($field);
            }
        }

        // TODO: search array
        /*
         tab_id: "advanced",
         tab_label: "Advanced",
         section_id: "admin",
         section_label: "Admin",
         group_id: "url",
         group_label: "Admin Base URL",
         field_id: "use_custom",
         field_label: "Use Custom Admin URL",
         field_comment: "",
         path: "admin/url/use_custom",
         */

        return $results;
    }


    private function buildUrl($field)
    {
        // TODO: figure out how you can build a URL to a system config edit field in M2
        $urlString = sprintf('adminhtml/system_config/edit/section/%s?fieldset=%s&row=%s',
            $field['section_id'],
            $field['fieldset_id'],
            $field['row_id']);
        $url       = $this->url->getUrl($urlString);

        $linkText = isset($field['field_comment']) ?
            sprintf('%s: %s', $field['field_label'], $field['field_comment']) :
            $field['field_label'];
        $link = sprintf('<a href="%s">%s</a>', $url, $linkText);

        return $link;
    }


    private function _isMatch($needle, $haystack)
    {
        return preg_match("/\b{$needle}\b/i", $haystack) > 0;
    }


    /**
     * Search the config for the given keyword.
     *
     * @param String $keyword
     * @return array
     */
    public function byKeywordOld($keyword)
    {
        /*
         * labels = [
         *      paypal_payflow_required = [
         *          label = 'Required Paypal Settings',
         *          path = 'payment_all_paypal/paypal_payflowpro',
         *          tab = 'Payflow Pro'
         *      ]
         * ]
         */
        $labels     = $this->parseConfig->getAllLabels();
        $configData = $this->parseConfig->getParsedData();


//        function create_lower_than($number = 10) {
//        // The "use" here binds $number to the function at declare time.
//        // This means that whenever $number appears inside the anonymous
//        // function, it will have the value it had when the anonymous
//        // function was declared.
//            return function($test) use($number) { return $test < $number; };
//        }
//
//        // We created this with a ten by default.  Let's test.
//        $lt_10 = create_lower_than(15);
//
//        // The "use" here binds $keyword to the function at declare time.
//        // This means that whenever $keyword appears inside the anonymous
//        // function, it will have the value it had when the anonymous
//        // function was declared.
//
//        // input value to function is $field
//        function compare_labels($keyword) {
//            return function ($field) use ($keyword) {
//                return (bool)preg_match("/{$keyword}/i", $field['label']);
//            };
//        }


//        $sections = [];
//        foreach ($labels as $labelKey => $labelValue) {
//
//        }

        $sections = array_filter($labels, function ($field) use ($keyword) {
            return (bool)preg_match("/{$keyword}/i", $field['label']);
        });

        $tabs = array_filter($labels, function ($field) use ($keyword) {
            return (bool)preg_match("/{$keyword}/i", $field['group']);
        });

        $result = array_merge($sections, $tabs);

        return $result;
    }
}
