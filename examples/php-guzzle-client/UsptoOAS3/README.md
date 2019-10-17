# API

### metadata

* [`GET /`](#get) List available data sets
* [`GET /{dataset}/{version}/fields`](#getfields) Provides the general information about the API and the list of fields that

### search

* [`POST /{dataset}/{version}/records`](#postrecords) Provides search capability for the data set with the given search criteria.



## Operations

### `Get`



_Endpoint_: `/`

_Namespace_: `Swac\Example\UsptoOAS3\Metadata\Operation`

#### Request
Type: `Swac\Example\UsptoOAS3\Metadata\Request\GetRequest`




#### Response


|Status|Type                                                                |Description                |
|------|--------------------------------------------------------------------|---------------------------|
|200 OK|[`DataSetList`](#swacexampleusptooas3metadatadefinitionsdatasetlist)|Returns a list of data sets|

### `GetFields`

This GET API returns the list of all the searchable field names that are in
the oa_citations. Please see the 'fields' attribute which returns an array
of field names. Each field or a combination of fields can be searched using
the syntax options shown below.

_Endpoint_: `/{dataset}/{version}/fields`

_Namespace_: `Swac\Example\UsptoOAS3\Metadata\Operation`

#### Request
Type: `Swac\Example\UsptoOAS3\Metadata\Request\GetFieldsRequest`

|Name     |Type    |In    |Description            |
|---------|--------|------|-----------------------|
|`dataset`|`string`|`path`|Name of the dataset.   |
|`version`|`string`|`path`|Version of the dataset.|





#### Response


|Status       |Type                                                                                                                     |Description                                                                                                                |
|-------------|-------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------|
|200 OK       |[`GetDatasetVersionFieldsOKResponse`](#swacexampleusptooas3metadataresponsegetdatasetversionfieldsokresponse)            |The dataset API for the given version is found and it is accessible to consume.                                            |
|404 Not Found|[`GetDatasetVersionFieldsNotFoundResponse`](#swacexampleusptooas3metadataresponsegetdatasetversionfieldsnotfoundresponse)|The combination of dataset name and version is not found in the system or it is not published yet to be consumed by public.|

### `PostRecords`

This API is based on Solr/Lucense Search. The data is indexed using SOLR.
This GET API returns the list of all the searchable field names that are in
the Solr Index. Please see the 'fields' attribute which returns an array of
field names. Each field or a combination of fields can be searched using
the Solr/Lucene Syntax. Please refer
https://lucene.apache.org/core/3_6_2/queryparsersyntax.html#Overview for
the query syntax. List of field names that are searchable can be determined
using above GET api.

_Endpoint_: `/{dataset}/{version}/records`

_Namespace_: `Swac\Example\UsptoOAS3\Search\Operation`

#### Request
Type: `Swac\Example\UsptoOAS3\Search\Request\PostRecordsRequest`

|Name     |Type    |In    |Description                                                         |
|---------|--------|------|--------------------------------------------------------------------|
|`version`|`string`|`path`|Version of the dataset.                                             |
|`dataset`|`string`|`path`|Name of the dataset. In this case, the default value is oa_citations|





#### Response


|Status       |Type                                                                                                           |Description                                     |
|-------------|---------------------------------------------------------------------------------------------------------------|------------------------------------------------|
|200 OK       |[`PostDatasetVersionRecordsOKResponse`](#swacexampleusptooas3searchresponsepostdatasetversionrecordsokresponse)|successful operation                            |
|404 Not Found|                                                                                                               |No matching record found for the given criteria.|



## Structures

#### Swac\Example\UsptoOAS3\Metadata\Definitions\DataSetList
|Name   |Type                                                                                                 |
|-------|-----------------------------------------------------------------------------------------------------|
|`total`|`int`                                                                                                |
|`apis` |[`DataSetListApisItems`](#swacexampleusptooas3metadatadefinitionsdatasetlistapisitems)[]&#124;`array`|

#### Swac\Example\UsptoOAS3\Metadata\Definitions\DataSetListApisItems
|Name                 |Type    |Description                            |
|---------------------|--------|---------------------------------------|
|`apiKey`             |`string`|To be used as a dataset parameter value|
|`apiVersionNumber`   |`string`|To be used as a version parameter value|
|`apiUrl`             |`string`|The URL describing the dataset's fields|
|`apiDocumentationUrl`|`string`|A URL to the API console for each API  |

#### Swac\Example\UsptoOAS3\Metadata\Response\GetDatasetVersionFieldsNotFoundResponse
`string`
#### Swac\Example\UsptoOAS3\Metadata\Response\GetDatasetVersionFieldsOKResponse
`string`
#### Swac\Example\UsptoOAS3\Search\Response\PostDatasetVersionRecordsOKResponse
`mixed`[][]&#124;`array`

