<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/30/17
 * Time: 9:53 AM
 */

namespace Training\Seller\Controller\Seller;


use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class View extends AbstractAction
{
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $sellerIdentifier = trim($this->getRequest()->getParam("identifier"));
        if (!$sellerIdentifier){
            throw new NotFoundException(__('The identifier is missing'));
        }
        try {
            $seller = $this->sellerRepository->getByIdentifier($sellerIdentifier);
        } catch (NoSuchEntityException $e) {
                throw new NotFoundException(__('The seller does not exist'));
        }

        $this->registry->register('current_seller',$seller);
        /** @var \Magento\Framework\View\Result\Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->getConfig()->getTitle()->set(__('Seller "%1"',$seller->getName()));

        return $result;
    }
}