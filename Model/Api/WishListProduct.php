<?php

namespace WishList\Model\Api;

use OpenApi\Annotations as OA;
use OpenApi\Model\Api\BaseApiModel;
use Thelia\Model\Base\FeatureProduct;
use Thelia\Model\ProductImage;
use Thelia\Model\ProductSaleElements;


/**
 * Class WishListProduct.
 *
 * @OA\Schema(
 *     description="WishListProduct"
 * )
 */
class WishListProduct extends BaseApiModel
{
    /**
     * @var int
     * @OA\Property(
     *    type="integer",
     * )
     * @Constraint\NotBlank(groups={"read", "update"})
     */
    protected $id;

    /**
     * @var array
     * @OA\Property(
     *    type="array",
     *     @OA\Items(
     *          ref="#/components/schemas/File"
     *     )
     * )
     */
    protected $images;

    /**
     * @var array
     * @OA\Property(
     *    type="array",
     *     @OA\Items(
     *          ref="#/components/schemas/Feature"
     *     )
     * )
     */
    protected $features = [];

    /**
     * @var string
     * @OA\Property(
     *     type="string",
     * )
     */
    protected $url;

    /**
     * @var integer
     * @OA\Property(
     *    type="number",
     *    format="integer",
     * )
     * @Constraint\NotBlank(groups={"create", "update"})
     */
    protected $wishListId;

    /**
     * @var int
     * @OA\Property(
     *    type="integer",
     * )
     */
    protected $quantity;

    /**
     * @var BaseApiModel
     * @OA\Property(
     *    type="object",
     *    ref="#/components/schemas/WishListPse"
     * )
     * @Constraint\NotBlank(groups={"create", "update"})
     */
    protected $productSaleElement;

    public function createFromTheliaModel($theliaModel, $locale = null)
    {
        $wishListProduct = parent::createFromTheliaModel($theliaModel, $locale);

        /** @var ProductSaleElements $pse */
        $pse = $theliaModel->getProductSaleElements();

        $wishListProduct->setProductSaleElement($this->modelFactory->buildModel('WishListPse', $pse));

        $images = array_map(
            function (ProductImage $productImages) {
                return $this->modelFactory->buildModel('Image', $productImages);
            },
            iterator_to_array($pse->getProduct()->getProductImages())
        );

        $wishListProduct->setImages($images);

        $wishListProduct->setUrl($pse->getProduct()->getUrl());

        $currentProduct = $pse->getProduct();
        $modelFactory = $this->modelFactory;

        $this->features = array_filter(
            array_map(
                function (FeatureProduct $featureProduct) use ($modelFactory) {
                    $propelFeature = $featureProduct->getFeature();
                    if (null === $propelFeature) {
                        return false;
                    }

                    if (null !== $featureProduct->getFeatureAv()) {
                        // Temporary set only product feature av to build good feature av list
                        $propelFeature->addFeatureAv($featureProduct->getFeatureAv());
                    }
                    $propelFeature->resetPartialFeatureAvs(false);

                    $feature = $modelFactory->buildModel('Feature', $propelFeature);

                    $propelFeature->clearFeatureAvs();

                    return $feature;
                },
                iterator_to_array(
                    $currentProduct->getFeatureProducts()
                )
            ),
            function ($value) {
                return $value;
            }
        );

        return $wishListProduct;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return WishList
     */
    public function setId($id): WishListProduct
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getWishListId()
    {
        return $this->wishListId;
    }

    /**
     * @param int $wishlistId
     * @return WishListProduct
     */
    public function setWishListId($wishListId): WishListProduct
    {
        $this->wishListId = $wishListId;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return WishListProduct
     */
    public function setQuantity($quantity): WishListProduct
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return BaseApiModel
     */
    public function getProductSaleElement()
    {
        return $this->productSaleElement;
    }

    /**
     * @param BaseApiModel $productSaleElement
     * @return WishListProduct
     */
    public function setProductSaleElement($productSaleElement): WishListProduct
    {
        $this->productSaleElement = $productSaleElement;
        return $this;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): WishListProduct
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): WishListProduct
    {
        $this->url = $url;

        return $this;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }
}
