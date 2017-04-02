<?php
/**
 * Created by PhpStorm.
 * User: lfolco
 * Date: 9/27/16
 * Time: 3:13 PM
 */

namespace Stroopwafel\Sysconfsearch\Block;


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
