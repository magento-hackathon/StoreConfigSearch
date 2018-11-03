<?php
declare(strict_types=1);

/**
 * @author Laura Folco <me@laurafolco.com>
 * @copyright Copyright (c) 2017 FireGento e.V.
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace Stroopwafel\StoreConfigSearch\Block;


use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Results extends Template
{

    private $registry;


    public function __construct(Template\Context $context, Registry $registry, array $data)
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }


    public function getSearchResultsData()
    {
        return $this->registry->registry('result_data');
    }

}
