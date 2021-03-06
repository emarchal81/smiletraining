<?php
/**
 * Magento 2 Training Project
 * Module Training/Seller
 */
namespace Training\Seller\Controller\Seller;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page as ResultPage;
use Magento\Framework\Exception\NotFoundException;

/**
 * Action : seller/view
 *
 * @author    Laurent MINGUET <lamin@smile.fr>
 * @copyright 2017 Smile
 */
class View extends AbstractAction
{
    /**
     * Execute the action
     *
     * @return ResultPage
     * @throws NotFoundException
     */
    public function execute()
    {
        // get the asked identifier
        $identifier = trim($this->getRequest()->getParam('identifier'));
        if (!$identifier) {
            throw new NotFoundException(__('The identifier is missing'));
        }

        // get the asked seller
        try {
            $seller = $this->sellerRepository->getByIdentifier($identifier);
        } catch (NoSuchEntityException $e) {
            throw new NotFoundException(__('The identifier does not exist'));
        }

        $this->registry->register('current_seller', $seller);

        /** @var ResultPage $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->getConfig()->getTitle()->set(__('Seller "%1"', $seller->getName()));

        return $result;
    }
}
