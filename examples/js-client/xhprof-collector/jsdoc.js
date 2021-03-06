// Code is generated by github.com/swaggest/swac <version>, DO NOT EDIT. 🤖

/**
 * @typedef XhAggregatorAddress
 * @type {Object}
 * @property {Number} end - Interval end UTC unix timestamp. .
 * @property {String} id - Profile ID.
 * @property {?Object.<String,String>} labels
 * @property {Number} start - Interval start UTC unix timestamp.
 */

/**
 * @typedef XhUsecaseProfileInfo
 * @type {Object}
 * @property {XhAggregatorAddress} addr
 * @property {String} cpu
 * @property {Number} edges
 * @property {String} io
 * @property {String} peakMem
 * @property {Number} profiles
 * @property {String} wt
 */

/**
 * @typedef XhUsecaseProfiles
 * @type {Object}
 * @property {?Array<XhUsecaseProfileInfo>} activeAggregates
 * @property {?Array<XhUsecaseProfileInfo>} recent
 */

/**
 * @callback XhUsecaseProfilesCallback
 * @param {XhUsecaseProfiles} value
 */

/**
 * @typedef XhProfileValue
 * @type {Object}
 * @property {Number} as - Aggregation size, count of parent profiles.
 * @property {Number} cpu - CPU time in microseconds.
 * @property {Number} ct - Count of calls.
 * @property {Number} io - IO time in microseconds.
 * @property {Number} mem.aa - The amount of allocated memory.
 * @property {Number} mem.na - The sum of the number of all allocations in this function.
 * @property {Number} mem.nf - The sum of the number of all frees in this function.
 * @property {Number} mu - Memory usage in bytes.
 * @property {Number} pmu - Peak memory usage in bytes.
 * @property {Number} wt - Wall time in microseconds.
 */

/**
 * @typedef XhUsecaseCollectProfileInput
 * @type {Object}
 * @property {String} id - Random string created by client to identify profile.
 * @property {?Object.<String,String>} labels
 * @property {?Object.<String,*>} meta - Additional context.
 * @property {?Object.<String,XhProfileValue>} profile
 */

/**
 * @typedef XhPostProfileRequest
 * @type {Object}
 * @property {Number} probability - Probability that was asserted to collect this profile, used to estimate total multiplication.
 * @property {String} tz - Timezone location for daily aggregations, default: UTC.
 * @property {XhUsecaseCollectProfileInput} body
 */

/**
 * @callback RawCallback
 * @param {XMLHttpRequest} value
 */

/**
 * @typedef XhGetProfileDotRequest
 * @type {Object}
 * @property {String} rootSymbol
 * @property {Number} graphLimit - Maximum number of nodes (symbols) in graph.
 * @property {('wt'|'cpu'|'io')} graphPriority - Graph resource determines nodes selection to expose strongest contributors.
 * @property {XhAggregatorAddress} aggregate
 */

/**
 * @typedef XhRestErrResponse
 * @type {Object}
 * @property {Number} code - Application-specific error code.
 * @property {Object.<String,*>} context - Application context.
 * @property {String} error - Error message.
 * @property {String} status - Status text.
 */

/**
 * @callback XhRestErrResponseCallback
 * @param {XhRestErrResponse} value
 */

/**
 * @typedef XhGetProfileFindSymbolRequest
 * @type {Object}
 * @property {XhAggregatorAddress} aggregate
 * @property {String} match - Substring to match in symbol.
 * @property {Number} limit - Limit number of results.
 */

/**
 * @typedef XhUsecaseSearchOutput
 * @type {Object}
 * @property {?Array<String>} symbols
 */

/**
 * @callback XhUsecaseSearchOutputCallback
 * @param {XhUsecaseSearchOutput} value
 */

/**
 * @typedef XhGetProfileSymbolRequest
 * @type {Object}
 * @property {XhAggregatorAddress} aggregate
 * @property {String} symbol
 */

/**
 * @typedef XhRenderValueStat
 * @type {Object}
 * @property {String} as
 * @property {String} cpu
 * @property {String} cpuf
 * @property {String} ct
 * @property {String} ctf
 * @property {String} io
 * @property {String} iof
 * @property {String} ma
 * @property {String} mac
 * @property {String} mf
 * @property {String} mu
 * @property {String} pmu
 * @property {String} wt
 * @property {String} wtf
 */

/**
 * @typedef XhUsecaseSymbolStatOutput
 * @type {Object}
 * @property {Object.<String,XhRenderValueStat>} callees - Callees stat.
 * @property {Object.<String,XhRenderValueStat>} callers - Callers stat.
 * @property {XhRenderValueStat} exclusive
 * @property {XhRenderValueStat} inclusive
 */

/**
 * @callback XhUsecaseSymbolStatOutputCallback
 * @param {XhUsecaseSymbolStatOutput} value
 */

/**
 * @typedef XhGetTopTracesRequest
 * @type {Object}
 * @property {String} rootSymbol
 * @property {XhAggregatorAddress} aggregate
 * @property {('wt'|'cpu'|'io')} resource - Graph resource determines nodes selection to expose strongest contributors.
 * @property {Number} limit
 */

/**
 * @typedef XhUsecaseTraceInfo
 * @type {Object}
 * @property {String} hash
 * @property {XhRenderValueStat} stat
 * @property {String} symbol
 * @property {?Array<String>} trace
 */

/**
 * @callback ArrayXhUsecaseTraceInfoCallback
 * @param {Array<XhUsecaseTraceInfo>} value
 */

/**
 * @typedef XhPostUploadProfileRequest
 * @type {Object}
 * @property {Number} prob - Probability that was asserted to collect this profile, used to estimate total multiplication.
 * @property {?Array<File|Blob>} profile - File with profile JSON data.
 */

