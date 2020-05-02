<?php
namespace addons\YunStore\common\services;

use common\components\Service;

/**
 * Class Application
 * @package addons\YunStore\common\services
 * @property \addons\YunStore\common\services\store\StoreService $store 门店
 * @property \addons\YunStore\common\services\base\AttributeService $baseAttribute
 * @property \addons\YunStore\common\services\base\AttributeValueService $baseAttributeValue
 * @property \addons\YunStore\common\services\base\SpecService $baseSpec 系统规格
 * @property \addons\YunStore\common\services\base\SpecValueService $baseSpecValue
 * @property \addons\YunStore\common\services\product\ProductService $product 商品
 * @property \addons\YunStore\common\services\product\CateService $productCate 商品分类
 * @property \addons\YunStore\common\services\product\SpecService $productSpec 商品规格
 * @property \addons\YunStore\common\services\product\TagService $productTag 商品标签
 * @property \addons\YunStore\common\services\product\BrandService $productBrand 品牌管理
 * @property \addons\YunStore\common\services\product\SkuService $productSku
 * @property \addons\YunStore\common\services\product\SpecValueService $productSpecValue 商品规格属性值
 * @property \addons\YunStore\common\services\product\MemberDiscountService $productMemberDiscount
 * @property \addons\YunStore\common\services\product\CommissionRateService $productCommissionRate
 * @property \addons\YunStore\common\services\store\PickService $storePick
 */
class Application extends Service
{
    public $childService = [
        'store' => 'addons\YunStore\common\services\store\StoreService',
        'baseAttribute' => 'addons\YunStore\common\services\base\AttributeService',
        'baseAttributeValue' => 'addons\YunStore\common\services\base\AttributeValueService',
        'baseSpec' => 'addons\YunStore\common\services\base\SpecService',
        'baseSpecValue' => 'addons\YunStore\common\services\base\SpecValueService',
        'product' => 'addons\YunStore\common\services\product\ProductService',
        'productCate' => 'addons\YunStore\common\services\product\CateService',
        'productSpec' => 'addons\YunStore\common\services\product\SpecService',
        'productTag' => 'addons\YunStore\common\services\product\TagService',
        'productBrand' => 'addons\YunStore\common\services\product\BrandService',
        'productSku' => 'addons\YunStore\common\services\product\SkuService',
        'productSpecValue' => 'addons\YunStore\common\services\product\SpecValueService',
        'productMemberDiscount' => 'addons\YunStore\common\services\product\MemberDiscountService',
        'productCommissionRate' => 'addons\YunStore\common\services\product\CommissionRateService',
        'storePick' => 'addons\YunStore\common\services\store\PickService'
    ];
}