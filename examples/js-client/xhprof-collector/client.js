// Code is generated by github.com/swaggest/swac <version>, DO NOT EDIT. 🤖

(function () {
    "use strict";

    /**
     * PHPerf XHPROF Aggregator
     * Version: cli-mode
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
     * @param {XhProfilesCallback} onOK
     */
    Backend.prototype.listProfiles = function (req, onOK) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 200:
                    if (typeof (onOK) === 'function') {
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
        if (typeof (this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }

        x.send();
    };

    /**
     * Collect Profile
     * Collects XHPROF-compatible PHP profile.
     * @param {XhCollectProfileRequest} req - request parameters.
     * @param {RawCallback} onAccepted
     * @param {XhRestErrResponseCallback} onConflict
     */
    Backend.prototype.collectProfile = function (req, onAccepted, onConflict) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 202:
                    if (typeof (onAccepted) === 'function') {
                        onAccepted(x);
                    }
                    break;
                case 409:
                    if (typeof (onConflict) === 'function') {
                        onConflict(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };

        var url = this.baseURL + '/profile?';
        url = url.slice(0, -1);

        x.open("POST", url, true);
        if (typeof (this.prepareRequest) === 'function') {
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
     * @param {XhDotGraphRequest} req - request parameters.
     * @param {RawCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.dotGraph = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 200:
                    if (typeof (onOK) === 'function') {
                        onOK(x);
                    }
                    break;
                case 404:
                    if (typeof (onNotFound) === 'function') {
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
        if (typeof (this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }

        x.send();
    };

    /**
     * Find Symbol
     * @param {XhFindSymbolRequest} req - request parameters.
     * @param {XhSearchOutputCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.findSymbol = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 200:
                    if (typeof (onOK) === 'function') {
                        onOK(JSON.parse(x.responseText));
                    }
                    break;
                case 404:
                    if (typeof (onNotFound) === 'function') {
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
        if (typeof (this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }

        x.send();
    };

    /**
     * Symbol Stat
     * @param {XhSymbolStatRequest} req - request parameters.
     * @param {XhSymbolStatOutputCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.symbolStat = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 200:
                    if (typeof (onOK) === 'function') {
                        onOK(JSON.parse(x.responseText));
                    }
                    break;
                case 404:
                    if (typeof (onNotFound) === 'function') {
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
        if (typeof (this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }

        x.send();
    };

    /**
     * Top Traces
     * Get traces that occupy most of resource.
     * @param {XhTopTracesRequest} req - request parameters.
     * @param {ArrayXhTraceInfoCallback} onOK
     * @param {XhRestErrResponseCallback} onNotFound
     */
    Backend.prototype.topTraces = function (req, onOK, onNotFound) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 200:
                    if (typeof (onOK) === 'function') {
                        onOK(JSON.parse(x.responseText));
                    }
                    break;
                case 404:
                    if (typeof (onNotFound) === 'function') {
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
        if (typeof (this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }

        x.send();
    };

    /**
     * Upload Profile
     * Collects XHPROF-compatible PHP profile from uploaded JSON/PHP-Serialized
     * file.
     * @param {XhUploadProfileRequest} req - request parameters.
     * @param {RawCallback} onAccepted
     * @param {XhRestErrResponseCallback} onConflict
     */
    Backend.prototype.uploadProfile = function (req, onAccepted, onConflict) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 202:
                    if (typeof (onAccepted) === 'function') {
                        onAccepted(x);
                    }
                    break;
                case 409:
                    if (typeof (onConflict) === 'function') {
                        onConflict(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };

        var url = this.baseURL + '/upload/profile?';
        url = url.slice(0, -1);

        x.open("POST", url, true);
        if (typeof (this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        var formData = new FormData();
        if (typeof req.profile !== 'undefined') {
            formData.append('profile', req.profile);
        }
        if (typeof req.sample !== 'undefined') {
            formData.append('sample', req.sample);
        }

        x.send(formData);
    };

    /**
     * Upload Profiles
     * Collects XHPROF-compatible PHP profiles from uploaded JSON/PHP-Serialized
     * files.
     * @param {XhUploadProfilesRequest} req - request parameters.
     * @param {RawCallback} onAccepted
     * @param {XhRestErrResponseCallback} onConflict
     */
    Backend.prototype.uploadProfiles = function (req, onAccepted, onConflict) {
        var x = new XMLHttpRequest();
        x.onreadystatechange = function () {
            if (x.readyState !== XMLHttpRequest.DONE) {
                return;
            }

            switch (x.status) {
                case 202:
                    if (typeof (onAccepted) === 'function') {
                        onAccepted(x);
                    }
                    break;
                case 409:
                    if (typeof (onConflict) === 'function') {
                        onConflict(JSON.parse(x.responseText));
                    }
                    break;
                default:
                    throw {err: 'unexpected response', data: x};
            }
        };

        var url = this.baseURL + '/upload/profiles?';
        url = url.slice(0, -1);

        x.open("POST", url, true);
        if (typeof (this.prepareRequest) === 'function') {
            this.prepareRequest(x);
        }
        var formData = new FormData();
        if (typeof req.profiles !== 'undefined') {
            for (var i = 0; i < req.profiles.length; i++) {
                formData.append('profile', req.profiles[i]);
            }
        }

        x.send(formData);
    };

    window.Backend = Backend;
})();