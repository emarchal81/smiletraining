<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/29/17
 * Time: 9:57 AM
 */
namespace Training\Seller\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Interface SellerRepositoryInterface
 * @api
 */
interface SellerRepositoryInterface
{
    /**
     * Get seller by id
     *
     * @param int $sellerId
     * @return \Training\Seller\Api\Data\SellerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($sellerId);

    /**
     * Get seller by identifier
     *
     * @param string $identifier
     * @return \Training\Seller\Api\Data\SellerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByIdentifier($identifier);

    /**
     * Get seller list from criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Seller\Api\Data\SellerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * save a seller
     *
     * @param \Training\Seller\Api\Data\SellerInterface $seller
     * @return \Training\Seller\Api\Data\SellerInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(SellerInterface $seller);

    /**
     * Delete Seller by id
     *
     * @param int $sellerId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($sellerId);

    /**
     * Delete Seller by identifier
     *
     * @param string $identifier
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteByIdentifier($identifier);
}
