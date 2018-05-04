<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/14
 * Time: 10:01
 */

namespace app\common\service;
use app\common\model\BuildingScreen;
use app\common\model\ShoppingTrolley;
use app\lib\exception\BuildingException;
use app\lib\exception\ParameterException;
use app\lib\exception\ShoppingCartException;
use app\lib\exception\UserException;

/**
 * Class ShoppingCartException
 * @package app\common\service
 * 购物车
 */
class ShoppingCartServer
{
    private $buildingID; //商品id
    private $userID; //用户ID
    private $buildingNum; //商品数量
    private $typeId; //商品规格id

    /*
     * 初始化构造方法，为对应的值赋值，
     * 传入对应的商品id和对应用户id
     */
    function __construct($userID )
    {
        if( empty($userID) )
        {
            throw new UserException();
        }
        $this->userID = $userID;    //赋值用户id
    }

    public function setShoppingCartAdd($buildingID, $buildingNum, $typeId)
    {
        if( empty($buildingID) )
        {
            throw new BuildingException();
        }
        if( empty($typeId) )
        {
            throw new ParameterException([
                'msg' => '请选择规格'
            ]);
        }
        $this->typeId = $typeId;
        $this->buildingID = $buildingID;  //赋值商品id
        $this->buildingNum = !empty($buildingNum) ? $buildingNum : 1; //商品数量默认为1  如果传过来的值有数量的话。以传过来的值为准
        /**
         * 添加购物车逻辑，
         * 首先 验证该商品是否还存在，如果存在继续操作，如果不存在，返回异常
         * 所有数据将以从数据库中查出的数据为准，防止用户修改
         * 如果同样的商品已经存在购物车的情况下
         * 同样的商品是指：同样的商品，同样的规格
         * ，在原有的基础上*2 改变总价、
         */
        $buildingData = BuildingService::getBuildingData($this->buildingID); //验证该商品是否还存在
        if (empty($buildingData))
        {
            //如果该商品不存在，抛出异常
            throw new BuildingException();
        }
        $screen = BuildingService::checkStock($this->typeId, $this->buildingNum); //查找该规格的商品 查看库存
        //如果该商品存在，验证我的购物车上否添加过该商品
        $shoppingData = $this->getUserShoppingCartList();
        //如果上次添加的价格， 和本次添加的价格相同，说明再第二次添加期间，没有价格的波动，即视为同一件商品， 可以在原来的基础上加上本次的数量 *价格， 修改总价
        if( !empty($shoppingData) && $screen['price'] == $shoppingData['g_money_sale'] )
        {
            //如果该商品同样规格的商品 已经添加过购物车的话， 就在原来的基础上*2 修改总价即可
            //还有一种可能， 如果上次添加的价格和们这次添加的价格不同的话， 以本次添加的价格为准 如果存在价格的波动。
            $totalNum = $shoppingData['g_num'] + $this->buildingNum;
            $shoppingData->g_num =  $totalNum; //修改上次购物车商品的总量
            $shoppingData->g_total =  $shoppingData['g_money_sale'] * $totalNum; // 修改商品的总价
            $result = $shoppingData->save();  //修改数据
        }else{
            //如果不存在， 就说明之前没有过添加过该商品， 组合购物车的数据
            $buildingShoppingCartData = $this->binationShoppingCartData($buildingData, $screen['price']);
            //这里切记， 不管有没有之前添加过该商品在购物车中，所有的价格都是以商品规格的价格为准的。
            $shoppingCreateResult = $this->createShoppingCart($buildingShoppingCartData);
            $result = $shoppingCreateResult;

        }
        return $result;
    }

    /**
     * @param $buildingData  商品信息
     * @param $price        商品单价
     * @return array
     */
    private function binationShoppingCartData($buildingData, $price)
    {
        $shoppingCartData = [
            'uid'=> $this->userID,
            'g_name' => $buildingData['g_name'],
            'g_img' => $buildingData['g_img'],
            'g_money_all' => $price,
            'g_money_sale' => $price,
            'g_num' => $this->buildingNum,
            'g_total' => $price * $this->buildingNum,
            'g_bs_id' => $this->typeId,
            'g_id' => $this->buildingID,
        ];
        return $shoppingCartData;
    }


    protected function createShoppingCart($buildingShoppingData){
        $result = ShoppingTrolley::create($buildingShoppingData);
        return $result;
    }

    //获取用户对应购物车是否有该商品
    private function getUserShoppingCartList()
    {
        $where['uid'] = $this->userID;
        $where['g_id'] = $this->buildingID;
        $where['g_bs_id'] = $this->typeId;
        return ShoppingTrolley::get($where);
    }

    //删除购物车内容
    public function deleteShoppingCart($ids=[])
    {
        if(empty($ids))
        {
            throw new ParameterException();
        }
        foreach ($ids as $k => $v )
        {
            $data = ShoppingTrolley::get([ 'id'=>$v, 'uid'=> $this->userID]);
            if( empty($data))
            {
                throw new ShoppingCartException();
            }
        }
        $result = ShoppingTrolley::destroy($ids);
        return $result;

    }


    //查询该用户的购物车内容
    public function findCart()
    {
        $data = db('shopping_trolley')->alias('st')->where([ 'uid'=> $this->userID])
            ->join('__BUILDING_SCREEN__ bc', 'bc.id=st.g_bs_id')
            ->join('__BUILDING_DETAILS__ bd', 'bd.id=bc.gid', 'left')
            ->field('bc.size, bc.stock, bc.color, bc.gid, bc.price, bd.g_name, bd.g_img, st.g_num, st.g_total, st.g_bs_id, st.id, bd.g_price_r')
            ->order('st.id desc')
            ->paginate();

        if ($data->isEmpty())
        {
            throw new BuildingException([
                'msg'=> '暂无数据'
            ]);
        }

        return $data;

    }



}