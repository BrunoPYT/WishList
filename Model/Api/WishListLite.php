<?php

namespace WishList\Model\Api;

use OpenApi\Annotations as OA;
use OpenApi\Model\Api\BaseApiModel;

/**
 * Class WishList.
 *
 * @OA\Schema(
 *     description="WishList"
 * )
 */
class WishListLite extends BaseApiModel
{
    /**
     * @var  int
     * @OA\Property(
     *    type="integer",
     * )
     * @Constraint\NotBlank(groups={"read", "update"})
     */
    protected $id;

    /**
     * @var boolean
     * @OA\Property(
     *    type="boolean",
     * )
     * @Constraint\NotBlank(groups={"read", "update"})
     */
    protected $default;

    /**
     * @var boolean
     * @OA\Property(
     *    type="boolean",
     * )
     * @Constraint\NotBlank(groups={"read", "update"})
     */
    protected $isType;

    /**
     * @var integer
     * @OA\Property(
     *    type="number",
     *    format="integer",
     * )
     * @Constraint\NotBlank(groups={"create", "update"})
     */
    protected $customerId;

    /**
     * @var string
     * @OA\Property(
     *    type="string",
     * )
     */
    protected $sessionId;

    /**
     * @var string
     * @OA\Property(
     *    type="string",
     * )
     */
    protected $title;

    /**
     * @var string
     * @OA\Property(
     *    type="string",
     * )
     */
    protected $code;

    /**
     * @var string
     * @OA\Property(
     *    type="string",
     * )
     */
    protected $sharedUrl;

    /**
     * @var \WishList\Model\WishList $theliaModel
     */
    public function createFromTheliaModel($theliaModel, $locale = null): void
    {
        parent::createFromTheliaModel($theliaModel, $locale);

        $this->setSharedUrl($theliaModel->getUrl($locale));
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  int $id
     * @return WishListLite
     */
    public function setId($id): WishListLite
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param  boolean $default
     * @return WishListLite
     */
    public function setDefault($default): WishListLite
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsType()
    {
        return $this->isType;
    }

    /**
     * @param  boolean $isType
     * @return WishListLite
     */
    public function setIsType($isType): WishListLite
    {
        $this->isType = $isType;
        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param  int $customerId
     * @return WishListLite
     */
    public function setCustomerId($customerId): WishListLite
    {
        $this->customerId = $customerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param  string $title
     * @return WishListLite
     */
    public function setTitle($title): WishListLite
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param  string $title
     * @return WishListLite
     */
    public function setCode($code): WishListLite
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getSharedUrl()
    {
        return $this->sharedUrl;
    }

    /**
     * @param  string $sharedUrl
     * @return WishListLite
     */
    public function setSharedUrl($sharedUrl): WishListLite
    {
        $this->sharedUrl = $sharedUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param  string $sessionId
     * @return WishListLite
     */
    public function setSessionId($sessionId): WishListLite
    {
        $this->sessionId = $sessionId;
        return $this;
    }
}
