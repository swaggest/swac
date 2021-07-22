<!-- Code is generated by github.com/swaggest/swac <version>, DO NOT EDIT. 🤖 -->

# Swagger Petstore

Version: 1.0.0

A sample API that uses a petstore as an example to demonstrate features in
the OpenAPI 3.0 specification

Base URL:http://petstore.swagger.io/api

## Table Of Contents

* [Operations](#operations)
  - [GET `/pets`](#findpets) 
  - [POST `/pets`](#postpets) 
  - [GET `/pets/{id}`](#getpetsid) 
  - [DELETE `/pets/{id}`](#deletepetsid) 
* [Types](#types)

## <a id="operations"></a>Operations

### <a id="findpets"></a>GET `/pets`

Returns all pets from the system that the user has access to
Nam sed condimentum est. Maecenas tempor sagittis sapien, nec rhoncus sem sagittis sit amet. Aenean at gravida augue, ac iaculis sem. Curabitur odio lorem, ornare eget elementum nec, cursus id lectus. Duis mi turpis, pulvinar ac eros ac, tincidunt varius justo. In hac habitasse platea dictumst. Integer at adipiscing ante, a sagittis ligula. Aenean pharetra tempor ante molestie imperdiet. Vivamus id aliquam diam. Cras quis velit non tortor eleifend sagittis. Praesent at enim pharetra urna volutpat venenatis eget eget mauris. In eleifend fermentum facilisis. Praesent enim enim, gravida ac sodales sed, placerat id erat. Suspendisse lacus dolor, consectetur non augue vel, vehicula interdum libero. Morbi euismod sagittis libero sed lacinia.

Sed tempus felis lobortis leo pulvinar rutrum. Nam mattis velit nisl, eu condimentum ligula luctus nec. Phasellus semper velit eget aliquet faucibus. In a mattis elit. Phasellus vel urna viverra, condimentum lorem id, rhoncus nibh. Ut pellentesque posuere elementum. Sed a varius odio. Morbi rhoncus ligula libero, vel eleifend nunc tristique vitae. Fusce et sem dui. Aenean nec scelerisque tortor. Fusce malesuada accumsan magna vel tempus. Quisque mollis felis eu dolor tristique, sit amet auctor felis gravida. Sed libero lorem, molestie sed nisl in, accumsan tempor nisi. Fusce sollicitudin massa ut lacinia mattis. Sed vel eleifend lorem. Pellentesque vitae felis pretium, pulvinar elit eu, euismod sapien.

#### Parameters

|Name   |In   |Type                       |Description                        |
|-------|-----|---------------------------|-----------------------------------|
|`tags` |query|`Array<String>`            |tags to filter by                  |
|`limit`|query|[`Limit`](#limit), `Number`|maximum number of results to return|

#### Response

|Status|Content Type      |Body Type                                                |Description |
|------|------------------|---------------------------------------------------------|------------|
|200   |`application/json`|`Array<`[`NewPet`](#newpet), [`PetAllOf1`](#petallof1)`>`|pet response|
### <a id="postpets"></a>POST `/pets`

Creates a new pet in the store.  Duplicates are allowed

#### Parameters

|Name  |In  |Type               |
|------|----|-------------------|
|`body`|body|[`NewPet`](#newpet)|

#### Response

|Status|Content Type      |Body Type                                     |Description |
|------|------------------|----------------------------------------------|------------|
|200   |`application/json`|[`NewPet`](#newpet), [`PetAllOf1`](#petallof1)|pet response|
### <a id="getpetsid"></a>GET `/pets/{id}`

Returns a user based on a single ID, if the user does not have access to the pet

#### Parameters

|Name|In  |Type                 |Description       |
|----|----|---------------------|------------------|
|`id`|path|[`Id`](#id), `Number`|ID of pet to fetch|

#### Response

|Status|Content Type      |Body Type                                     |Description |
|------|------------------|----------------------------------------------|------------|
|200   |`application/json`|[`NewPet`](#newpet), [`PetAllOf1`](#petallof1)|pet response|
### <a id="deletepetsid"></a>DELETE `/pets/{id}`

deletes a single pet based on the ID supplied

#### Parameters

|Name|In  |Type                 |Description        |
|----|----|---------------------|-------------------|
|`id`|path|[`Id`](#id), `Number`|ID of pet to delete|

#### Response

|Status|Description|
|------|-----------|
|204   |pet deleted|

## <a id="types"></a> Types

### <a id="limit"></a>Limit

|Constraint|Value|
|----------|-----|
|format    |int32|

### <a id="newpet"></a>NewPet

|Property         |Type    |
|-----------------|--------|
|`name` (required)|`String`|
|`tag`            |`String`|

### <a id="petallof1id"></a>PetAllOf1Id

|Constraint|Value|
|----------|-----|
|format    |int64|

### <a id="petallof1"></a>PetAllOf1

|Property       |Type                                   |
|---------------|---------------------------------------|
|`id` (required)|[`PetAllOf1Id`](#petallof1id), `Number`|

### <a id="id"></a>Id

|Constraint|Value|
|----------|-----|
|format    |int64|

### <a id="id"></a>Id

|Constraint|Value|
|----------|-----|
|format    |int64|
