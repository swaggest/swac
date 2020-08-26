# API

### Foo

* [`DELETE /foos`](#deletefoos) Delete Foo
* [`GET /foos`](#getfoos) Find Foo
* [`POST /foos`](#postfoos) Create Foo
* [`PUT /foos`](#putfoos) Update Foo

### Lie

* [`GET /lies/{id}`](#getliesid) Get Lie By ID
* [`GET /lies`](#getlies) Get Lies
* [`POST /internal/find-available-carrots/{mille}/{look}`](#postinternalfindavailablecarrotsmillelook) Find Available Carrots

### LieAreas

* [`GET /lie-areas`](#getlieareas) List Lie areas name
* [`POST /lie-areas`](#postlieareas) Create Lie Areas
* [`PUT /lie-areas/{mille}/{lieArea}/sync`](#putlieareasmillelieareasync) Sync Lie Area

### Place

* [`DELETE /places`](#deleteplaces) Delete Place
* [`GET /places`](#getplaces) Find Place
* [`POST /places`](#postplaces) Create Place



## Operations

### `DeletePlaces`

Delete existing place.

_Endpoint_: `/places`

_Namespace_: `Swac\Example\FooBarOAS3\Place\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Place\Request\DeletePlacesRequest`

|Name|Type |In     |Description|
|----|-----|-------|-----------|
|`id`|`int`|`query`|           |





#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|204 No Content           |                                                                          |No Content           |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `GetPlaces`

Find existing place.

_Endpoint_: `/places`

_Namespace_: `Swac\Example\FooBarOAS3\Place\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Place\Request\GetPlacesRequest`

|Name          |Type    |In     |Description|
|--------------|--------|-------|-----------|
|`mille`       |`string`|`query`|           |
|`foxUuid`     |`string`|`query`|           |
|`foxId`       |`int`   |`query`|           |
|`look`        |`string`|`query`|           |
|`potatoFamily`|`string`|`query`|           |





#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|200 OK                   |[`PlaceEntity`](#swacexamplefoobaroas3placedefinitionsplaceentity)        |OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `PostPlaces`

Create place with target potato and time.

_Endpoint_: `/places`

_Namespace_: `Swac\Example\FooBarOAS3\Place\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Place\Request\PostPlacesRequest`

|Name  |Type                                                                                      |In    |Description|
|------|------------------------------------------------------------------------------------------|------|-----------|
|`body`|[`UsecaseCreatePlaceInput`](#swacexamplefoobaroas3placedefinitionsusecasecreateplaceinput)|`body`|           |


#### Swac\Example\FooBarOAS3\Place\Definitions\UsecaseCreatePlaceInput
|Name     |Type    |Description             |
|---------|--------|------------------------|
|`foxId`  |`int`   |                        |
|`foxUuid`|`string`|In: query, Name: foxUuid|
|`fooId`  |`int`   |                        |
|`barName`|`string`|                        |



#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|200 OK                   |[`PlaceEntity`](#swacexamplefoobaroas3placedefinitionsplaceentity)        |OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|409 Conflict             |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Conflict             |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `DeleteFoos`

Delete existing foo.

_Endpoint_: `/foos`

_Namespace_: `Swac\Example\FooBarOAS3\Foo\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Foo\Request\DeleteFoosRequest`

|Name|Type |In     |Description|
|----|-----|-------|-----------|
|`id`|`int`|`query`|           |





#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|204 No Content           |                                                                          |No Content           |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `GetFoos`

Find existing foo.

_Endpoint_: `/foos`

_Namespace_: `Swac\Example\FooBarOAS3\Foo\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Foo\Request\GetFoosRequest`

|Name          |Type    |In     |Description|
|--------------|--------|-------|-----------|
|`look`        |`string`|`query`|           |
|`potatoFamily`|`string`|`query`|           |
|`mille`       |`string`|`query`|           |





#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|200 OK                   |[`GetFoosOKResponse`](#swacexamplefoobaroas3fooresponsegetfoosokresponse) |OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `PostFoos`

Create foo with target potato and time.

_Endpoint_: `/foos`

_Namespace_: `Swac\Example\FooBarOAS3\Foo\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Foo\Request\PostFoosRequest`

|Name  |Type                                                      |In    |Description|
|------|----------------------------------------------------------|------|-----------|
|`body`|[`FooValue`](#swacexamplefoobaroas3foodefinitionsfoovalue)|`body`|           |


#### Swac\Example\FooBarOAS3\Foo\Definitions\FooValue
|Name             |Type                                                                                                                                                                  |Description                                                  |
|-----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------|
|`activateSince`  |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`activateTill`   |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`mille`          |`string`                                                                                                                                                              |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`localActivation`|[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]&#124;[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]|                                                             |
|`uselyKey`       |`string`                                                                                                                                                              |                                                             |
|`potatoFamily`   |`string`                                                                                                                                                              |                                                             |
|`barRules`       |[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;`null`                    |                                                             |
|`lookEnd`        |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |
|`lookStart`      |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |



#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|200 OK                   |[`FooEntity`](#swacexamplefoobaroas3foodefinitionsfooentity)              |OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|409 Conflict             |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Conflict             |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `PutFoos`

Update existing foo.

_Endpoint_: `/foos`

_Namespace_: `Swac\Example\FooBarOAS3\Foo\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Foo\Request\PutFoosRequest`

|Name  |Type                                                                                |In     |Description|
|------|------------------------------------------------------------------------------------|-------|-----------|
|`id`  |`int`                                                                               |`query`|           |
|`body`|[`UsecaseUpdateFooInput`](#swacexamplefoobaroas3foodefinitionsusecaseupdatefooinput)|`body` |           |


#### Swac\Example\FooBarOAS3\Foo\Definitions\UsecaseUpdateFooInput
|Name             |Type                                                                                                                                                                  |Description                                                  |
|-----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------|
|`activateSince`  |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`activateTill`   |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`mille`          |`string`                                                                                                                                                              |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`localActivation`|[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]&#124;[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]|                                                             |
|`uselyKey`       |`string`                                                                                                                                                              |                                                             |
|`potatoFamily`   |`string`                                                                                                                                                              |                                                             |
|`barRules`       |[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;`null`                    |                                                             |
|`lookEnd`        |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |
|`lookStart`      |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |



#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|204 No Content           |                                                                          |No Content           |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|409 Conflict             |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Conflict             |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `PostInternalFindAvailableCarrotsMilleLook`

Find carrots available to holes.

_Endpoint_: `/internal/find-available-carrots/{mille}/{look}`

_Namespace_: `Swac\Example\FooBarOAS3\Lie\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Lie\Request\PostInternalFindAvailableCarrotsMilleLookRequest`

|Name   |Type                                                                                                      |In     |Description|
|-------|----------------------------------------------------------------------------------------------------------|-------|-----------|
|`mille`|`string`                                                                                                  |`query`|           |
|`look` |`string`                                                                                                  |`query`|           |
|`body` |[`UsecaseFindAvailableCarrotsInput`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsinput)|`body` |           |


#### Swac\Example\FooBarOAS3\Lie\Definitions\UsecaseFindAvailableCarrotsInput
|Name   |Type                                                                                                                                                                                                                                          |
|-------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
|`items`|[`UsecaseFindAvailableCarrotsInputItem`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsinputitem)[]&#124;[`UsecaseFindAvailableCarrotsInputItem`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsinputitem)[]|



#### Response


|Status                   |Type                                                                                                        |Description          |
|-------------------------|------------------------------------------------------------------------------------------------------------|---------------------|
|200 OK                   |[`UsecaseFindAvailableCarrotsOutput`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsoutput)|OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)                                  |Bad Request          |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)                                  |Internal Server Error|

### `GetLieAreas`

List lie areas name by mille name

_Endpoint_: `/lie-areas`

_Namespace_: `Swac\Example\FooBarOAS3\LieAreas\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\LieAreas\Request\GetLieAreasRequest`

|Name   |Type    |In     |Description|
|-------|--------|-------|-----------|
|`mille`|`string`|`query`|           |





#### Response


|Status                   |Type                                                                                  |Description          |
|-------------------------|--------------------------------------------------------------------------------------|---------------------|
|200 OK                   |[`GetLieAreasOKResponse`](#swacexamplefoobaroas3lieareasresponsegetlieareasokresponse)|OK                   |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)            |Internal Server Error|

### `PostLieAreas`

Create lie areas with postcodes.

_Endpoint_: `/lie-areas`

_Namespace_: `Swac\Example\FooBarOAS3\LieAreas\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\LieAreas\Request\PostLieAreasRequest`

|Name  |Type                                                                   |In    |Description|
|------|-----------------------------------------------------------------------|------|-----------|
|`body`|[`LieareaValue`](#swacexamplefoobaroas3lieareasdefinitionslieareavalue)|`body`|           |


#### Swac\Example\FooBarOAS3\LieAreas\Definitions\LieareaValue
|Name   |Type                               |Description                                                  |
|-------|-----------------------------------|-------------------------------------------------------------|
|`mille`|`string`                           |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`name` |`string`                           |                                                             |
|`areas`|`string`[]&#124;`null`&#124;`array`|                                                             |



#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|200 OK                   |[`LieareaEntity`](#swacexamplefoobaroas3lieareasdefinitionslieareaentity) |OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|409 Conflict             |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Conflict             |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `PutLieAreasMilleLieAreaSync`

Synchronize list of lie area postcodes with delivery-area-service.

_Endpoint_: `/lie-areas/{mille}/{lieArea}/sync`

_Namespace_: `Swac\Example\FooBarOAS3\LieAreas\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\LieAreas\Request\PutLieAreasMilleLieAreaSyncRequest`

|Name     |Type    |In     |Description      |
|---------|--------|-------|-----------------|
|`look`   |`string`|`query`|                 |
|`mille`  |`string`|`query`|                 |
|`lieArea`|`string`|`path` |Name of lie area.|





#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|204 No Content           |                                                                          |No Content           |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `GetLies`

Gets lies by criteria.

_Endpoint_: `/lies`

_Namespace_: `Swac\Example\FooBarOAS3\Lie\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Lie\Request\GetLiesRequest`

|Name               |Type                   |In     |Description|
|-------------------|-----------------------|-------|-----------|
|`mille`            |`string`               |`query`|           |
|`exclude`          |`string`               |`query`|           |
|`locale`           |`string`               |`query`|           |
|`potato`           |`string`               |`query`|           |
|`hole`             |`int`                  |`query`|           |
|`potatoSku`        |`string`               |`query`|           |
|`soup`             |`string`               |`query`|           |
|`look`             |`string`               |`query`|           |
|`looks`            |`string`[]&#124;`array`|`query`|           |
|`isActive`         |`bool`                 |`query`|           |
|`potatoSku2`       |`string`               |`query`|           |
|`withCompleteSoups`|`bool`                 |`query`|           |
|`sort`             |`string`               |`query`|           |
|`take`             |`int`                  |`query`|           |
|`skip`             |`int`                  |`query`|           |





#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|200 OK                   |[`LiesPage`](#swacexamplefoobaroas3liedefinitionsliespage)                |OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|

### `GetLiesId`

Gets lie by id.

_Endpoint_: `/lies/{id}`

_Namespace_: `Swac\Example\FooBarOAS3\Lie\Operation`

#### Request
Type: `Swac\Example\FooBarOAS3\Lie\Request\GetLiesIdRequest`

|Name    |Type    |In     |Description|
|--------|--------|-------|-----------|
|`locale`|`string`|`query`|           |
|`hole`  |`int`   |`query`|           |
|`id`    |`string`|`path` |           |





#### Response


|Status                   |Type                                                                      |Description          |
|-------------------------|--------------------------------------------------------------------------|---------------------|
|200 OK                   |[`LiesLie`](#swacexamplefoobaroas3liedefinitionslieslie)                  |OK                   |
|400 Bad Request          |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Bad Request          |
|404 Not Found            |[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Not Found            |
|500 Internal Server Error|[`RestErrResponse`](#swacexamplefoobaroas3placedefinitionsresterrresponse)|Internal Server Error|



## Structures

#### Swac\Example\FooBarOAS3\Foo\Definitions\FooBarRule
|Name                  |Type                                                                                             |
|----------------------|-------------------------------------------------------------------------------------------------|
|`customLiePreferences`|[`LiesPreference`](#swacexamplefoobaroas3foodefinitionsliespreference)[]&#124;`array`            |
|`customModularity`    |[`LiesModularity`](#swacexamplefoobaroas3foodefinitionsliesmodularity)[]&#124;`null`&#124;`array`|
|`customSoups`         |`string`[]&#124;`string`[]                                                                       |
|`hideCarrots`         |`int`[]&#124;`array`                                                                             |
|`areaTagsByCarrots`   |`string`[]&#124;`array`[]&#124;`string`[]&#124;`array`[]                                         |

#### Swac\Example\FooBarOAS3\Foo\Definitions\FooEntity
|Name             |Type                                                                                                                                                                  |Description                                                  |
|-----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------|
|`activateSince`  |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`activateTill`   |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`mille`          |`string`                                                                                                                                                              |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`createdAt`      |`string`                                                                                                                                                              |                                                             |
|`deletedAt`      |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`fooId`          |`int`                                                                                                                                                                 |                                                             |
|`localActivation`|[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]&#124;[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]|                                                             |
|`uselyKey`       |`string`                                                                                                                                                              |                                                             |
|`overlap`        |[`FooEntity`](#swacexamplefoobaroas3foodefinitionsfooentity)[]&#124;`array`                                                                                           |                                                             |
|`potatoFamily`   |`string`                                                                                                                                                              |                                                             |
|`updatedAt`      |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`barRules`       |[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;`null`                    |                                                             |
|`lookEnd`        |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |
|`lookStart`      |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |

#### Swac\Example\FooBarOAS3\Foo\Definitions\FooLocalActivation
|Name              |Type             |
|------------------|-----------------|
|`maxRoxesReceived`|`null`&#124;`int`|
|`minRoxesReceived`|`null`&#124;`int`|

#### Swac\Example\FooBarOAS3\Foo\Definitions\FooValue
|Name             |Type                                                                                                                                                                  |Description                                                  |
|-----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------|
|`activateSince`  |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`activateTill`   |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`mille`          |`string`                                                                                                                                                              |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`localActivation`|[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]&#124;[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]|                                                             |
|`uselyKey`       |`string`                                                                                                                                                              |                                                             |
|`potatoFamily`   |`string`                                                                                                                                                              |                                                             |
|`barRules`       |[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;`null`                    |                                                             |
|`lookEnd`        |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |
|`lookStart`      |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |

#### Swac\Example\FooBarOAS3\Foo\Definitions\LiesModularity
|Name                  |Type                                                                                                         |
|----------------------|-------------------------------------------------------------------------------------------------------------|
|`addOns`              |[`LiesModularityAddOns`](#swacexamplefoobaroas3foodefinitionsliesmodularityaddons)[]&#124;`null`&#124;`array`|
|`addOnsHeadline`      |`null`&#124;`string`                                                                                         |
|`defaultCarrotIndex`  |`int`                                                                                                        |
|`noAddOnsDefaultTitle`|`null`&#124;`string`                                                                                         |
|`noBarsDefaultTitle`  |`null`&#124;`string`                                                                                         |
|`promoTitle`          |`null`&#124;`string`                                                                                         |
|`bars`                |[`LiesModularityBar`](#swacexamplefoobaroas3foodefinitionsliesmodularitybar)[]&#124;`null`&#124;`array`      |
|`barsHeadline`        |`null`&#124;`string`                                                                                         |

#### Swac\Example\FooBarOAS3\Foo\Definitions\LiesModularityAddOns
|Name   |Type    |
|-------|--------|
|`index`|`int`   |
|`title`|`string`|

#### Swac\Example\FooBarOAS3\Foo\Definitions\LiesModularityBar
|Name   |Type                |
|-------|--------------------|
|`index`|`int`               |
|`title`|`null`&#124;`string`|

#### Swac\Example\FooBarOAS3\Foo\Definitions\LiesPreference
|Name         |Type                            |
|-------------|--------------------------------|
|`other`      |`int`[]&#124;`null`&#124;`array`|
|`preset`     |`string`                        |
|`recommended`|`int`[]&#124;`null`&#124;`array`|

#### Swac\Example\FooBarOAS3\Foo\Definitions\UsecaseFooInfo
|Name                    |Type                                                                                                                                                                  |Description                                                  |
|------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------|
|`activateSince`         |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`activateTill`          |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`availableForActivation`|`bool`                                                                                                                                                                |                                                             |
|`mille`                 |`string`                                                                                                                                                              |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`createdAt`             |`string`                                                                                                                                                              |                                                             |
|`deletedAt`             |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`fooId`                 |`int`                                                                                                                                                                 |                                                             |
|`localActivation`       |[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]&#124;[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]|                                                             |
|`uselyKey`              |`string`                                                                                                                                                              |                                                             |
|`overlap`               |[`FooEntity`](#swacexamplefoobaroas3foodefinitionsfooentity)[]&#124;`array`                                                                                           |                                                             |
|`potatoFamily`          |`string`                                                                                                                                                              |                                                             |
|`updatedAt`             |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`barRules`              |[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;`null`                    |                                                             |
|`lookEnd`               |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |
|`lookStart`             |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |

#### Swac\Example\FooBarOAS3\Foo\Definitions\UsecaseUpdateFooInput
|Name             |Type                                                                                                                                                                  |Description                                                  |
|-----------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------|
|`activateSince`  |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`activateTill`   |`null`&#124;`string`                                                                                                                                                  |                                                             |
|`mille`          |`string`                                                                                                                                                              |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`localActivation`|[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]&#124;[`FooLocalActivation`](#swacexamplefoobaroas3foodefinitionsfoolocalactivation)[]|                                                             |
|`uselyKey`       |`string`                                                                                                                                                              |                                                             |
|`potatoFamily`   |`string`                                                                                                                                                              |                                                             |
|`barRules`       |[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;[`FooBarRule`](#swacexamplefoobaroas3foodefinitionsfoobarrule)[]&#124;`null`                    |                                                             |
|`lookEnd`        |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |
|`lookStart`      |`string`                                                                                                                                                              |Acme Look<br>In: query, Name: look<br>In: path, Name: look   |

#### Swac\Example\FooBarOAS3\Foo\Response\GetFoosOKResponse
[`UsecaseFooInfo`](#swacexamplefoobaroas3foodefinitionsusecasefooinfo)[]&#124;`array`
#### Swac\Example\FooBarOAS3\LieAreas\Definitions\LieareaEntity
|Name       |Type                               |Description                                                  |
|-----------|-----------------------------------|-------------------------------------------------------------|
|`mille`    |`string`                           |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`createdAt`|`string`                           |                                                             |
|`id`       |`int`                              |                                                             |
|`name`     |`string`                           |                                                             |
|`areas`    |`string`[]&#124;`null`&#124;`array`|                                                             |
|`updatedAt`|`null`&#124;`string`               |                                                             |

#### Swac\Example\FooBarOAS3\LieAreas\Definitions\LieareaValue
|Name   |Type                               |Description                                                  |
|-------|-----------------------------------|-------------------------------------------------------------|
|`mille`|`string`                           |Acme Mille<br>In: query, Name: mille<br>In: path, Name: mille|
|`name` |`string`                           |                                                             |
|`areas`|`string`[]&#124;`null`&#124;`array`|                                                             |

#### Swac\Example\FooBarOAS3\LieAreas\Response\GetLieAreasOKResponse
`string`[]&#124;`array`
#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesCarrot
|Name            |Type                                                                                  |
|----------------|--------------------------------------------------------------------------------------|
|`drainSetting`  |[`LiesDrainSetting`](#swacexamplefoobaroas3liedefinitionsliesdrainsetting)&#124;`null`|
|`index`         |`int`                                                                                 |
|`isSoldOut`     |`bool`                                                                                |
|`presets`       |`string`[]&#124;`null`&#124;`array`                                                   |
|`soup`          |[`LiesSoup`](#swacexamplefoobaroas3liedefinitionsliessoup)                            |
|`areaTags`      |`string`[]&#124;`array`                                                               |
|`selectionLimit`|`null`&#124;`int`                                                                     |

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesDrainSetting
|Name             |Type                                                                                                   |
|-----------------|-------------------------------------------------------------------------------------------------------|
|`amount`         |`null`&#124;`int`                                                                                      |
|`rigidAmounts`   |[`LiesRigidAmount`](#swacexamplefoobaroas3liedefinitionsliesrigidamount)[]&#124;`null`&#124;`array`    |
|`rigidQuantities`|[`LiesRigidQuantity`](#swacexamplefoobaroas3liedefinitionsliesrigidquantity)[]&#124;`null`&#124;`array`|
|`reason`         |`string`                                                                                               |
|`servings`       |`null`&#124;`int`                                                                                      |
|`strategy`       |`string`                                                                                               |

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesLie
|Name                      |Type                                                                                             |
|--------------------------|-------------------------------------------------------------------------------------------------|
|`averageRating`           |`float`                                                                                          |
|`clonedFrom`              |`null`&#124;`string`                                                                             |
|`mille`                   |`string`                                                                                         |
|`carrots`                 |[`LiesCarrot`](#swacexamplefoobaroas3liedefinitionsliescarrot)[]&#124;`null`&#124;`array`        |
|`createdAt`               |`string`                                                                                         |
|`headline`                |`string`                                                                                         |
|`id`                      |`string`                                                                                         |
|`isActive`                |`null`&#124;`bool`                                                                               |
|`isComplete`              |`null`&#124;`bool`                                                                               |
|`link`                    |`string`                                                                                         |
|`meatSwanCombinations`    |`string`[]&#124;`array`[]&#124;`null`&#124;`array`                                               |
|`meatSwanCombinationsText`|`null`&#124;`string`                                                                             |
|`modularity`              |[`LiesModularity`](#swacexamplefoobaroas3foodefinitionsliesmodularity)[]&#124;`null`&#124;`array`|
|`preferences`             |[`LiesPreference`](#swacexamplefoobaroas3foodefinitionsliespreference)[]&#124;`null`&#124;`array`|
|`potato`                  |`string`                                                                                         |
|`rated`                   |`int`                                                                                            |
|`serializedPreferences`   |`null`&#124;`string`                                                                             |
|`surveyBody`              |`null`&#124;`string`                                                                             |
|`surveyOptIn`             |`null`&#124;`string`                                                                             |
|`surveyQuestion`          |`null`&#124;`string`                                                                             |
|`surveyTitle`             |`null`&#124;`string`                                                                             |
|`updatedAt`               |`string`                                                                                         |
|`look`                    |`string`                                                                                         |

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesPage
|Name   |Type                                                                               |
|-------|-----------------------------------------------------------------------------------|
|`count`|`int`                                                                              |
|`items`|[`LiesLie`](#swacexamplefoobaroas3liedefinitionslieslie)[]&#124;`null`&#124;`array`|
|`skip` |`int`                                                                              |
|`take` |`int`                                                                              |
|`total`|`int`                                                                              |

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesRigidAmount
|Name    |Type |
|--------|-----|
|`amount`|`int`|
|`people`|`int`|

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesRigidQuantity
|Name      |Type |
|----------|-----|
|`amount`  |`int`|
|`people`  |`int`|
|`quantity`|`int`|

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesSoup
|Name         |Type                                                                                                     |
|-------------|---------------------------------------------------------------------------------------------------------|
|`active`     |`null`&#124;`bool`                                                                                       |
|`allergens`  |`mixed`[]&#124;`null`&#124;`array`                                                                       |
|`mille`      |`string`                                                                                                 |
|`id`         |`string`                                                                                                 |
|`ingredients`|[`LiesSoupIngredient`](#swacexamplefoobaroas3liedefinitionsliessoupingredient)[]&#124;`null`&#124;`array`|
|`name`       |`string`                                                                                                 |
|`slug`       |`string`                                                                                                 |

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesSoupIngredient
|Name               |Type                                                                                                  |
|-------------------|------------------------------------------------------------------------------------------------------|
|`allergens`        |`mixed`[]&#124;`null`&#124;`array`                                                                    |
|`mille`            |`string`                                                                                              |
|`description`      |`null`&#124;`string`                                                                                  |
|`family`           |[`LiesSoupIngredientFamily`](#swacexamplefoobaroas3liedefinitionsliessoupingredientfamily)&#124;`null`|
|`hasDuplicatedName`|`null`&#124;`bool`                                                                                    |
|`id`               |`string`                                                                                              |
|`imageLink`        |`null`&#124;`string`                                                                                  |
|`imagePath`        |`null`&#124;`string`                                                                                  |
|`internalName`     |`null`&#124;`string`                                                                                  |
|`name`             |`string`                                                                                              |
|`shipped`          |`null`&#124;`bool`                                                                                    |
|`slug`             |`string`                                                                                              |
|`type`             |`string`                                                                                              |
|`usage`            |`int`                                                                                                 |

#### Swac\Example\FooBarOAS3\Lie\Definitions\LiesSoupIngredientFamily
|Name          |Type                            |
|--------------|--------------------------------|
|`createdAt`   |`string`                        |
|`description` |`null`&#124;`string`            |
|`iconLink`    |`null`&#124;`string`            |
|`iconPath`    |`null`&#124;`string`            |
|`id`          |`string`                        |
|`name`        |`string`                        |
|`priority`    |`int`                           |
|`slug`        |`string`                        |
|`type`        |`string`                        |
|`updatedAt`   |`string`                        |
|`usageByMille`|`int`[]&#124;`int`[]&#124;`null`|

#### Swac\Example\FooBarOAS3\Lie\Definitions\UsecaseFindAvailableCarrotsInput
|Name   |Type                                                                                                                                                                                                                                          |
|-------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
|`items`|[`UsecaseFindAvailableCarrotsInputItem`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsinputitem)[]&#124;[`UsecaseFindAvailableCarrotsInputItem`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsinputitem)[]|

#### Swac\Example\FooBarOAS3\Lie\Definitions\UsecaseFindAvailableCarrotsInputItem
|Name          |Type    |Description             |
|--------------|--------|------------------------|
|`foxId`       |`int`   |                        |
|`foxUuid`     |`string`|In: query, Name: foxUuid|
|`potatoFamily`|`string`|                        |
|`holeId`      |`int`   |                        |

#### Swac\Example\FooBarOAS3\Lie\Definitions\UsecaseFindAvailableCarrotsOutput
|Name   |Type                                                                                                                                                                                                                                              |Description                                                  |
|-------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------|
|`items`|[`UsecaseFindAvailableCarrotsOutputItem`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsoutputitem)[]&#124;[`UsecaseFindAvailableCarrotsOutputItem`](#swacexamplefoobaroas3liedefinitionsusecasefindavailablecarrotsoutputitem)[]|Available carrot indexes mapped with same key as input items.|

#### Swac\Example\FooBarOAS3\Lie\Definitions\UsecaseFindAvailableCarrotsOutputItem
|Name     |Type                |
|---------|--------------------|
|`carrots`|`int`[]&#124;`array`|
|`error`  |`string`            |

#### Swac\Example\FooBarOAS3\Place\Definitions\PlaceEntity
|Name       |Type    |Description             |
|-----------|--------|------------------------|
|`placeId`  |`int`   |                        |
|`createdAt`|`string`|                        |
|`foxId`    |`int`   |                        |
|`foxUuid`  |`string`|In: query, Name: foxUuid|
|`fooId`    |`int`   |                        |
|`barName`  |`string`|                        |

#### Swac\Example\FooBarOAS3\Place\Definitions\RestErrResponse
|Name     |Type     |
|---------|---------|
|`code`   |`int`    |
|`context`|`mixed`[]|
|`error`  |`string` |
|`status` |`string` |

#### Swac\Example\FooBarOAS3\Place\Definitions\UsecaseCreatePlaceInput
|Name     |Type    |Description             |
|---------|--------|------------------------|
|`foxId`  |`int`   |                        |
|`foxUuid`|`string`|In: query, Name: foxUuid|
|`fooId`  |`int`   |                        |
|`barName`|`string`|                        |


