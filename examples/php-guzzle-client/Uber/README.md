# API

### Estimates

* [`GET /estimates/price`](#getestimatesprice) Price Estimates
* [`GET /estimates/time`](#getestimatestime) Time Estimates

### Products

* [`GET /products`](#getproducts) Product Types

### User

* [`GET /history`](#gethistory) User Activity
* [`GET /me`](#getme) User Profile



## Operations

### `GetProducts`

The Products endpoint returns information about the Uber products offered
at a given location. The response includes the display name and other
details about each product, and lists the products in the proper display
order.

_Endpoint_: `/products`

_Namespace_: `Swac\Example\Uber\Products\Operation`

#### Request
Type: `Swac\Example\Uber\Products\Request\GetProductsRequest`

|Name       |Type   |In     |Description                     |
|-----------|-------|-------|--------------------------------|
|`latitude` |`float`|`query`|Latitude component of location. |
|`longitude`|`float`|`query`|Longitude component of location.|





#### Response


|Status|Type                                                                            |Description         |
|------|--------------------------------------------------------------------------------|--------------------|
|200 OK|[`GetProductsOKResponse`](#swacexampleuberproductsresponsegetproductsokresponse)|An array of products|
|      |[`Error`](#swacexampleuberproductsdefinitionserror)                             |Unexpected error    |

### `GetEstimatesPrice`

The Price Estimates endpoint returns an estimated price range for each
product offered at a given location. The price estimate is provided as a
formatted string with the full price range and the localized currency
symbol.<br><br>The response also includes low and high estimates, and the
[ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code for
situations requiring currency conversion. When surge is active for a
particular product, its surge_multiplier will be greater than 1, but the
price estimate already factors in this multiplier.

_Endpoint_: `/estimates/price`

_Namespace_: `Swac\Example\Uber\Estimates\Operation`

#### Request
Type: `Swac\Example\Uber\Estimates\Request\GetEstimatesPriceRequest`

|Name            |Type   |In     |Description                           |
|----------------|-------|-------|--------------------------------------|
|`startLatitude` |`float`|`query`|Latitude component of start location. |
|`startLongitude`|`float`|`query`|Longitude component of start location.|
|`endLatitude`   |`float`|`query`|Latitude component of end location.   |
|`endLongitude`  |`float`|`query`|Longitude component of end location.  |





#### Response


|Status|Type                                                                                         |Description                           |
|------|---------------------------------------------------------------------------------------------|--------------------------------------|
|200 OK|[`GetEstimatesPriceOKResponse`](#swacexampleuberestimatesresponsegetestimatespriceokresponse)|An array of price estimates by product|
|      |[`Error`](#swacexampleuberproductsdefinitionserror)                                          |Unexpected error                      |

### `GetEstimatesTime`

The Time Estimates endpoint returns ETAs for all products offered at a
given location, with the responses expressed as integers in seconds. We
recommend that this endpoint be called every minute to provide the most
accurate, up-to-date ETAs.

_Endpoint_: `/estimates/time`

_Namespace_: `Swac\Example\Uber\Estimates\Operation`

#### Request
Type: `Swac\Example\Uber\Estimates\Request\GetEstimatesTimeRequest`

|Name            |Type    |In     |Description                                                                        |
|----------------|--------|-------|-----------------------------------------------------------------------------------|
|`startLatitude` |`float` |`query`|Latitude component of start location.                                              |
|`startLongitude`|`float` |`query`|Longitude component of start location.                                             |
|`customerUuid`  |`string`|`query`|Unique customer identifier to be used for experience customization.                |
|`productId`     |`string`|`query`|Unique identifier representing a specific product for a given latitude & longitude.|





#### Response


|Status|Type                                                                                       |Description         |
|------|-------------------------------------------------------------------------------------------|--------------------|
|200 OK|[`GetEstimatesTimeOKResponse`](#swacexampleuberestimatesresponsegetestimatestimeokresponse)|An array of products|
|      |[`Error`](#swacexampleuberproductsdefinitionserror)                                        |Unexpected error    |

### `GetMe`

The User Profile endpoint returns information about the Uber user that has
authorized with the application.

_Endpoint_: `/me`

_Namespace_: `Swac\Example\Uber\User\Operation`

#### Request
Type: `Swac\Example\Uber\User\Request\GetMeRequest`




#### Response


|Status|Type                                               |Description                   |
|------|---------------------------------------------------|------------------------------|
|200 OK|[`Profile`](#swacexampleuberuserdefinitionsprofile)|Profile information for a user|
|      |[`Error`](#swacexampleuberproductsdefinitionserror)|Unexpected error              |

### `GetHistory`

The User Activity endpoint returns data about a user's lifetime activity
with Uber. The response will include pickup locations and times, dropoff
locations and times, the distance of past requests, and information about
which products were requested.<br><br>The history array in the response
will have a maximum length based on the limit parameter. The response value
count may exceed limit, therefore subsequent API requests may be necessary.

_Endpoint_: `/history`

_Namespace_: `Swac\Example\Uber\User\Operation`

#### Request
Type: `Swac\Example\Uber\User\Request\GetHistoryRequest`

|Name    |Type |In     |Description                                                         |
|--------|-----|-------|--------------------------------------------------------------------|
|`offset`|`int`|`query`|Offset the list of returned results by this amount. Default is zero.|
|`limit` |`int`|`query`|Number of items to retrieve. Default is 5, maximum is 100.          |





#### Response


|Status|Type                                                     |Description                           |
|------|---------------------------------------------------------|--------------------------------------|
|200 OK|[`Activities`](#swacexampleuberuserdefinitionsactivities)|History information for the given user|
|      |[`Error`](#swacexampleuberproductsdefinitionserror)      |Unexpected error                      |



## Structures

#### Swac\Example\Uber\Estimates\Definitions\PriceEstimate
|Name             |Type    |Description                                                                                                                                                                       |
|-----------------|--------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
|`productId`      |`string`|Unique identifier representing a specific product for a given latitude & longitude. For example, uberX in San Francisco will have a different product_id than uberX in Los Angeles|
|`currencyCode`   |`string`|[ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code.                                                                                                                  |
|`displayName`    |`string`|Display name of product.                                                                                                                                                          |
|`estimate`       |`string`|Formatted string of estimate in local currency of the start location. Estimate could be a range, a single number (flat rate) or "Metered" for TAXI.                               |
|`lowEstimate`    |`float` |Lower bound of the estimated price.                                                                                                                                               |
|`highEstimate`   |`float` |Upper bound of the estimated price.                                                                                                                                               |
|`surgeMultiplier`|`float` |Expected surge multiplier. Surge is active if surge_multiplier is greater than 1. Price estimate already factors in the surge multiplier.                                         |

#### Swac\Example\Uber\Estimates\Response\GetEstimatesPriceOKResponse
[`PriceEstimate`](#swacexampleuberestimatesdefinitionspriceestimate)[]&#124;`array`
#### Swac\Example\Uber\Estimates\Response\GetEstimatesTimeOKResponse
[`Product`](#swacexampleuberproductsdefinitionsproduct)[]&#124;`array`
#### Swac\Example\Uber\Products\Definitions\Error
|Name     |Type    |
|---------|--------|
|`code`   |`int`   |
|`message`|`string`|
|`fields` |`string`|

#### Swac\Example\Uber\Products\Definitions\Product
|Name         |Type    |Description                                                                                                                                                                        |
|-------------|--------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
|`productId`  |`string`|Unique identifier representing a specific product for a given latitude & longitude. For example, uberX in San Francisco will have a different product_id than uberX in Los Angeles.|
|`description`|`string`|Description of product.                                                                                                                                                            |
|`displayName`|`string`|Display name of product.                                                                                                                                                           |
|`capacity`   |`string`|Capacity of product. For example, 4 people.                                                                                                                                        |
|`image`      |`string`|Image URL representing the product.                                                                                                                                                |

#### Swac\Example\Uber\Products\Response\GetProductsOKResponse
[`Product`](#swacexampleuberproductsdefinitionsproduct)[]&#124;`array`
#### Swac\Example\Uber\User\Definitions\Activities
|Name     |Type                                                                |Description                           |
|---------|--------------------------------------------------------------------|--------------------------------------|
|`offset` |`int`                                                               |Position in pagination.               |
|`limit`  |`int`                                                               |Number of items to retrieve (100 max).|
|`count`  |`int`                                                               |Total number of items available.      |
|`history`|[`Activity`](#swacexampleuberuserdefinitionsactivity)[]&#124;`array`|                                      |

#### Swac\Example\Uber\User\Definitions\Activity
|Name  |Type    |Description                       |
|------|--------|----------------------------------|
|`uuid`|`string`|Unique identifier for the activity|

#### Swac\Example\Uber\User\Definitions\Profile
|Name       |Type    |Description                   |
|-----------|--------|------------------------------|
|`firstName`|`string`|First name of the Uber user.  |
|`lastName` |`string`|Last name of the Uber user.   |
|`email`    |`string`|Email address of the Uber user|
|`picture`  |`string`|Image URL of the Uber user.   |
|`promoCode`|`string`|Promo code of the Uber user.  |


