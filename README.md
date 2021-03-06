
## Individual Learning Program
 *   project-name: shop
 *   version: laravel 8.*
## Progress and date of study
 *   Creation-time:May 12, 2021

## Demand analysis

### 产品用例
    从产品用例的角度上来分析 Shop 的需求。我从以下三种元素入手：角色,信息,动作

* 1. 角色
    游客 —— 没有登录的用户；
    用户 —— 注册用户， 可以购买商品；
    运营 —— 可以上架、下架商品，处理订单；
    管理员 —— 权限最高的用户角色，可以管理运营。
* 2. 信息结构

    用户 —— 模型名称 User；
    收货地址 —— 模型名称 UserAddress，包含地址和收货人姓名、电话；
    商品 —— 模型名称 Product，比如 iPhone X 就是一个商品；
    商品 SKU —— 模型名称 ProductSKU，同一商品下有个别属性可能有不同的值，比如 iPhone X 256G 和 iPhone X 64G 就是同一个商品的不同 SKU，每个 SKU 都有各自独立的库存；
    订单 —— 模型名称 Order；
    订单项 —— 模型名称 OrderItem，一个订单会包含一个或多个订单项，每个订单项都会与一个商品 SKU 关联；
    优惠券 —— 模型名称 CouponCode，订单可以使用优惠券来扣减最终需要支付的金额；
    运营人员 —— 模型名称 Operator，管理员也属于运营人员。
* 3. 动作
    角色和信息之间的互动称之为『动作』，动作主要有以下几个：

    创建 Create
    查看 Read
    编辑 Update
    删除 Delete

### 用例
* 1. 游客
    游客可以查看商品列表；
    游客可以查看单个商品内容。
* 2. 用户
    用户可以查看自己的收货地址列表；
    用户可以新增收货地址；
    用户可以修改自己的收货地址；
    用户可以删除自己的收货地址；
    用户可以收藏商品；
    用户可以将商品加入购物车；
    用户可以将购物车中的商品打包下单；
    用户可以在下单时使用优惠券；
    用户可以通过微信、支付宝支付订单；
    用户可以查看自己的订单信息；
    用户可以对已支付的订单申请退款；
    用户可以将已发货的订单标记为确认收货；
    用户可以对已购买的商品发布评价。
* 3. 运营
    运营可以看到所有的用户列表；
    运营可以发布商品；
    运营可以编辑商品内容；
    运营可以编辑商品 SKU 及其库存；
    运营可以下架商品；
    运营可以将用户已支付的订单标记为已发货；
    运营可以对申请退款的订单执行退款；
    运营可以创建、编辑、删除优惠券。
* 4. 管理员
    管理员可以查看运营人员列表；
    管理员可以新增运营人员；
    管理员可以编辑运营人员；
    管理员可以删除运营人员。

## 注： 
    用户模块使用laravel 自带的用户人证脚手架 php artisan ui:auth
    后台使用laravel-admin