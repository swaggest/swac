// Code is generated by github.com/swaggest/swac <version>, do not edit. 🤖

/**
 * @constructor
 * @param {string} baseURL - Base URL.
 */
function APIClient(baseURL) {
    // Trim trailing backslash.
    this.baseURL = (baseURL.charAt(baseURL.length - 1) === '/') ? baseURL.slice(0, -1) : baseURL;
}

/**
 * @param {DeletePlacesRequest} req
 * @param {RawCallback} onNoContent
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.deletePlaces = function (req, onNoContent, onBadRequest, onNotFound, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 204:
                if (typeof(onNoContent) == 'function') {
                    onNoContent(x);
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/places?';
    if (req.id != null) {
        url += 'id=' + encodeURIComponent(req.id) + '&'
    }
    url = url.slice(0, -1)

    x.open("DELETE", url, true);
    
    
    x.send();
}

/**
 * @param {GetPlacesRequest} req
 * @param {PlaceEntityCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.getPlaces = function (req, onOK, onBadRequest, onNotFound, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/places?';
    if (req.mille != null) {
        url += 'mille=' + encodeURIComponent(req.mille) + '&'
    }
    if (req.foxUuid != null) {
        url += 'foxUuid=' + encodeURIComponent(req.foxUuid) + '&'
    }
    if (req.foxId != null) {
        url += 'foxId=' + encodeURIComponent(req.foxId) + '&'
    }
    if (req.look != null) {
        url += 'look=' + encodeURIComponent(req.look) + '&'
    }
    if (req.potatoFamily != null) {
        url += 'potatoFamily=' + encodeURIComponent(req.potatoFamily) + '&'
    }
    url = url.slice(0, -1)

    x.open("GET", url, true);
    
    
    x.send();
}

/**
 * @param {PostPlacesRequest} req
 * @param {PlaceEntityCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onConflict
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.postPlaces = function (req, onOK, onBadRequest, onConflict, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 409:
                if (typeof(onConflict) == 'function') {
                    onConflict(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/places?';
    url = url.slice(0, -1)

    x.open("POST", url, true);
    if (typeof req.body !== 'undefined') {
        x.setRequestHeader("Content-Type", "application/json; charset=utf-8");
        x.send(JSON.stringify(req.body))
        return
    }

    
    x.send();
}

/**
 * @param {DeleteFoosRequest} req
 * @param {RawCallback} onNoContent
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.deleteFoos = function (req, onNoContent, onBadRequest, onNotFound, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 204:
                if (typeof(onNoContent) == 'function') {
                    onNoContent(x);
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/foos?';
    if (req.id != null) {
        url += 'id=' + encodeURIComponent(req.id) + '&'
    }
    url = url.slice(0, -1)

    x.open("DELETE", url, true);
    
    
    x.send();
}

/**
 * @param {GetFoosRequest} req
 * @param {ArrayUsecaseFooInfoCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.getFoos = function (req, onOK, onBadRequest, onNotFound, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/foos?';
    if (req.look != null) {
        url += 'look=' + encodeURIComponent(req.look) + '&'
    }
    if (req.potatoFamily != null) {
        url += 'potatoFamily=' + encodeURIComponent(req.potatoFamily) + '&'
    }
    if (req.mille != null) {
        url += 'mille=' + encodeURIComponent(req.mille) + '&'
    }
    url = url.slice(0, -1)

    x.open("GET", url, true);
    
    
    x.send();
}

/**
 * @param {PostFoosRequest} req
 * @param {FooEntityCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onConflict
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.postFoos = function (req, onOK, onBadRequest, onConflict, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 409:
                if (typeof(onConflict) == 'function') {
                    onConflict(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/foos?';
    url = url.slice(0, -1)

    x.open("POST", url, true);
    if (typeof req.body !== 'undefined') {
        x.setRequestHeader("Content-Type", "application/json; charset=utf-8");
        x.send(JSON.stringify(req.body))
        return
    }

    
    x.send();
}

/**
 * @param {PutFoosRequest} req
 * @param {RawCallback} onNoContent
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onConflict
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.putFoos = function (req, onNoContent, onBadRequest, onNotFound, onConflict, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 204:
                if (typeof(onNoContent) == 'function') {
                    onNoContent(x);
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 409:
                if (typeof(onConflict) == 'function') {
                    onConflict(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/foos?';
    if (req.id != null) {
        url += 'id=' + encodeURIComponent(req.id) + '&'
    }
    url = url.slice(0, -1)

    x.open("PUT", url, true);
    if (typeof req.body !== 'undefined') {
        x.setRequestHeader("Content-Type", "application/json; charset=utf-8");
        x.send(JSON.stringify(req.body))
        return
    }

    
    x.send();
}

/**
 * @param {PostInternalFindAvailableCarrotsMilleLookRequest} req
 * @param {UsecaseFindAvailableCarrotsOutputCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.postInternalFindAvailableCarrotsMilleLook = function (req, onOK, onBadRequest, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/internal/find-available-carrots/' + encodeURIComponent(req.mille) +
    '/' + encodeURIComponent(req.look) +
    '?';
    url = url.slice(0, -1)

    x.open("POST", url, true);
    if (typeof req.body !== 'undefined') {
        x.setRequestHeader("Content-Type", "application/json; charset=utf-8");
        x.send(JSON.stringify(req.body))
        return
    }

    
    x.send();
}

/**
 * @param {GetLieAreasRequest} req
 * @param {ArrayStringCallback} onOK
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.getLieAreas = function (req, onOK, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/lie-areas?';
    if (req.mille != null) {
        url += 'mille=' + encodeURIComponent(req.mille) + '&'
    }
    url = url.slice(0, -1)

    x.open("GET", url, true);
    
    
    x.send();
}

/**
 * @param {PostLieAreasRequest} req
 * @param {LieAreaEntityCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onConflict
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.postLieAreas = function (req, onOK, onBadRequest, onConflict, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 409:
                if (typeof(onConflict) == 'function') {
                    onConflict(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/lie-areas?';
    url = url.slice(0, -1)

    x.open("POST", url, true);
    if (typeof req.body !== 'undefined') {
        x.setRequestHeader("Content-Type", "application/json; charset=utf-8");
        x.send(JSON.stringify(req.body))
        return
    }

    
    x.send();
}

/**
 * @param {PutLieAreasMilleLieAreaSyncRequest} req
 * @param {RawCallback} onNoContent
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.putLieAreasMilleLieAreaSync = function (req, onNoContent, onBadRequest, onNotFound, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 204:
                if (typeof(onNoContent) == 'function') {
                    onNoContent(x);
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/lie-areas/' + encodeURIComponent(req.mille) +
    '/' + encodeURIComponent(req.lieArea) +
    '/sync?';
    if (req.look != null) {
        url += 'look=' + encodeURIComponent(req.look) + '&'
    }
    url = url.slice(0, -1)

    x.open("PUT", url, true);
    
    
    x.send();
}

/**
 * @param {GetLiesRequest} req
 * @param {LiesPageCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.getLies = function (req, onOK, onBadRequest, onNotFound, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/lies?';
    if (req.mille != null) {
        url += 'mille=' + encodeURIComponent(req.mille) + '&'
    }
    if (req.exclude != null) {
        url += 'exclude=' + encodeURIComponent(req.exclude) + '&'
    }
    if (req.locale != null) {
        url += 'locale=' + encodeURIComponent(req.locale) + '&'
    }
    if (req.potato != null) {
        url += 'potato=' + encodeURIComponent(req.potato) + '&'
    }
    if (req.hole != null) {
        url += 'hole=' + encodeURIComponent(req.hole) + '&'
    }
    if (req.potatoSku != null) {
        url += 'potatoSku=' + encodeURIComponent(req.potatoSku) + '&'
    }
    if (req.soup != null) {
        url += 'soup=' + encodeURIComponent(req.soup) + '&'
    }
    if (req.look != null) {
        url += 'look=' + encodeURIComponent(req.look) + '&'
    }
    if (req.looks != null) {
        url += 'looks=' + encodeURIComponent(req.looks) + '&'
    }
    if (req.isActive != null) {
        url += 'isActive=' + encodeURIComponent(req.isActive) + '&'
    }
    if (req.potatoSkuQuery != null) {
        url += 'potatoSkuQuery=' + encodeURIComponent(req.potatoSkuQuery) + '&'
    }
    if (req.withCompleteSoups != null) {
        url += 'withCompleteSoups=' + encodeURIComponent(req.withCompleteSoups) + '&'
    }
    if (req.sort != null) {
        url += 'sort=' + encodeURIComponent(req.sort) + '&'
    }
    if (req.take != null) {
        url += 'take=' + encodeURIComponent(req.take) + '&'
    }
    if (req.skip != null) {
        url += 'skip=' + encodeURIComponent(req.skip) + '&'
    }
    url = url.slice(0, -1)

    x.open("GET", url, true);
    
    
    x.send();
}

/**
 * @param {GetLiesIdRequest} req
 * @param {LiesLieCallback} onOK
 * @param {RestErrResponseCallback} onBadRequest
 * @param {RestErrResponseCallback} onNotFound
 * @param {RestErrResponseCallback} onInternalServerError
 */
APIClient.prototype.getLiesId = function (req, onOK, onBadRequest, onNotFound, onInternalServerError) {
    var x = new XMLHttpRequest();
    x.onreadystatechange = function () {
        if (x.readyState !== XMLHttpRequest.DONE) {
            return
        }
    
        switch (x.status) {
            case 200:
                if (typeof(onOK) == 'function') {
                    onOK(JSON.parse(x.responseText));
                }
                break;
            case 400:
                if (typeof(onBadRequest) == 'function') {
                    onBadRequest(JSON.parse(x.responseText));
                }
                break;
            case 404:
                if (typeof(onNotFound) == 'function') {
                    onNotFound(JSON.parse(x.responseText));
                }
                break;
            case 500:
                if (typeof(onInternalServerError) == 'function') {
                    onInternalServerError(JSON.parse(x.responseText));
                }
                break;
            default:
                throw {err: 'unexpected response', data: x}
        }
    };
    
    var url = this.baseURL + '/lies/' + encodeURIComponent(req.id) +
    '?';
    if (req.locale != null) {
        url += 'locale=' + encodeURIComponent(req.locale) + '&'
    }
    if (req.hole != null) {
        url += 'hole=' + encodeURIComponent(req.hole) + '&'
    }
    url = url.slice(0, -1)

    x.open("GET", url, true);
    
    
    x.send();
}

