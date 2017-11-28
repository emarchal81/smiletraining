<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 10:45 AM
 */

namespace Training\Helloworld\Plugin\Model\Data;

use Magento\Customer\Model\Data\Customer as ModelCustomer;

/**
 * Class Customer
 * @package Training\Helloworld\Plugin\Model\Data
 */
class Customer
{
    /**
     * @param ModelCustomer $subject
     * @param $value
     * @return array
     * @SuppressWarnings(PHPMD UnusedFormalParameter)
     */
    public function beforeSetFirstname(ModelCustomer $subject, $value){
         $value = mb_convert_case($value,MB_CASE_TITLE);
        return [$value];
     }
}