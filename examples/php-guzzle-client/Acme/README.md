# API

### 

* [`GET /Foos`](#getfoos) Get Foo for specified filters. Either activity_day or activity_option has



## Operations

### `GetFoos`

Get Foo for specified filters. Either activity_day or activity_option has
to be provided.

_Endpoint_: `/Foos`

_Namespace_: `Swac\Example\Acme\Operation`

#### Request
Type: `Swac\Example\Acme\Request\GetFoosRequest`

|Name            |Type    |In     |Description                                                |
|----------------|--------|-------|-----------------------------------------------------------|
|`postcode`      |`string`|`query`|Filter Foos by postcode                                    |
|`activityOption`|`string`|`query`|Filter Foos by activity option                             |
|`activityDay`   |`int`   |`query`|Filter Foos by activity day (priority over activity_option)|
|`project`       |`string`|`query`|Which project is the request coming from                   |
|`country`       |`string`|`query`|                                                           |





#### Response


|Status|Type                                   |Description|
|------|---------------------------------------|-----------|
|200 OK|[`Foo`](#swacexampleacmedefinitionsfoo)|           |



## Structures

#### Swac\Example\Acme\Definitions\Foo
|Name  |Type    |
|------|--------|
|`code`|`string`|


