#<centerAPI接口文档Demo1.0</center>
***
###总述

1.接口调用必传参数列表

|参数|必选|类型|说明|
|:-------------|:-----------|:-----------|:-----------|
|app_key	  | true|string| 客户端类型,代表客户端的唯一身份，iPhone客户端为"iPhone"；Android为"Android"；iPad为"iPad"
|v 			  | true|string| 版本号，如v=1.0
|sig          |true|string| 签名

2.接口正确返回消息体  

```
	{
  		meta: {
  			status: 0,
  			server_time: "2016-01-06 21:46:12",
  			account_id: 0,
  			cost: 0.023514,
  			errdata: null,
  			errmsg: ""
  		},
  		version: 1,
  		data: {
      		has_more: true,
      		num_items: "4",
      		items: [{...},{...},...]
  		}
	}
```
2.接口错误返回消息体

```
	{
  		meta: {
  			status: 10009,
  			server_time: "2016-01-06 21:46:12",
  			account_id: 0,
  			cost: 0.023514,
  			errdata: null,
  			errmsg: "缺少参数"
  		},
  		version: 1,
  		data: {
      		alert_msg: "缺少参数"
  		}
	}
```

3.系统错误代码

		//API级别10001~19999
	    '10001'=>'服务器正在维护，请稍候重试',
	    '10009'=>'缺少参数',
	    '10010'=>'参数值超出范围',
	    '10011'=>'参数值类型不符',
		'10012'=>'参数值不能为空',
	    '10020'=>'记录不存在',
	    '10030'=>'超出限制',
	    '10032'=>'不支持的操作',
	    '10034'=>'内部错误',
	    '10035'=>'未知的Controller',
	    '10036'=>'未知的API',
	    '10039'=>'此版本的客户端已经停止使用。请更新至新版本',
	    '10040'=>'模块错误',

	    //权限20001~29999
	    '20010'=>'需要登录',
		'20011'=>'无查看权限',
	    '20022'=>'邮箱未验证，禁止登录',
		'20023'=>'第三方平台登陆失败',
		'20024'=>'不支持的第三方平台',
	    '20026'=>'用户名或密码错误，请重新登录',
	    '26001'=>'不支持的认证方式',
	    '26003'=>'请传入有效的Access Token',

	    //认证30001~39999
	    '30001'=>'用户名长度不符（1-30个字符）',
	    '30011'=>'密码长度至少为6个字符',
	    '30021'=>'邮箱格式不符合规范',

	    //业务级别错误70000~89999
	    '70001'=>'商品库存不足',
	    '70002'=>'商品已下架',
	    '70003'=>'商品暂时不可用',
	    '70004'=>'代金劵不可用',
	    '70005'=>'代金券已失效',
	    '70006'=>'代金券不存在',
	    '70007'=>'减免期间不能使用代金券',
	    '70008'=>'促销活动已结束',
	    '70009'=>'促销活动已开始',
	    '70010'=>'收货地址不在配送范围',
	    '70011'=>'业务在该平台不可使用',
	    '70012'=>'用户红包不存在',
	    '70013'=>'红包不存在',
	    '70014'=>'红包已失效',
	    '70015'=>'红包已被使用',

	    //HTTP错误 90000~99999
	    '90405'=>'405 Method not allowed',
		'91001'=>'GET Method not allowed',


### 目录

**[1. 订单列表](#userOrder)**  




###接口列表
***

<a id="userOrder"></a>
**1. 用户订单列表**

###### 接口功能
获取用户订单数据列表
###### URL
[http://123.57.212.87:28090/user/order](http://123.57.212.87:28090/user/order)

###### 支持格式
JSON

###### HTTP请求方式
GET

###### 请求参数
|参数|必选|类型|说明|
|-------------|-----------|-----------|-----------|
|app_key	  | true|string| 客户端类型,代表客户端的唯一身份，iPhone客户端为"iPhone"；Android为"Android"；iPad为"iPad"
|v 			  | true|string| 版本号，如v=1.0
|sig          |true|string| 签名


###### 返回字段
|返回字段|字段类型|说明                              |
|:-----   |:------|:-----------------------------   |
|order_id   | int | 订单ID|
|discount   | float(.2)| 折扣费用 |
|order_sn   | string |订单编码 |
|pay_fee   | float |订单总价 |
|price   |  float|实际支付价格 |
|amount   |int  |商品数量 |
|status_name   | string|订单状态名称 : '未支付','已付款','已发货', '交易成功','订单已失效','暂时缺货','用户取消','交易关闭'  |
|status   | int | 订单状态：0－等待买家付款；1－买家已经付款；2－卖家已发货；3－交易成功；4－交易关闭；5－暂时缺货；6－用户取消';7-订单已失效（交易关闭15天后订单） |
|address   | string |完整收获地址 |
|consignee   | string | 收件人|
|mobile   | string |收件人手机 |
|tel   | string | 收件人电话|
|created_on   | datetime | 订单创建时间,时间格式[2015-10-10 10:10:10]|
|modified_on   | datetime |最后更新时间,时间格式[2015-10-10 10:10:10]|
|servicer   | Object | 客服数据 |
|shipper   |  string|快递名称 |
|tracking_number   | string | 快递单号|
|ship_by   | string | 发货方式|
|goods   | ArrayObject |订单商品列表 |
|description   | string | 订单描述|
|pack_fee   |  float | 包装费|
|related_orders   | ArrayObject | 相关商品，暂时预留 |
|is_virtual   | bool |是否虚拟商品： |
|note   | string |订单备注 |
|pay_type   |string| 支付方式：alipay-支付宝；wxpay-微信支付|
>
#######订单商品[servicer]返回字段说明  
|返回字段|字段类型|说明                              |
|:-----   |:------|:-----------------------------   |
|service_id| int | 客服ID|
|name|  sting|客服名称|
|image| string |客服用户头像|
#######订单商品[goods]返回字段说明  
|返回字段|字段类型|说明                              |
|:-----   |:------|:-----------------------------   |
|goods_id| int | 商品ID|
|sku_sn| string |商品SKU码|
|goods_name|  sting|商品名称|
|sku_info|sring  |商品SKU信息|
|wrapper_id|int  |礼物包装ID|
|is_gift| int |是否礼物：0-否；1-是否|
|amount| int|购买数量 |
|price| float |商品单价|
|pay_note|  string|购买备注|
|images|Object|商品图片|
>>
#######订单商品[goods[images]]返回字段说明  
|返回字段|字段类型|说明                              |
|:-----   |:------|:-----------------------------   |
|tmb|string|商品小图|
|mid|string|商品中图|
|big|string|商品大图|
|orig|string|商品原图|


###### 接口示例
URL:   
[http://127.0.0.1:28090/user/order?app_key=iphone&v=1.0&sig=123&uid=1&page=0&count=10](http://127.0.0.1:28090/user/order?app_key=iphone&v=1.0&sig=123&uid=1&page=0&count=10)

```
	{
  		meta: {
  			status: 0,
  			server_time: "2016-01-06 21:46:12",
  			account_id: 0,
  			cost: 0.023514,
  			errdata: null,
  			errmsg: ""
  		},
  		version: 1,
  		data: {
      		has_more: true,
      		num_items: "4",
      		items: [
              {
                  order_id: 177,
                  discount: "50.00",
                  order_sn: "201412190322064833",
                  pay_fee: "490.00",
                  price: "440.00",
                  amount: 1,
                  goods: [
                      {
                          goods_id: 243,
                          sku_sn: "0101000000000000000243000500040000000000000000000000000000000000",
                          goods_name: "新的商品测试",
                          sku_info: "绿色",
                          wrapper_id: 1,
                          is_gift: 1,
                          amount: 1,
                          price: "490.00",
                          pay_note: "",
                          images: {
                              tmb: "http://127.0.0.1:85/ware/goods/tmb/243.jpg",
                              mid: "http://127.0.0.1:85/ware/goods/tmb/243.jpg",
                              big: "http://127.0.0.1:85/ware/goods/big/243.jpg",
                              orig: "http://127.0.0.1:85/ware/goods/tmb/243.jpg"
                          }
                      }
                  ],
                  description: " 新的商品测试",
                  pack_fee: "10.00",
                  related_orders: [],
                  is_virtual: false,
                  note: "7LKRTVXX5IEU",
                  pay_type: "alipay"
              },
              ...
			]
  		}
	}
```
