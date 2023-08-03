# API

### 

* [`DELETE /pets/{id}`](#deletepet) deletes a single pet based on the ID supplied
* [`GET /pets/{id}`](#findpetbyid) Returns a user based on a single ID, if the user does not have access to
* [`GET /pets`](#findpets) Returns all pets from the system that the user has access to
* [`POST /pets`](#addpet) Creates a new pet in the store.  Duplicates are allowed



## Operations

### `FindPets`

Returns all pets from the system that the user has access to
Nam sed condimentum est. Maecenas tempor sagittis sapien, nec rhoncus sem
sagittis sit amet. Aenean at gravida augue, ac iaculis sem. Curabitur odio
lorem, ornare eget elementum nec, cursus id lectus. Duis mi turpis,
pulvinar ac eros ac, tincidunt varius justo. In hac habitasse platea
dictumst. Integer at adipiscing ante, a sagittis ligula. Aenean pharetra
tempor ante molestie imperdiet. Vivamus id aliquam diam. Cras quis velit
non tortor eleifend sagittis. Praesent at enim pharetra urna volutpat
venenatis eget eget mauris. In eleifend fermentum facilisis. Praesent enim
enim, gravida ac sodales sed, placerat id erat. Suspendisse lacus dolor,
consectetur non augue vel, vehicula interdum libero. Morbi euismod sagittis
libero sed lacinia.

Sed tempus felis lobortis leo pulvinar rutrum. Nam mattis velit nisl, eu
condimentum ligula luctus nec. Phasellus semper velit eget aliquet
faucibus. In a mattis elit. Phasellus vel urna viverra, condimentum lorem
id, rhoncus nibh. Ut pellentesque posuere elementum. Sed a varius odio.
Morbi rhoncus ligula libero, vel eleifend nunc tristique vitae. Fusce et
sem dui. Aenean nec scelerisque tortor. Fusce malesuada accumsan magna vel
tempus. Quisque mollis felis eu dolor tristique, sit amet auctor felis
gravida. Sed libero lorem, molestie sed nisl in, accumsan tempor nisi.
Fusce sollicitudin massa ut lacinia mattis. Sed vel eleifend lorem.
Pellentesque vitae felis pretium, pulvinar elit eu, euismod sapien.


_Endpoint_: `/pets`

_Namespace_: `Swac\Example\PetstoreOAS3\Operation`

#### Request
Type: `Swac\Example\PetstoreOAS3\Request\FindPetsRequest`

|Name   |Type                   |In     |Description                        |
|-------|-----------------------|-------|-----------------------------------|
|`tags` |`string`[]&#124;`array`|`query`|tags to filter by                  |
|`limit`|`int`                  |`query`|maximum number of results to return|





#### Response


|Status|Type                                                                    |Description     |
|------|------------------------------------------------------------------------|----------------|
|200 OK|[`GetPetsOKResponse`](#swacexamplepetstoreoas3responsegetpetsokresponse)|pet response    |
|      |[`Error`](#swacexamplepetstoreoas3definitionserror)                     |unexpected error|

### `AddPet`

Creates a new pet in the store.  Duplicates are allowed

_Endpoint_: `/pets`

_Namespace_: `Swac\Example\PetstoreOAS3\Operation`

#### Request
Type: `Swac\Example\PetstoreOAS3\Request\AddPetRequest`

|Name  |Type                                                 |In    |Description|
|------|-----------------------------------------------------|------|-----------|
|`body`|[`NewPet`](#swacexamplepetstoreoas3definitionsnewpet)|`body`|           |


#### Swac\Example\PetstoreOAS3\Definitions\NewPet
|Name  |Type    |
|------|--------|
|`name`|`string`|
|`tag` |`string`|



#### Response


|Status|Type                                               |Description     |
|------|---------------------------------------------------|----------------|
|200 OK|[`Pet`](#swacexamplepetstoreoas3definitionspet)    |pet response    |
|      |[`Error`](#swacexamplepetstoreoas3definitionserror)|unexpected error|

### `FindPetById`

Returns a user based on a single ID, if the user does not have access to
the pet

_Endpoint_: `/pets/{id}`

_Namespace_: `Swac\Example\PetstoreOAS3\Operation`

#### Request
Type: `Swac\Example\PetstoreOAS3\Request\FindPetByIdRequest`

|Name|Type |In    |Description       |
|----|-----|------|------------------|
|`id`|`int`|`path`|ID of pet to fetch|





#### Response


|Status|Type                                               |Description     |
|------|---------------------------------------------------|----------------|
|200 OK|[`Pet`](#swacexamplepetstoreoas3definitionspet)    |pet response    |
|      |[`Error`](#swacexamplepetstoreoas3definitionserror)|unexpected error|

### `DeletePet`

deletes a single pet based on the ID supplied

_Endpoint_: `/pets/{id}`

_Namespace_: `Swac\Example\PetstoreOAS3\Operation`

#### Request
Type: `Swac\Example\PetstoreOAS3\Request\DeletePetRequest`

|Name|Type |In    |Description        |
|----|-----|------|-------------------|
|`id`|`int`|`path`|ID of pet to delete|





#### Response


|Status        |Type                                               |Description     |
|--------------|---------------------------------------------------|----------------|
|204 No Content|                                                   |pet deleted     |
|              |[`Error`](#swacexamplepetstoreoas3definitionserror)|unexpected error|



## Structures

#### Swac\Example\PetstoreOAS3\Definitions\Error
|Name     |Type    |
|---------|--------|
|`code`   |`int`   |
|`message`|`string`|

#### Swac\Example\PetstoreOAS3\Definitions\NewPet
|Name  |Type    |
|------|--------|
|`name`|`string`|
|`tag` |`string`|

#### Swac\Example\PetstoreOAS3\Definitions\Pet
[`NewPet`](#swacexamplepetstoreoas3definitionsnewpet)&#124;[`GetPetsOKResponseItemsAllOf1`](#swacexamplepetstoreoas3responsegetpetsokresponseitemsallof1)
#### Swac\Example\PetstoreOAS3\Response\GetPetsOKResponse
[`NewPet`](#swacexamplepetstoreoas3definitionsnewpet)&#124;[`GetPetsOKResponseItemsAllOf1`](#swacexamplepetstoreoas3responsegetpetsokresponseitemsallof1)[]&#124;`array`
#### Swac\Example\PetstoreOAS3\Response\GetPetsOKResponseItemsAllOf1
|Name|Type |
|----|-----|
|`id`|`int`|


