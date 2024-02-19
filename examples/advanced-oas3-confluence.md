# Advanced Example

Version: v1.2.3

This app showcases a variety of features.

## Table Of Contents

* [Operations](#Operations)
  - [POST `/file-multi-upload`](#POST-%2Ffile-multi-upload) Files Uploads With 'multipart/form-data'
  - [POST `/file-upload`](#POST-%2Ffile-upload) File Upload With 'multipart/form-data'
  - [GET `/gzip-pass-through`](#GET-%2Fgzip-pass-through) direct Gzip
  - [HEAD `/gzip-pass-through`](#HEAD-%2Fgzip-pass-through) direct Gzip
  - [POST `/json-body-validation/{in-path}`](#POST-%2Fjson-body-validation%2F%7Bin-path%7D) Request With JSON Body and non-trivial validation
  - [POST `/json-body/{in-path}`](#POST-%2Fjson-body%2F%7Bin-path%7D) Request With JSON Body
  - [POST `/json-map-body`](#POST-%2Fjson-map-body) Request With JSON Map In Body
  - [GET `/json-param/{in-path}`](#GET-%2Fjson-param%2F%7Bin-path%7D) Request With JSON Query Parameter
  - [POST `/json-slice-body`](#POST-%2Fjson-slice-body) Request With JSON Array In Body
  - [GET `/output-csv-writer`](#GET-%2Foutput-csv-writer) Output With Stream Writer
  - [GET `/output-headers`](#GET-%2Foutput-headers) Output With Headers
  - [HEAD `/output-headers`](#HEAD-%2Foutput-headers) Output With Headers
  - [GET `/query-object`](#GET-%2Fquery-object) Request With Object As Query Parameter
  - [POST `/req-resp-mapping`](#POST-%2Freq-resp-mapping) Request Response Mapping
  - [POST `/validation`](#POST-%2Fvalidation) Validation
* [Types](#Types)

## Operations

### POST `/file-multi-upload`

Files Uploads With 'multipart/form-data'

#### Parameters

|Name      |In      |Type                                             |Description                        |
|----------|--------|-------------------------------------------------|-----------------------------------|
|`in_query`|query   |`Number`                                         |Simple scalar value in query.      |
|`simple`  |formData|`String`                                         |Simple scalar value in body.       |
|`uploads1`|formData|`Array<String`, Format: `binary>`, `null`        |Uploads with *multipart.FileHeader.|
|`uploads2`|formData|`Array<null`, `String`, Format: `binary>`, `null`|Uploads with multipart.File.       |

#### Response

|Status|Content Type      |Body Type                              |Description|
|------|------------------|---------------------------------------|-----------|
|200   |`application/json`|[AdvancedInfoType2](#AdvancedInfoType2)|OK         |
### POST `/file-upload`

File Upload With 'multipart/form-data'

#### Parameters

|Name      |In      |Type                              |Description                  |
|----------|--------|----------------------------------|-----------------------------|
|`in_query`|query   |`Number`                          |Simple scalar value in query.|
|`simple`  |formData|`String`                          |Simple scalar value in body. |
|`upload1` |formData|`String`, Format: `binary`        |                             |
|`upload2` |formData|`null`, `String`, Format: `binary`|                             |

#### Response

|Status|Content Type      |Body Type                    |Description|
|------|------------------|-----------------------------|-----------|
|200   |`application/json`|[AdvancedInfo](#AdvancedInfo)|OK         |
### GET `/gzip-pass-through`

direct Gzip

#### Parameters

|Name         |In   |Type     |Description                                      |
|-------------|-----|---------|-------------------------------------------------|
|`plainStruct`|query|`Boolean`|Output plain structure instead of gzip container.|
|`countItems` |query|`Boolean`|Invokes internal decoding of compressed data.    |

#### Response

|Status|Content Type      |Body Type                                                      |Headers             |Description|
|------|------------------|---------------------------------------------------------------|--------------------|-----------|
|200   |`application/json`|[AdvancedGzipPassThroughStruct](#AdvancedGzipPassThroughStruct)|`X-Header`: `String`|OK         |
### HEAD `/gzip-pass-through`

direct Gzip

#### Parameters

|Name         |In   |Type     |Description                                      |
|-------------|-----|---------|-------------------------------------------------|
|`plainStruct`|query|`Boolean`|Output plain structure instead of gzip container.|
|`countItems` |query|`Boolean`|Invokes internal decoding of compressed data.    |

#### Response

|Status|Content Type      |Headers             |Description|
|------|------------------|--------------------|-----------|
|200   |`application/json`|`X-Header`: `String`|OK         |
### POST `/json-body-validation/{in-path}`

Request With JSON Body and non-trivial validation

Request with JSON body and query/header/path params, response with JSON body and data from request.

#### Parameters

|Name      |In    |Type                                                     |Description                   |
|----------|------|---------------------------------------------------------|------------------------------|
|`in_query`|query |[InQuery2](#InQuery2), `Number`                          |Simple scalar value in query. |
|`in-path` |path  |[InPath](#InPath), `String`                              |Simple scalar value in path   |
|`X-Header`|header|[XHeader2](#XHeader2), `String`                          |Simple scalar value in header.|
|`body`    |body  |[AdvancedInputWithJSONType3](#AdvancedInputWithJSONType3)|                              |

#### Response

|Status|Content Type      |Body Type                                                  |Description|
|------|------------------|-----------------------------------------------------------|-----------|
|200   |`application/json`|[AdvancedOutputWithJSONType3](#AdvancedOutputWithJSONType3)|OK         |
### POST `/json-body/{in-path}`

Request With JSON Body

Request with JSON body and query/header/path params, response with JSON body and data from request.

#### Parameters

|Name      |In    |Type                                                     |Description                   |
|----------|------|---------------------------------------------------------|------------------------------|
|`in_query`|query |`String`, Format: `date`                                 |Simple scalar value in query. |
|`in-path` |path  |`String`                                                 |Simple scalar value in path   |
|`X-Header`|header|`String`                                                 |Simple scalar value in header.|
|`body`    |body  |[AdvancedInputWithJSONType2](#AdvancedInputWithJSONType2)|                              |

#### Response

|Status|Content Type      |Body Type                                                  |Description|
|------|------------------|-----------------------------------------------------------|-----------|
|201   |`application/json`|[AdvancedOutputWithJSONType2](#AdvancedOutputWithJSONType2)|Created    |
### POST `/json-map-body`

Request With JSON Map In Body

Request with JSON object (map) body.

#### Parameters

|Name      |In    |Type                        |Description                   |
|----------|------|----------------------------|------------------------------|
|`in_query`|query |`Number`                    |Simple scalar value in query. |
|`X-Header`|header|`String`                    |Simple scalar value in header.|
|`body`    |body  |`Map<String,Number>`, `null`|                              |

#### Response

|Status|Content Type      |Body Type                                          |Description|
|------|------------------|---------------------------------------------------|-----------|
|200   |`application/json`|[AdvancedJsonOutputType2](#AdvancedJsonOutputType2)|OK         |
### GET `/json-param/{in-path}`

Request With JSON Query Parameter

Request with JSON body and query/header/path params, response with JSON body and data from request.

#### Parameters

|Name      |In    |Type                                       |Description                   |
|----------|------|-------------------------------------------|------------------------------|
|`in_query`|query |`Number`                                   |Simple scalar value in query. |
|`identity`|query |[AdvancedJSONPayload](#AdvancedJSONPayload)|JSON value in query           |
|`in-path` |path  |`String`                                   |Simple scalar value in path   |
|`X-Header`|header|`String`                                   |Simple scalar value in header.|

#### Response

|Status|Content Type      |Body Type                                        |Description|
|------|------------------|-------------------------------------------------|-----------|
|200   |`application/json`|[AdvancedOutputWithJSON](#AdvancedOutputWithJSON)|OK         |
### POST `/json-slice-body`

Request With JSON Array In Body

#### Parameters

|Name      |In    |Type                   |Description                   |
|----------|------|-----------------------|------------------------------|
|`in_query`|query |`Number`               |Simple scalar value in query. |
|`X-Header`|header|`String`               |Simple scalar value in header.|
|`body`    |body  |`Array<Number>`, `null`|                              |

#### Response

|Status|Content Type      |Body Type                                |Description|
|------|------------------|-----------------------------------------|-----------|
|200   |`application/json`|[AdvancedJsonOutput](#AdvancedJsonOutput)|OK         |
### GET `/output-csv-writer`

Output With Stream Writer

Output with stream writer.

#### Response

|Status|Content Type      |Body Type                          |Headers             |Description          |
|------|------------------|-----------------------------------|--------------------|---------------------|
|200   |`text/csv`        |                                   |`X-Header`: `String`|OK                   |
|500   |`application/json`|[RestErrResponse](#RestErrResponse)|                    |Internal Server Error|
### GET `/output-headers`

Output With Headers

Output with headers.

#### Response

|Status|Content Type      |Body Type                                    |Headers             |Description|
|------|------------------|---------------------------------------------|--------------------|-----------|
|200   |`application/json`|[AdvancedHeaderOutput](#AdvancedHeaderOutput)|`X-Header`: `String`|OK         |
### HEAD `/output-headers`

Output With Headers

Output with headers.

#### Response

|Status|Content Type      |Headers             |Description|
|------|------------------|--------------------|-----------|
|200   |`application/json`|`X-Header`: `String`|OK         |
### GET `/query-object`

Request With Object As Query Parameter

#### Parameters

|Name      |In   |Type                |Description           |
|----------|-----|--------------------|----------------------|
|`in_query`|query|`Map<String,Number>`|Object value in query.|

#### Response

|Status|Content Type      |Body Type                                              |Description|
|------|------------------|-------------------------------------------------------|-----------|
|200   |`application/json`|[AdvancedOutputQueryObject](#AdvancedOutputQueryObject)|OK         |
### POST `/req-resp-mapping`

Request Response Mapping

This use case has transport concerns fully decoupled with external req/resp mapping.

#### Parameters

|Name      |In      |Type    |Description         |
|----------|--------|--------|--------------------|
|`X-Header`|header  |`String`|Simple scalar value.|
|`val2`    |formData|`Number`|Simple scalar value.|

#### Response

|Status|Headers                                       |Description|
|------|----------------------------------------------|-----------|
|204   |`X-Value-1`: `String`<br>`X-Value-2`: `Number`|No Content |
### POST `/validation`

Validation

Input/Output with validation. Custom annotation.

#### Parameters

|Name     |In    |Type                                             |Description                                                                    |
|---------|------|-------------------------------------------------|-------------------------------------------------------------------------------|
|`q`      |query |`Boolean`                                        |This parameter will bypass explicit validation as it does not have constraints.|
|`X-Input`|header|[XInput](#XInput), `Number`                      |Request minimum: 10, response maximum: 20.                                     |
|`body`   |body  |[AdvancedInputPortType2](#AdvancedInputPortType2)|                                                                               |

#### Response

|Status|Content Type      |Body Type                                          |Headers                                                          |Description|
|------|------------------|---------------------------------------------------|-----------------------------------------------------------------|-----------|
|200   |`application/json`|[AdvancedOutputPortType2](#AdvancedOutputPortType2)|`X-Output`: [XOutput](#XOutput), `Number`<br>`X-Query`: `Boolean`|OK         |

## Types

### AdvancedInfoType2

|Property   |Type                                              |
|-----------|--------------------------------------------------|
|`filenames`|`Array<String>`, `null`                           |
|`headers`  |`Array<Map<String,Array<String>>`, `null>`, `null`|
|`inQuery`  |`Number`                                          |
|`peeks1`   |`Array<String>`, `null`                           |
|`peeks2`   |`Array<String>`, `null`                           |
|`simple`   |`String`                                          |
|`sizes`    |`Array<Number>`, `null`                           |

### AdvancedInfo

|Property  |Type                               |
|----------|-----------------------------------|
|`filename`|`String`                           |
|`header`  |`Map<String,Array<String>>`, `null`|
|`inQuery` |`Number`                           |
|`peek1`   |`String`                           |
|`peek2`   |`String`                           |
|`simple`  |`String`                           |
|`size`    |`Number`                           |

### AdvancedGzipPassThroughStruct

|Property|Type                   |
|--------|-----------------------|
|`id`    |`Number`               |
|`text`  |`Array<String>`, `null`|

### InQuery2
Simple scalar value in query.

|Constraint|Value|
|----------|-----|
|minimum   |100  |

### InPath
Simple scalar value in path

|Constraint|Value|
|----------|-----|
|minLength |3    |

### XHeader2
Simple scalar value in header.

|Constraint|Value|
|----------|-----|
|minLength |3    |

### AdvancedInputWithJSONType3Id

|Constraint|Value|
|----------|-----|
|minimum   |100  |

### AdvancedInputWithJSONType3Name

|Constraint|Value|
|----------|-----|
|minLength |3    |

### AdvancedInputWithJSONType3

|Property|Type                                                                       |
|--------|---------------------------------------------------------------------------|
|`id`    |[AdvancedInputWithJSONType3Id](#AdvancedInputWithJSONType3Id), `Number`    |
|`name`  |[AdvancedInputWithJSONType3Name](#AdvancedInputWithJSONType3Name), `String`|

### AdvancedOutputWithJSONType3Id

|Constraint|Value|
|----------|-----|
|minimum   |100  |

### AdvancedOutputWithJSONType3InHeader

|Constraint|Value|
|----------|-----|
|minLength |3    |

### AdvancedOutputWithJSONType3InPath

|Constraint|Value|
|----------|-----|
|minLength |3    |

### AdvancedOutputWithJSONType3InQuery

|Constraint|Value|
|----------|-----|
|minimum   |3    |

### AdvancedOutputWithJSONType3Name

|Constraint|Value|
|----------|-----|
|minLength |3    |

### AdvancedOutputWithJSONType3

|Property  |Type                                                                                 |
|----------|-------------------------------------------------------------------------------------|
|`id`      |[AdvancedOutputWithJSONType3Id](#AdvancedOutputWithJSONType3Id), `Number`            |
|`inHeader`|[AdvancedOutputWithJSONType3InHeader](#AdvancedOutputWithJSONType3InHeader), `String`|
|`inPath`  |[AdvancedOutputWithJSONType3InPath](#AdvancedOutputWithJSONType3InPath), `String`    |
|`inQuery` |[AdvancedOutputWithJSONType3InQuery](#AdvancedOutputWithJSONType3InQuery), `Number`  |
|`name`    |[AdvancedOutputWithJSONType3Name](#AdvancedOutputWithJSONType3Name), `String`        |

### AdvancedInputWithJSONType2

|Property|Type    |
|--------|--------|
|`id`    |`Number`|
|`name`  |`String`|

### AdvancedOutputWithJSONType2

|Property  |Type                    |
|----------|------------------------|
|`id`      |`Number`                |
|`inHeader`|`String`                |
|`inPath`  |`String`                |
|`inQuery` |`String`, Format: `date`|
|`name`    |`String`                |

### AdvancedJsonOutputType2

|Property  |Type                        |
|----------|----------------------------|
|`data`    |`Map<String,Number>`, `null`|
|`inHeader`|`String`                    |
|`inQuery` |`Number`                    |

### AdvancedJSONPayload

|Property|Type    |
|--------|--------|
|`id`    |`Number`|
|`name`  |`String`|

### AdvancedOutputWithJSON

|Property  |Type    |
|----------|--------|
|`id`      |`Number`|
|`inHeader`|`String`|
|`inPath`  |`String`|
|`inQuery` |`Number`|
|`name`    |`String`|

### AdvancedJsonOutput

|Property  |Type                   |
|----------|-----------------------|
|`data`    |`Array<Number>`, `null`|
|`inHeader`|`String`               |
|`inQuery` |`Number`               |

### RestErrResponse

|Property |Type           |Description                     |
|---------|---------------|--------------------------------|
|`code`   |`Number`       |Application-specific error code.|
|`context`|`Map<String,*>`|Application context.            |
|`error`  |`String`       |Error message.                  |
|`status` |`String`       |Status text.                    |

### AdvancedHeaderOutput

|Property|Type    |
|--------|--------|
|`inBody`|`String`|

### AdvancedOutputQueryObject

|Property |Type                        |
|---------|----------------------------|
|`inQuery`|`Map<String,Number>`, `null`|

### XInput
Request minimum: 10, response maximum: 20.

|Constraint|Value|
|----------|-----|
|minimum   |10   |

### AdvancedInputPortType2DataValue
Request minLength: 3, response maxLength: 7

|Constraint|Value|
|----------|-----|
|minLength |3    |

### AdvancedInputPortType2Data

|Property|Type                                                                         |Description                                 |
|--------|-----------------------------------------------------------------------------|--------------------------------------------|
|`value` |[AdvancedInputPortType2DataValue](#AdvancedInputPortType2DataValue), `String`|Request minLength: 3, response maxLength: 7.|

### AdvancedInputPortType2

|Property         |Type                                                     |
|-----------------|---------------------------------------------------------|
|`data` (required)|[AdvancedInputPortType2Data](#AdvancedInputPortType2Data)|

### XOutput

|Constraint|Value|
|----------|-----|
|maximum   |20   |

### AdvancedOutputPortType2DataValue

|Constraint|Value|
|----------|-----|
|maxLength |7    |

### AdvancedOutputPortType2Data

|Property|Type                                                                           |
|--------|-------------------------------------------------------------------------------|
|`value` |[AdvancedOutputPortType2DataValue](#AdvancedOutputPortType2DataValue), `String`|

### AdvancedOutputPortType2

|Property         |Type                                                       |
|-----------------|-----------------------------------------------------------|
|`data` (required)|[AdvancedOutputPortType2Data](#AdvancedOutputPortType2Data)|
