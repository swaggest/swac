// Code is generated by github.com/swaggest/swac <version>, DO NOT EDIT. 🤖

(function(){
    "use strict";
    
    /**
     * XHPROF Exporter
     * @constructor
     * @param {string} baseURL - Base URL.
     */
    function Backend(baseURL) {
        // Trim trailing backslash.
        this.baseURL = (baseURL.charAt(baseURL.length - 1) === '/') ? baseURL.slice(0, -1) : baseURL;
        /** @type {?PrepareRequest} - Callback to prepare request before sending. */
        this.prepareRequest = null;
    }

    /**
     * @callback PrepareRequest
     * @param {XMLHttpRequest} value
     */

    /**
     * List Profiles
     * @param {Object} req - request parameters.
     * @param {XhUsecaseProfilesCallback} onOK
     */
    Backend.prototype.listProfiles = function (req, onOK) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }
        
            switch (x.status) {
                case 200:
                    if (typeof(onOK) === 'function') {
                        onOK(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };
        
        var url = this.baseURL + '/profile?';
        url = url.slice(0, -1);

        x.open("GET", url, true);
        if (typeof(this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        
        x.send();
    };

    /**
     * Collect Profile
     * Collects XHPROF-compatible PHP profile.
     * @param {XhPostProfileRequest} req - request parameters.
     * @param {RawCallback} onAccepted
     */
    Backend.prototype.postProfile = function (req, onAccepted) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }
        
            switch (x.status) {
                case 202:
                    if (typeof(onAccepted) === 'function') {
                        onAccepted(x);
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };
        
        var url = this.baseURL + '/profile?';
        if (req.probability != null) {
            url += 'probability=' + encodeURIComponent(req.probability) + '&';
        }
        if (req.tz != null) {
            url += 'tz=' + encodeURIComponent(req.tz) + '&';
        }
        url = url.slice(0, -1);

        x.open("POST", url, true);
        if (typeof(this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        if (typeof req.body !== 'undefined') {
            x.setRequestHeader("Content-Type", "application/json; charset=utf-8");
            x.send(JSON.stringify(req.body));
            return;
        }

        x.send();
    };

    /**
     * Dot Graph
     * @param {XhGetProfileDotRequest} req - request parameters.
     * @param {RawCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.getProfileDot = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }
        
            switch (x.status) {
                case 200:
                    if (typeof(onOK) === 'function') {
                        onOK(x);
                    }
                    break;
                case 404:
                    if (typeof(onNotFound) === 'function') {
                        onNotFound(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };
        
        var url = this.baseURL + '/profile.dot?';
        if (req.rootSymbol != null) {
            url += 'rootSymbol=' + encodeURIComponent(req.rootSymbol) + '&';
        }
        if (req.graphLimit != null) {
            url += 'graphLimit=' + encodeURIComponent(req.graphLimit) + '&';
        }
        if (req.graphPriority != null) {
            url += 'graphPriority=' + encodeURIComponent(req.graphPriority) + '&';
        }
        if (req.aggregate != null) {
            url += 'aggregate=' + encodeURIComponent(JSON.stringify(req.aggregate)) + '&';
        }
        url = url.slice(0, -1);

        x.open("GET", url, true);
        if (typeof(this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        
        x.send();
    };

    /**
     * Find Symbol
     * @param {XhGetProfileFindSymbolRequest} req - request parameters.
     * @param {XhUsecaseSearchOutputCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.getProfileFindSymbol = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }
        
            switch (x.status) {
                case 200:
                    if (typeof(onOK) === 'function') {
                        onOK(JSON.parse(x.responseText));
                    }
                    break;
                case 404:
                    if (typeof(onNotFound) === 'function') {
                        onNotFound(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };
        
        var url = this.baseURL + '/profile/find-symbol?';
        if (req.aggregate != null) {
            url += 'aggregate=' + encodeURIComponent(JSON.stringify(req.aggregate)) + '&';
        }
        if (req.match != null) {
            url += 'match=' + encodeURIComponent(req.match) + '&';
        }
        if (req.limit != null) {
            url += 'limit=' + encodeURIComponent(req.limit) + '&';
        }
        url = url.slice(0, -1);

        x.open("GET", url, true);
        if (typeof(this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        
        x.send();
    };

    /**
     * Symbol Stat
     * @param {XhGetProfileSymbolRequest} req - request parameters.
     * @param {XhUsecaseSymbolStatOutputCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.getProfileSymbol = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }
        
            switch (x.status) {
                case 200:
                    if (typeof(onOK) === 'function') {
                        onOK(JSON.parse(x.responseText));
                    }
                    break;
                case 404:
                    if (typeof(onNotFound) === 'function') {
                        onNotFound(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };
        
        var url = this.baseURL + '/profile/symbol?';
        if (req.aggregate != null) {
            url += 'aggregate=' + encodeURIComponent(JSON.stringify(req.aggregate)) + '&';
        }
        if (req.symbol != null) {
            url += 'symbol=' + encodeURIComponent(req.symbol) + '&';
        }
        url = url.slice(0, -1);

        x.open("GET", url, true);
        if (typeof(this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        
        x.send();
    };

    /**
     * Top Traces
     * Get traces that occupy most of resource.
     * @param {XhGetTopTracesRequest} req - request parameters.
     * @param {ArrayXhUsecaseTraceInfoCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.getTopTraces = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }
        
            switch (x.status) {
                case 200:
                    if (typeof(onOK) === 'function') {
                        onOK(JSON.parse(x.responseText));
                    }
                    break;
                case 404:
                    if (typeof(onNotFound) === 'function') {
                        onNotFound(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };
        
        var url = this.baseURL + '/top-traces?';
        if (req.rootSymbol != null) {
            url += 'rootSymbol=' + encodeURIComponent(req.rootSymbol) + '&';
        }
        if (req.aggregate != null) {
            url += 'aggregate=' + encodeURIComponent(JSON.stringify(req.aggregate)) + '&';
        }
        if (req.resource != null) {
            url += 'resource=' + encodeURIComponent(req.resource) + '&';
        }
        if (req.limit != null) {
            url += 'limit=' + encodeURIComponent(req.limit) + '&';
        }
        url = url.slice(0, -1);

        x.open("GET", url, true);
        if (typeof(this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        
        x.send();
    };

    /**
     * Upload Profile
     * Collects XHPROF-compatible PHP profile from uploaded JSON file.
     * @param {XhPostUploadProfileRequest} req - request parameters.
     * @param {RawCallback} onAccepted
     */
    Backend.prototype.postUploadProfile = function (req, onAccepted) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }
        
            switch (x.status) {
                case 202:
                    if (typeof(onAccepted) === 'function') {
                        onAccepted(x);
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };
        
        var url = this.baseURL + '/upload/profile?';
        if (req.prob != null) {
            url += 'prob=' + encodeURIComponent(req.prob) + '&';
        }
        url = url.slice(0, -1);

        x.open("POST", url, true);
        if (typeof(this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        var formData = new FormData();
        if (typeof req.profile !== 'undefined') {
            for (var i = 0; i < req.profile.length; i++) {
                formData.append('profile', req.profile[i]);
            }
        }

        x.send(formData);
    };

    
    window.Backend = Backend;
})();