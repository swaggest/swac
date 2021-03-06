<!-- Code is generated by github.com/swaggest/swac <version>, DO NOT EDIT. 🤖 -->

# Advanced Example

Version: v1.2.3

This app showcases a variety of features.

## Table Of Contents

* [Operations](#operations)
  - [POST `/file-multi-upload`](#examplesadvancedfilemultiuploader) 
  - [POST `/file-upload`](#postfileupload) 
  - [GET `/gzip-pass-through`](#getgzippassthrough) 
  - [HEAD `/gzip-pass-through`](#headgzippassthrough) 
  - [POST `/json-body-validation/{in-path}`](#postjsonbodyvalidationinpath) 
  - [POST `/json-body/{in-path}`](#postjsonbodyinpath) 
  - [POST `/json-map-body`](#postjsonmapbody) 
  - [GET `/json-param/{in-path}`](#getjsonparaminpath) 
  - [POST `/json-slice-body`](#postjsonslicebody) 
  - [GET `/output-csv-writer`](#getoutputcsvwriter) 
  - [GET `/output-headers`](#getoutputheaders) 
  - [HEAD `/output-headers`](#headoutputheaders) 
  - [GET `/query-object`](#getqueryobject) 
  - [POST `/req-resp-mapping`](#postreqrespmapping) 
  - [POST `/validation`](#postvalidation) 
* [Types](#types)

## <a id="operations"></a>Operations

### <a id="examplesadvancedfilemultiuploader"></a>POST `/file-multi-upload`
Files Uploads With 'multipart/form-data'

#### Parameters

|Name      |In      |Type                                                                                    |Description                  |
|----------|--------|----------------------------------------------------------------------------------------|-----------------------------|
|`in_query`|query   |`Number`                                                                                |Simple scalar value in query.|
|`simple`  |formData|`String`                                                                                |                             |
|`uploads1`|formData|`Array<`[`FormDataMultipartFileHeader`](#formdatamultipartfileheader), `String>`, `null`|                             |
|`uploads2`|formData|`Array<`[`FormDataMultipartFile`](#formdatamultipartfile), `null`, `String>`, `null`    |                             |

#### Response

|Status|Content Type      |Body Type                                |Description|
|------|------------------|-----------------------------------------|-----------|
|200   |`application/json`|[`AdvancedInfoType2`](#advancedinfotype2)|OK         |
### <a id="postfileupload"></a>POST `/file-upload`
File Upload With 'multipart/form-data'

#### Parameters

|Name      |In      |Type                                                                   |Description                  |
|----------|--------|-----------------------------------------------------------------------|-----------------------------|
|`in_query`|query   |`Number`                                                               |Simple scalar value in query.|
|`simple`  |formData|`String`                                                               |                             |
|`upload1` |formData|[`FormDataMultipartFileHeader`](#formdatamultipartfileheader), `String`|                             |
|`upload2` |formData|[`FormDataMultipartFile`](#formdatamultipartfile), `null`, `String`    |                             |

#### Response

|Status|Content Type      |Body Type                      |Description|
|------|------------------|-------------------------------|-----------|
|200   |`application/json`|[`AdvancedInfo`](#advancedinfo)|OK         |
### <a id="getgzippassthrough"></a>GET `/gzip-pass-through`
direct Gzip

#### Parameters

|Name         |In   |Type     |Description                                      |
|-------------|-----|---------|-------------------------------------------------|
|`plainStruct`|query|`Boolean`|Output plain structure instead of gzip container.|
|`countItems` |query|`Boolean`|Invokes internal decoding of compressed data.    |

#### Response

|Status|Content Type      |Body Type                                                        |Headers             |Description|
|------|------------------|-----------------------------------------------------------------|--------------------|-----------|
|200   |`application/json`|[`AdvancedGzipPassThroughStruct`](#advancedgzippassthroughstruct)|`X-Header`: `String`|OK         |
### <a id="headgzippassthrough"></a>HEAD `/gzip-pass-through`
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
### <a id="postjsonbodyvalidationinpath"></a>POST `/json-body-validation/{in-path}`
Request With JSON Body and non-trivial validation

Request with JSON body and query/header/path params, response with JSON body and data from request.

#### Parameters

|Name      |In    |Type                                                       |Description                   |
|----------|------|-----------------------------------------------------------|------------------------------|
|`in_query`|query |[`InQuery2`](#inquery2), `Number`                          |Simple scalar value in query. |
|`in-path` |path  |[`InPath`](#inpath), `String`                              |Simple scalar value in path   |
|`X-Header`|header|[`XHeader2`](#xheader2), `String`                          |Simple scalar value in header.|
|`body`    |body  |[`AdvancedInputWithJSONType3`](#advancedinputwithjsontype3)|                              |

#### Response

|Status|Content Type      |Body Type                                                    |Description|
|------|------------------|-------------------------------------------------------------|-----------|
|200   |`application/json`|[`AdvancedOutputWithJSONType3`](#advancedoutputwithjsontype3)|OK         |
### <a id="postjsonbodyinpath"></a>POST `/json-body/{in-path}`
Request With JSON Body

Request with JSON body and query/header/path params, response with JSON body and data from request.

#### Parameters

|Name      |In    |Type                                                       |Description                   |
|----------|------|-----------------------------------------------------------|------------------------------|
|`in_query`|query |[`InQuery3`](#inquery3), `String`                          |Simple scalar value in query. |
|`in-path` |path  |`String`                                                   |Simple scalar value in path   |
|`X-Header`|header|`String`                                                   |Simple scalar value in header.|
|`body`    |body  |[`AdvancedInputWithJSONType2`](#advancedinputwithjsontype2)|                              |

#### Response

|Status|Content Type      |Body Type                                                    |Description|
|------|------------------|-------------------------------------------------------------|-----------|
|201   |`application/json`|[`AdvancedOutputWithJSONType2`](#advancedoutputwithjsontype2)|Created    |
### <a id="postjsonmapbody"></a>POST `/json-map-body`
Request With JSON Map In Body

Request with JSON object (map) body.

#### Parameters

|Name      |In    |Type                        |Description                   |
|----------|------|----------------------------|------------------------------|
|`in_query`|query |`Number`                    |Simple scalar value in query. |
|`X-Header`|header|`String`                    |Simple scalar value in header.|
|`body`    |body  |`Map<String,Number>`, `null`|                              |

#### Response

|Status|Content Type      |Body Type                                            |Description|
|------|------------------|-----------------------------------------------------|-----------|
|200   |`application/json`|[`AdvancedJsonOutputType2`](#advancedjsonoutputtype2)|OK         |
### <a id="getjsonparaminpath"></a>GET `/json-param/{in-path}`
Request With JSON Query Parameter

Request with JSON body and query/header/path params, response with JSON body and data from request.

#### Parameters

|Name      |In    |Type                                         |Description                   |
|----------|------|---------------------------------------------|------------------------------|
|`in_query`|query |`Number`                                     |Simple scalar value in query. |
|`identity`|query |[`AdvancedJSONPayload`](#advancedjsonpayload)|JSON value in query           |
|`in-path` |path  |`String`                                     |Simple scalar value in path   |
|`X-Header`|header|`String`                                     |Simple scalar value in header.|

#### Response

|Status|Content Type      |Body Type                                          |Description|
|------|------------------|---------------------------------------------------|-----------|
|200   |`application/json`|[`AdvancedOutputWithJSON`](#advancedoutputwithjson)|OK         |
### <a id="postjsonslicebody"></a>POST `/json-slice-body`
Request With JSON Array In Body

#### Parameters

|Name      |In    |Type                   |Description                   |
|----------|------|-----------------------|------------------------------|
|`in_query`|query |`Number`               |Simple scalar value in query. |
|`X-Header`|header|`String`               |Simple scalar value in header.|
|`body`    |body  |`Array<Number>`, `null`|                              |

#### Response

|Status|Content Type      |Body Type                                  |Description|
|------|------------------|-------------------------------------------|-----------|
|200   |`application/json`|[`AdvancedJsonOutput`](#advancedjsonoutput)|OK         |
### <a id="getoutputcsvwriter"></a>GET `/output-csv-writer`
Output With Stream Writer

Output with stream writer.

#### Response

|Status|Content Type      |Body Type                            |Headers             |Description          |
|------|------------------|-------------------------------------|--------------------|---------------------|
|200   |`text/csv`        |`*`                                  |`X-Header`: `String`|OK                   |
|500   |`application/json`|[`RestErrResponse`](#resterrresponse)|                    |Internal Server Error|
### <a id="getoutputheaders"></a>GET `/output-headers`
Output With Headers

Output with headers.

#### Response

|Status|Content Type      |Body Type                                      |Headers             |Description|
|------|------------------|-----------------------------------------------|--------------------|-----------|
|200   |`application/json`|[`AdvancedHeaderOutput`](#advancedheaderoutput)|`X-Header`: `String`|OK         |
### <a id="headoutputheaders"></a>HEAD `/output-headers`
Output With Headers

Output with headers.

#### Response

|Status|Content Type      |Headers             |Description|
|------|------------------|--------------------|-----------|
|200   |`application/json`|`X-Header`: `String`|OK         |
### <a id="getqueryobject"></a>GET `/query-object`
Request With Object As Query Parameter

#### Parameters

|Name      |In   |Type                |Description           |
|----------|-----|--------------------|----------------------|
|`in_query`|query|`Map<String,Number>`|Object value in query.|

#### Response

|Status|Content Type      |Body Type                                                |Description|
|------|------------------|---------------------------------------------------------|-----------|
|200   |`application/json`|[`AdvancedOutputQueryObject`](#advancedoutputqueryobject)|OK         |
### <a id="postreqrespmapping"></a>POST `/req-resp-mapping`
Request Response Mapping

This use case has transport concerns fully decoupled with external req/resp mapping.

#### Parameters

|Name      |In      |Type    |Description         |
|----------|--------|--------|--------------------|
|`X-Header`|header  |`String`|Simple scalar value.|
|`val2`    |formData|`Number`|                    |

#### Response

|Status|Headers                                       |Description|
|------|----------------------------------------------|-----------|
|204   |`X-Value-1`: `String`<br>`X-Value-2`: `Number`|No Content |
### <a id="postvalidation"></a>POST `/validation`
Validation

Input/Output with validation. Custom annotation.

#### Parameters

|Name     |In    |Type                                               |Description                                                                    |
|---------|------|---------------------------------------------------|-------------------------------------------------------------------------------|
|`q`      |query |`Boolean`                                          |This parameter will bypass explicit validation as it does not have constraints.|
|`X-Input`|header|[`XInput`](#xinput), `Number`                      |Request minimum: 10, response maximum: 20.                                     |
|`body`   |body  |[`AdvancedInputPortType2`](#advancedinputporttype2)|                                                                               |

#### Response

|Status|Content Type      |Body Type                                            |Headers                                                            |Description|
|------|------------------|-----------------------------------------------------|-------------------------------------------------------------------|-----------|
|200   |`application/json`|[`AdvancedOutputPortType2`](#advancedoutputporttype2)|`X-Output`: [`XOutput`](#xoutput), `Number`<br>`X-Query`: `Boolean`|OK         |

## <a id="types"></a> Types

### <a id="formdatamultipartfileheader"></a>FormDataMultipartFileHeader

|Constraint|Value |
|----------|------|
|format    |binary|

### <a id="formdatamultipartfile"></a>FormDataMultipartFile

|Constraint|Value |
|----------|------|
|format    |binary|

### <a id="advancedinfotype2"></a>AdvancedInfoType2

|Property   |Type                                              |
|-----------|--------------------------------------------------|
|`filenames`|`Array<String>`, `null`                           |
|`headers`  |`Array<Map<String,Array<String>>`, `null>`, `null`|
|`inQuery`  |`Number`                                          |
|`peeks1`   |`Array<String>`, `null`                           |
|`peeks2`   |`Array<String>`, `null`                           |
|`simple`   |`String`                                          |
|`sizes`    |`Array<Number>`, `null`                           |

### <a id="advancedinfo"></a>AdvancedInfo

|Property  |Type                               |
|----------|-----------------------------------|
|`filename`|`String`                           |
|`header`  |`Map<String,Array<String>>`, `null`|
|`inQuery` |`Number`                           |
|`peek1`   |`String`                           |
|`peek2`   |`String`                           |
|`simple`  |`String`                           |
|`size`    |`Number`                           |

### <a id="advancedgzippassthroughstruct"></a>AdvancedGzipPassThroughStruct

|Property|Type                   |
|--------|-----------------------|
|`id`    |`Number`               |
|`text`  |`Array<String>`, `null`|

### <a id="inquery2"></a>InQuery2
Simple scalar value in query.

|Constraint|Value|
|----------|-----|
|minimum   |100  |

### <a id="inpath"></a>InPath
Simple scalar value in path

|Constraint|Value|
|----------|-----|
|minLength |3    |

### <a id="xheader2"></a>XHeader2
Simple scalar value in header.

|Constraint|Value|
|----------|-----|
|minLength |3    |

### <a id="advancedinputwithjsontype3id"></a>AdvancedInputWithJSONType3Id

|Constraint|Value|
|----------|-----|
|minimum   |100  |

### <a id="advancedinputwithjsontype3name"></a>AdvancedInputWithJSONType3Name

|Constraint|Value|
|----------|-----|
|minLength |3    |

### <a id="advancedinputwithjsontype3"></a>AdvancedInputWithJSONType3

|Property|Type                                                                         |
|--------|-----------------------------------------------------------------------------|
|`id`    |[`AdvancedInputWithJSONType3Id`](#advancedinputwithjsontype3id), `Number`    |
|`name`  |[`AdvancedInputWithJSONType3Name`](#advancedinputwithjsontype3name), `String`|

### <a id="advancedoutputwithjsontype3id"></a>AdvancedOutputWithJSONType3Id

|Constraint|Value|
|----------|-----|
|minimum   |100  |

### <a id="advancedoutputwithjsontype3inheader"></a>AdvancedOutputWithJSONType3InHeader

|Constraint|Value|
|----------|-----|
|minLength |3    |

### <a id="advancedoutputwithjsontype3inpath"></a>AdvancedOutputWithJSONType3InPath

|Constraint|Value|
|----------|-----|
|minLength |3    |

### <a id="advancedoutputwithjsontype3inquery"></a>AdvancedOutputWithJSONType3InQuery

|Constraint|Value|
|----------|-----|
|minimum   |3    |

### <a id="advancedoutputwithjsontype3name"></a>AdvancedOutputWithJSONType3Name

|Constraint|Value|
|----------|-----|
|minLength |3    |

### <a id="advancedoutputwithjsontype3"></a>AdvancedOutputWithJSONType3

|Property  |Type                                                                                   |
|----------|---------------------------------------------------------------------------------------|
|`id`      |[`AdvancedOutputWithJSONType3Id`](#advancedoutputwithjsontype3id), `Number`            |
|`inHeader`|[`AdvancedOutputWithJSONType3InHeader`](#advancedoutputwithjsontype3inheader), `String`|
|`inPath`  |[`AdvancedOutputWithJSONType3InPath`](#advancedoutputwithjsontype3inpath), `String`    |
|`inQuery` |[`AdvancedOutputWithJSONType3InQuery`](#advancedoutputwithjsontype3inquery), `Number`  |
|`name`    |[`AdvancedOutputWithJSONType3Name`](#advancedoutputwithjsontype3name), `String`        |

### <a id="inquery3"></a>InQuery3
Simple scalar value in query.

|Constraint|Value|
|----------|-----|
|format    |date |

### <a id="advancedinputwithjsontype2"></a>AdvancedInputWithJSONType2

|Property|Type    |
|--------|--------|
|`id`    |`Number`|
|`name`  |`String`|

### <a id="advancedoutputwithjsontype2inquery"></a>AdvancedOutputWithJSONType2InQuery

|Constraint|Value|
|----------|-----|
|format    |date |

### <a id="advancedoutputwithjsontype2"></a>AdvancedOutputWithJSONType2

|Property  |Type                                                                                 |
|----------|-------------------------------------------------------------------------------------|
|`id`      |`Number`                                                                             |
|`inHeader`|`String`                                                                             |
|`inPath`  |`String`                                                                             |
|`inQuery` |[`AdvancedOutputWithJSONType2InQuery`](#advancedoutputwithjsontype2inquery), `String`|
|`name`    |`String`                                                                             |

### <a id="advancedjsonoutputtype2"></a>AdvancedJsonOutputType2

|Property  |Type                        |
|----------|----------------------------|
|`data`    |`Map<String,Number>`, `null`|
|`inHeader`|`String`                    |
|`inQuery` |`Number`                    |

### <a id="advancedjsonpayload"></a>AdvancedJSONPayload

|Property|Type    |
|--------|--------|
|`id`    |`Number`|
|`name`  |`String`|

### <a id="advancedoutputwithjson"></a>AdvancedOutputWithJSON

|Property  |Type    |
|----------|--------|
|`id`      |`Number`|
|`inHeader`|`String`|
|`inPath`  |`String`|
|`inQuery` |`Number`|
|`name`    |`String`|

### <a id="advancedjsonoutput"></a>AdvancedJsonOutput

|Property  |Type                   |
|----------|-----------------------|
|`data`    |`Array<Number>`, `null`|
|`inHeader`|`String`               |
|`inQuery` |`Number`               |

### <a id="resterrresponse"></a>RestErrResponse

|Property |Type           |Description                     |
|---------|---------------|--------------------------------|
|`code`   |`Number`       |Application-specific error code.|
|`context`|`Map<String,*>`|Application context.            |
|`error`  |`String`       |Error message.                  |
|`status` |`String`       |Status text.                    |

### <a id="advancedheaderoutput"></a>AdvancedHeaderOutput

|Property|Type    |
|--------|--------|
|`inBody`|`String`|

### <a id="advancedoutputqueryobject"></a>AdvancedOutputQueryObject

|Property |Type                        |
|---------|----------------------------|
|`inQuery`|`Map<String,Number>`, `null`|

### <a id="xinput"></a>XInput
Request minimum: 10, response maximum: 20.

|Constraint|Value|
|----------|-----|
|minimum   |10   |

### <a id="advancedinputporttype2datavalue"></a>AdvancedInputPortType2DataValue
Request minLength: 3, response maxLength: 7

|Constraint|Value|
|----------|-----|
|minLength |3    |

### <a id="advancedinputporttype2data"></a>AdvancedInputPortType2Data

|Property|Type                                                                           |Description                                 |
|--------|-------------------------------------------------------------------------------|--------------------------------------------|
|`value` |[`AdvancedInputPortType2DataValue`](#advancedinputporttype2datavalue), `String`|Request minLength: 3, response maxLength: 7.|

### <a id="advancedinputporttype2"></a>AdvancedInputPortType2

|Property         |Type                                                       |
|-----------------|-----------------------------------------------------------|
|`data` (required)|[`AdvancedInputPortType2Data`](#advancedinputporttype2data)|

### <a id="xoutput"></a>XOutput

|Constraint|Value|
|----------|-----|
|maximum   |20   |

### <a id="advancedoutputporttype2datavalue"></a>AdvancedOutputPortType2DataValue

|Constraint|Value|
|----------|-----|
|maxLength |7    |

### <a id="advancedoutputporttype2data"></a>AdvancedOutputPortType2Data

|Property|Type                                                                             |
|--------|---------------------------------------------------------------------------------|
|`value` |[`AdvancedOutputPortType2DataValue`](#advancedoutputporttype2datavalue), `String`|

### <a id="advancedoutputporttype2"></a>AdvancedOutputPortType2

|Property         |Type                                                         |
|-----------------|-------------------------------------------------------------|
|`data` (required)|[`AdvancedOutputPortType2Data`](#advancedoutputporttype2data)|
