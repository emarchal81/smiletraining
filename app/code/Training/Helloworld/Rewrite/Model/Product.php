<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 11:23 AM
 */

namespace Training\Helloworld\Rewrite\Model;


/**
 * Class Product
 * @package Training\Helloworld\Rewrite\Model
 */
class Product extends \Magento\Catalog\Model\Product
{
    /**
     * @return string
     */
    public function getName(){
        return parent::getName().' Hello world!';
    }
}