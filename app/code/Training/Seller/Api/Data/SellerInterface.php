<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 11/28/17
 * Time: 4:44 PM
 */
namespace Training\Seller\Api\Data;

/**
 * Interface SellerInterface
 * @api
 */
/**
 * Interface SellerInterface
 * @package Training\Seller\Api\Data
 */
interface SellerInterface
{
    /**
     * Name of the Mysql TABLE
     */
    const TABLE_NAME = 'training_seller';

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FIELD_SELLER_ID = 'seller_id';
    const FIELD_IDENTIFIER = 'identifier';
    const FIELD_NAME = 'name';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_UPDATED_AT = 'updated_at';
    const FIELD_DESCRIPTION = 'description';
    /**#@-*/

    /**
     * Get seller id.
     *
     * @return int|null
     */
    public function getSellerId();

    /**
     * Set seller id.
     *
     * @param int $sellerId
     * @return SellerInterface
     */
    public function setSellerId($sellerId);

    /**
     * Get seller identifier.
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Set seller identifier.
     *
     * @param string $identifier
     * @return SellerInterface
     */
    public function setIdentifier($identifier);

    /**
     * Retrieve seller name
     *
     * @return string
     */
    public function getName();


    /**
     * Set seller name
     *
     * @param string $name
     * @return SellerInterface
     */
    public function setName($name);

    /**
     * Get creation date
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set creation date
     *
     * @param string $createdAt
     * @return SellerInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * get update date
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * set update date
     *
     * @param string $updatedAt
     * @return SellerInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * get description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * get description
     *
     * @param string|null $description
     * @return SellerInterface
     */
    public function setDescription($description);
}
