// https://gist.github.com/remarkablemark/fa62af0a2c57f5ef54226cae2258b38d

/**
 * @typedef getTopTracesReq
 * @type {object}
 * @property {string} rootSymbol - name of the root symbol, default 'main()'.
 * @property {int} limit - Maximum number of traces, default 5.
 * @property {("wt"|"io"|"cpu")} resource - graph ordering, allowed values: wt, io, cpu, default 'wt'.
 * @property {string} aggregate - aggregate identifier (JSON encoded object).
 */

/**
 * This callback type is called `getSymbolOK` and is displayed as a global symbol.
 *
 * @callback getTopTracesOK
 * @param {array<UsecaseTopTracesOutputItem>} traces
 */

/**
 * @typedef UsecaseTopTracesOutputItem
 * @type {object}
 * @property {array<string>} trace - call trace.
 * @property {string} hash - call trace hashed.
 * @property {string} symbol - name of traced function.
 */

/**
 * This callback type is called `getSymbolNotFound` and is displayed as a global symbol.
 *
 * @callback onNotFound
 * @param {notFoundErr} stat
 */

/**
 * @typedef notFoundErr
 * @type {object}
 * @property {string} error - the message.
 */


/**
 * Shape class.
 *
 * @constructor
 * @param {String} id - The id.
 * @param {Number} x  - The x coordinate.
 * @param {Number} y  - The y coordinate.
 */
function FooClient(id, x, y) {
    this.id = id;
    this.setLocation(x, y);
}


/**
 * Does something asynchronously and executes the callback on completion.
 * @param {getTopTracesReq} req
 * @param {getTopTracesOK} onOK - The callback that handles the response.
 * @param {onNotFound} onNotFound - The callback that handles the response.
 */
FooClient.prototype.postSomething = function (req, onOK, onNotFound) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState != XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
            return
        }

        switch (xmlhttp.status) {
            case 200:
                onOK(JSON.parse(xmlhttp.responseText));
                break;
            case 404:
                onNotFound(JSON.parse(xmlhttp.responseText));
                break;
            default:
                throw {err: 'unexpected response', data: xmlhttp}
        }
    };

    var url = "/top-traces?rootSymbol=" + encodeURIComponent(req.rootSymbol) +
        '&limit=' + encodeURIComponent(req.limit) +
        '&resource=' + encodeURIComponent(req.resource) +
        '&aggregate=' + encodeURIComponent(req.aggregate);

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/json; charset=utf-8");

    var body = JSON.stringify({foo: "bar"})
    xmlhttp.send(body);
}

c = new FooClient("3", 1, 2)
c.postSomething(
    {
        aggregate: "a",
        limit: 4,
        rootSymbol: "o",
        resource: "wt"
    },
    function (traces) {

    },
    null,
)