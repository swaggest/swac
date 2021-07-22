<!-- Code is generated by github.com/swaggest/swac <version>, DO NOT EDIT. 🤖 -->

# XHPROF Exporter

[Schema](./openapi.json).

## Table Of Contents

* [Operations](#operations)
  - [GET `/profile`](#listprofiles) 
  - [POST `/profile`](#postprofile) 
  - [GET `/profile.dot`](#getprofiledot) 
  - [GET `/profile/find-symbol`](#getprofilefindsymbol) 
  - [GET `/profile/symbol`](#getprofilesymbol) 
  - [GET `/top-traces`](#gettoptraces) 
  - [POST `/upload/profile`](#postuploadprofile) 
* [Types](#types)

## <a id="operations"></a>Operations

### <a id="listprofiles"></a>GET `/profile`
List Profiles

#### Response

|Status|Content Type      |Body Type                                |Description|
|------|------------------|-----------------------------------------|-----------|
|200   |`application/json`|[`XhUsecaseProfiles`](#xhusecaseprofiles)|OK         |
### <a id="postprofile"></a>POST `/profile`
Collect Profile

Collects XHPROF-compatible PHP profile.

#### Parameters

|Name         |In   |Type                                                           |Description                                                                                  |
|-------------|-----|---------------------------------------------------------------|---------------------------------------------------------------------------------------------|
|`probability`|query|[`XhProbability`](#xhprobability), `Number`                    |Probability that was asserted to collect this profile, used to estimate total multiplication.|
|`tz`         |query|`String`                                                       |Timezone location for daily aggregations, default: UTC.                                      |
|`body`       |body |[`XhUsecaseCollectProfileInput`](#xhusecasecollectprofileinput)|                                                                                             |

#### Response

|Status|Description|
|------|-----------|
|202   |Accepted   |
### <a id="getprofiledot"></a>GET `/profile.dot`
Dot Graph

#### Parameters

|Name           |In   |Type                                         |Description                                |Examples                 |
|---------------|-----|---------------------------------------------|-------------------------------------------|-------------------------|
|`rootSymbol`   |query|`String`                                     |                                           |`MyNamespace\MyClass::do`|
|`graphLimit`   |query|`Number`                                     |Maximum number of nodes (symbols) in graph.|                         |
|`graphPriority`|query|`'wt'`, `'cpu'`, `'io'`                      |                                           |                         |
|`aggregate`    |query|[`XhAggregatorAddress`](#xhaggregatoraddress)|                                           |                         |

#### Response

|Status|Content Type       |Body Type                                                            |Description|
|------|-------------------|---------------------------------------------------------------------|-----------|
|200   |`text/vnd.graphviz`|[`XhGetProfileDotResponse200`](#xhgetprofiledotresponse200), `String`|OK         |
|404   |`application/json` |[`XhRestErrResponse`](#xhresterrresponse)                            |Not Found  |
### <a id="getprofilefindsymbol"></a>GET `/profile/find-symbol`
Find Symbol

#### Parameters

|Name       |In   |Type                                         |Description                  |
|-----------|-----|---------------------------------------------|-----------------------------|
|`aggregate`|query|[`XhAggregatorAddress`](#xhaggregatoraddress)|                             |
|`match`    |query|`String`                                     |Substring to match in symbol.|
|`limit`    |query|`Number`                                     |Limit number of results.     |

#### Response

|Status|Content Type      |Body Type                                        |Description|
|------|------------------|-------------------------------------------------|-----------|
|200   |`application/json`|[`XhUsecaseSearchOutput`](#xhusecasesearchoutput)|OK         |
|404   |`application/json`|[`XhRestErrResponse`](#xhresterrresponse)        |Not Found  |
### <a id="getprofilesymbol"></a>GET `/profile/symbol`
Symbol Stat

#### Parameters

|Name       |In   |Type                                         |Examples                 |
|-----------|-----|---------------------------------------------|-------------------------|
|`aggregate`|query|[`XhAggregatorAddress`](#xhaggregatoraddress)|                         |
|`symbol`   |query|`String`                                     |`MyNamespace\MyClass::do`|

#### Response

|Status|Content Type      |Body Type                                                |Description|
|------|------------------|---------------------------------------------------------|-----------|
|200   |`application/json`|[`XhUsecaseSymbolStatOutput`](#xhusecasesymbolstatoutput)|OK         |
|404   |`application/json`|[`XhRestErrResponse`](#xhresterrresponse)                |Not Found  |
### <a id="gettoptraces"></a>GET `/top-traces`
Top Traces

Get traces that occupy most of resource.

#### Parameters

|Name        |In   |Type                                         |Examples                 |
|------------|-----|---------------------------------------------|-------------------------|
|`rootSymbol`|query|`String`                                     |`MyNamespace\MyClass::do`|
|`aggregate` |query|[`XhAggregatorAddress`](#xhaggregatoraddress)|                         |
|`resource`  |query|`'wt'`, `'cpu'`, `'io'`                      |                         |
|`limit`     |query|`Number`                                     |`50`                     |

#### Response

|Status|Content Type      |Body Type                                             |Description|
|------|------------------|------------------------------------------------------|-----------|
|200   |`application/json`|`Array<`[`XhUsecaseTraceInfo`](#xhusecasetraceinfo)`>`|OK         |
|404   |`application/json`|[`XhRestErrResponse`](#xhresterrresponse)             |Not Found  |
### <a id="postuploadprofile"></a>POST `/upload/profile`
Upload Profile

Collects XHPROF-compatible PHP profile from uploaded JSON file.

#### Parameters

|Name     |In      |Type                                                                                        |Description                                                                                  |
|---------|--------|--------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------|
|`prob`   |query   |[`XhProb`](#xhprob), `Number`                                                               |Probability that was asserted to collect this profile, used to estimate total multiplication.|
|`profile`|formData|`Array<`[`XhFormDataMultipartFileHeader`](#xhformdatamultipartfileheader), `String>`, `null`|                                                                                             |

#### Response

|Status|Description|
|------|-----------|
|202   |Accepted   |

## <a id="types"></a> Types

### <a id="xhaggregatoraddress"></a>XhAggregatorAddress

|Property|Type                        |Description                       |
|--------|----------------------------|----------------------------------|
|`end`   |`Number`                    |Interval end UTC unix timestamp. .|
|`id`    |`String`                    |Profile ID.                       |
|`labels`|`Map<String,String>`, `null`|                                  |
|`start` |`Number`                    |Interval start UTC unix timestamp.|

### <a id="xhusecaseprofileinfo"></a>XhUsecaseProfileInfo

|Property  |Type                                         |
|----------|---------------------------------------------|
|`addr`    |[`XhAggregatorAddress`](#xhaggregatoraddress)|
|`cpu`     |`String`                                     |
|`edges`   |`Number`                                     |
|`io`      |`String`                                     |
|`peakMem` |`String`                                     |
|`profiles`|`Number`                                     |
|`wt`      |`String`                                     |

### <a id="xhusecaseprofiles"></a>XhUsecaseProfiles

|Property          |Type                                                              |
|------------------|------------------------------------------------------------------|
|`activeAggregates`|`Array<`[`XhUsecaseProfileInfo`](#xhusecaseprofileinfo)`>`, `null`|
|`recent`          |`Array<`[`XhUsecaseProfileInfo`](#xhusecaseprofileinfo)`>`, `null`|

### <a id="xhprobability"></a>XhProbability
Probability that was asserted to collect this profile, used to estimate total multiplication.

|Constraint|Value|
|----------|-----|
|maximum   |1    |
|minimum   |0    |

### <a id="xhprofilevalue"></a>XhProfileValue

|Property|Type    |Description                                               |
|--------|--------|----------------------------------------------------------|
|`as`    |`Number`|Aggregation size, count of parent profiles.               |
|`cpu`   |`Number`|CPU time in microseconds.                                 |
|`ct`    |`Number`|Count of calls.                                           |
|`io`    |`Number`|IO time in microseconds.                                  |
|`mem.aa`|`Number`|The amount of allocated memory.                           |
|`mem.na`|`Number`|The sum of the number of all allocations in this function.|
|`mem.nf`|`Number`|The sum of the number of all frees in this function.      |
|`mu`    |`Number`|Memory usage in bytes.                                    |
|`pmu`   |`Number`|Peak memory usage in bytes.                               |
|`wt`    |`Number`|Wall time in microseconds.                                |

### <a id="xhusecasecollectprofileinput"></a>XhUsecaseCollectProfileInput

|Property |Type                                                       |Description                                         |
|---------|-----------------------------------------------------------|----------------------------------------------------|
|`id`     |`String`                                                   |Random string created by client to identify profile.|
|`labels` |`Map<String,String>`, `null`                               |                                                    |
|`meta`   |`Map<String,*>`, `null`                                    |Additional context.                                 |
|`profile`|`Map<String,`[`XhProfileValue`](#xhprofilevalue)`>`, `null`|                                                    |

### <a id="xhgetprofiledotresponse200"></a>XhGetProfileDotResponse200

|Constraint|Value |
|----------|------|
|format    |binary|

### <a id="xhresterrresponse"></a>XhRestErrResponse

|Property |Type           |Description                     |
|---------|---------------|--------------------------------|
|`code`   |`Number`       |Application-specific error code.|
|`context`|`Map<String,*>`|Application context.            |
|`error`  |`String`       |Error message.                  |
|`status` |`String`       |Status text.                    |

### <a id="xhusecasesearchoutput"></a>XhUsecaseSearchOutput

|Property |Type                   |
|---------|-----------------------|
|`symbols`|`Array<String>`, `null`|

### <a id="xhrendervaluestat"></a>XhRenderValueStat

|Property|Type    |
|--------|--------|
|`as`    |`String`|
|`cpu`   |`String`|
|`cpuf`  |`String`|
|`ct`    |`String`|
|`ctf`   |`String`|
|`io`    |`String`|
|`iof`   |`String`|
|`ma`    |`String`|
|`mac`   |`String`|
|`mf`    |`String`|
|`mu`    |`String`|
|`pmu`   |`String`|
|`wt`    |`String`|
|`wtf`   |`String`|

### <a id="xhusecasesymbolstatoutput"></a>XhUsecaseSymbolStatOutput

|Property   |Type                                                     |Description  |
|-----------|---------------------------------------------------------|-------------|
|`callees`  |`Map<String,`[`XhRenderValueStat`](#xhrendervaluestat)`>`|Callees stat.|
|`callers`  |`Map<String,`[`XhRenderValueStat`](#xhrendervaluestat)`>`|Callers stat.|
|`exclusive`|[`XhRenderValueStat`](#xhrendervaluestat)                |             |
|`inclusive`|[`XhRenderValueStat`](#xhrendervaluestat)                |             |

### <a id="xhusecasetraceinfo"></a>XhUsecaseTraceInfo

|Property|Type                                     |
|--------|-----------------------------------------|
|`hash`  |`String`                                 |
|`stat`  |[`XhRenderValueStat`](#xhrendervaluestat)|
|`symbol`|`String`                                 |
|`trace` |`Array<String>`, `null`                  |

### <a id="xhprob"></a>XhProb
Probability that was asserted to collect this profile, used to estimate total multiplication.

|Constraint|Value|
|----------|-----|
|maximum   |1    |
|minimum   |0    |

### <a id="xhformdatamultipartfileheader"></a>XhFormDataMultipartFileHeader

|Constraint|Value |
|----------|------|
|format    |binary|
