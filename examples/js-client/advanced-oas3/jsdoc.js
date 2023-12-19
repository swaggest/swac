// Code is generated by github.com/swaggest/swac <version>, DO NOT EDIT. 🤖

/**
 * @typedef ExamplesAdvancedFileMultiUploaderRequest
 * @type {Object}
 * @property {Number} inQuery - Simple scalar value in query.
 * @property {String} simple - Simple scalar value in body.
 * @property {?Array<File|Blob>} uploads1 - Uploads with *multipart.FileHeader.
 * @property {?Array<?File|?Blob>} uploads2 - Uploads with multipart.File.
 */

/**
 * @typedef AdvancedInfoType2
 * @type {Object}
 * @property {?Array<String>} filenames
 * @property {?Array<?Object.<String,Array<String>>>} headers
 * @property {Number} inQuery
 * @property {?Array<String>} peeks1
 * @property {?Array<String>} peeks2
 * @property {String} simple
 * @property {?Array<Number>} sizes
 */

/**
 * @callback AdvancedInfoType2Callback
 * @param {AdvancedInfoType2} value
 */

/**
 * @typedef ExamplesAdvancedFileUploaderRequest
 * @type {Object}
 * @property {Number} inQuery - Simple scalar value in query.
 * @property {String} simple - Simple scalar value in body.
 * @property {File|Blob} upload1
 * @property {?File|?Blob} upload2
 */

/**
 * @typedef AdvancedInfo
 * @type {Object}
 * @property {String} filename
 * @property {?Object.<String,Array<String>>} header
 * @property {Number} inQuery
 * @property {String} peek1
 * @property {String} peek2
 * @property {String} simple
 * @property {Number} size
 */

/**
 * @callback AdvancedInfoCallback
 * @param {AdvancedInfo} value
 */

/**
 * @typedef ExamplesAdvancedDirectGzipRequest
 * @type {Object}
 * @property {Boolean} plainStruct - Output plain structure instead of gzip container.
 * @property {Boolean} countItems - Invokes internal decoding of compressed data.
 */

/**
 * @typedef AdvancedGzipPassThroughStruct
 * @type {Object}
 * @property {Number} id
 * @property {?Array<String>} text
 */

/**
 * @callback AdvancedGzipPassThroughStructCallback
 * @param {AdvancedGzipPassThroughStruct} value
 */

/**
 * @typedef HeadGzipPassThroughRequest
 * @type {Object}
 * @property {Boolean} plainStruct - Output plain structure instead of gzip container.
 * @property {Boolean} countItems - Invokes internal decoding of compressed data.
 */

/**
 * @callback RawCallback
 * @param {XMLHttpRequest} value
 */

/**
 * @typedef AdvancedInputWithJSONType3
 * @type {Object}
 * @property {Number} id
 * @property {String} name
 */

/**
 * @typedef Propertyd41d8cRequest
 * @type {Object}
 * @property {Number} inQuery - Simple scalar value in query.
 * @property {String} inPath - Simple scalar value in path.
 * @property {String} xHeader - Simple scalar value in header.
 * @property {AdvancedInputWithJSONType3} body
 */

/**
 * @typedef AdvancedOutputWithJSONType3
 * @type {Object}
 * @property {Number} id
 * @property {String} inHeader
 * @property {String} inPath
 * @property {Number} inQuery
 * @property {String} name
 */

/**
 * @callback AdvancedOutputWithJSONType3Callback
 * @param {AdvancedOutputWithJSONType3} value
 */

/**
 * @typedef AdvancedInputWithJSONType2
 * @type {Object}
 * @property {Number} id
 * @property {String} name
 */

/**
 * @typedef ExamplesAdvancedJsonBodyRequest
 * @type {Object}
 * @property {String} inQuery - Simple scalar value in query.
 * @property {String} inPath - Simple scalar value in path.
 * @property {String} xHeader - Simple scalar value in header.
 * @property {AdvancedInputWithJSONType2} body
 */

/**
 * @typedef AdvancedOutputWithJSONType2
 * @type {Object}
 * @property {Number} id
 * @property {String} inHeader
 * @property {String} inPath
 * @property {String} inQuery
 * @property {String} name
 */

/**
 * @callback AdvancedOutputWithJSONType2Callback
 * @param {AdvancedOutputWithJSONType2} value
 */

/**
 * @typedef ExamplesAdvancedJsonMapBodyRequest
 * @type {Object}
 * @property {Number} inQuery - Simple scalar value in query.
 * @property {String} xHeader - Simple scalar value in header.
 * @property {?Object.<String,Number>} body
 */

/**
 * @typedef AdvancedJsonOutputType2
 * @type {Object}
 * @property {?Object.<String,Number>} data
 * @property {String} inHeader
 * @property {Number} inQuery
 */

/**
 * @callback AdvancedJsonOutputType2Callback
 * @param {AdvancedJsonOutputType2} value
 */

/**
 * JSON value in query
 * @typedef AdvancedJSONPayload
 * @type {Object}
 * @property {Number} id
 * @property {String} name
 */

/**
 * @typedef ExamplesAdvancedJsonParamRequest
 * @type {Object}
 * @property {Number} inQuery - Simple scalar value in query.
 * @property {AdvancedJSONPayload} identity - JSON value in query.
 * @property {String} inPath - Simple scalar value in path.
 * @property {String} xHeader - Simple scalar value in header.
 */

/**
 * @typedef AdvancedOutputWithJSON
 * @type {Object}
 * @property {Number} id
 * @property {String} inHeader
 * @property {String} inPath
 * @property {Number} inQuery
 * @property {String} name
 */

/**
 * @callback AdvancedOutputWithJSONCallback
 * @param {AdvancedOutputWithJSON} value
 */

/**
 * @typedef ExamplesAdvancedJsonSliceBodyRequest
 * @type {Object}
 * @property {Number} inQuery - Simple scalar value in query.
 * @property {String} xHeader - Simple scalar value in header.
 * @property {?Array<Number>} body
 */

/**
 * @typedef AdvancedJsonOutput
 * @type {Object}
 * @property {?Array<Number>} data
 * @property {String} inHeader
 * @property {Number} inQuery
 */

/**
 * @callback AdvancedJsonOutputCallback
 * @param {AdvancedJsonOutput} value
 */

/**
 * @typedef RestErrResponse
 * @type {Object}
 * @property {Number} code - Application-specific error code.
 * @property {Object.<String,*>} context - Application context.
 * @property {String} error - Error message.
 * @property {String} status - Status text.
 */

/**
 * @callback RestErrResponseCallback
 * @param {RestErrResponse} value
 */

/**
 * @typedef AdvancedHeaderOutput
 * @type {Object}
 * @property {String} inBody
 */

/**
 * @callback AdvancedHeaderOutputCallback
 * @param {AdvancedHeaderOutput} value
 */

/**
 * @typedef ExamplesAdvancedQueryObjectRequest
 * @type {Object}
 * @property {Object.<String,Number>} inQuery - Object value in query.
 */

/**
 * @typedef AdvancedOutputQueryObject
 * @type {Object}
 * @property {?Object.<String,Number>} inQuery
 */

/**
 * @callback AdvancedOutputQueryObjectCallback
 * @param {AdvancedOutputQueryObject} value
 */

/**
 * @typedef ReqRespMappingRequest
 * @type {Object}
 * @property {String} xHeader - Simple scalar value.
 * @property {Number} val2 - Simple scalar value.
 */

/**
 * @typedef AdvancedInputPortType2Data
 * @type {Object}
 * @property {String} value - Request minLength: 3, response maxLength: 7.
 */

/**
 * @typedef AdvancedInputPortType2
 * @type {Object}
 * @property {AdvancedInputPortType2Data} data
 */

/**
 * @typedef ExamplesAdvancedValidationRequest
 * @type {Object}
 * @property {Boolean} q - This parameter will bypass explicit validation as it does not have constraints.
 * @property {Number} xInput - Request minimum: 10, response maximum: 20.
 * @property {AdvancedInputPortType2} body
 */

/**
 * @typedef AdvancedOutputPortType2Data
 * @type {Object}
 * @property {String} value
 */

/**
 * @typedef AdvancedOutputPortType2
 * @type {Object}
 * @property {AdvancedOutputPortType2Data} data
 */

/**
 * @callback AdvancedOutputPortType2Callback
 * @param {AdvancedOutputPortType2} value
 */

