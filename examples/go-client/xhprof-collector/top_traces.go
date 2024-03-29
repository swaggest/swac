// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package foobar

import (
	"bytes"
	"context"
	"encoding/json"
	"errors"
	"fmt"
	"io"
	"io/ioutil"
	"net/http"
	"net/url"
	"strconv"
)

// TopTracesRequest is operation request value.
type TopTracesRequest struct {
	RootSymbol *string           // RootSymbol is an optional `rootSymbol` parameter in query.
	Aggregate  *AggregatorGroup  // Aggregate is an optional `aggregate` parameter in query.
	// Resource is an optional `resource` parameter in query.
	// Graph resource determines nodes selection to expose strongest contributors.
	Resource   *GraphResource
	Limit      *int64            // Limit is an optional `limit` parameter in query.
}

// encode creates *http.Request for request data.
func (request *TopTracesRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/top-traces"

	query := make(url.Values, 4)

	if request.RootSymbol != nil {
		query.Set("rootSymbol", *request.RootSymbol)
	}

	if j, err := json.Marshal(request.Aggregate); err != nil {
		return nil, fmt.Errorf("failed to marshal request parameter 'aggregate': %w", err)
	} else {
		query.Set("aggregate", string(j))
	}

	if request.Resource != nil {
		query.Set("resource", string(*request.Resource))
	}

	if request.Limit != nil {
		query.Set("limit", strconv.FormatInt(*request.Limit, 10))
	}

	if len(query) > 0 {
		requestURI += "?" + query.Encode()
	}

	req, err := http.NewRequest(http.MethodGet, requestURI, nil)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// TopTracesResponse is operation response value.
type TopTracesResponse struct {
	StatusCode    int
	RawBody       []byte            // RawBody contains read bytes of response body.
	ValueOK       []TraceInfo       // ValueOK is a value of 200 OK response.
	ValueNotFound *RestErrResponse  // ValueNotFound is a value of 404 Not Found response.
}

// decode loads data from *http.Response.
func (result *TopTracesResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /top-traces' OK response: %w", err)
		}
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /top-traces' NotFound response: %w", err)
		}
	default:
		_, readErr := ioutil.ReadAll(body)
		if readErr != nil {
			err = errors.New("unexpected response status: " + resp.Status +
				", could not read response body: " + readErr.Error())
		} else {
			err = errors.New("unexpected response status: " + resp.Status)
		}
	}

	result.RawBody = dump.Bytes()

	if err != nil {
		return responseError{
			resp: resp,
			body: dump.Bytes(),
			err:  err,
		}
	}

	return nil
}

// TopTraces performs REST operation.
func (c *Client) TopTraces(ctx context.Context, request TopTracesRequest) (result TopTracesResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/top-traces", &request)
	}

	if c.Timeout != 0 {
		var cancel func()
		ctx, cancel = context.WithTimeout(ctx, c.Timeout)

		defer cancel()
	}

	req, err := request.encode(ctx, c.BaseURL)
	if err != nil {
		return result, err
	}

	resp, err := c.transport.RoundTrip(req)

	if err != nil {
		return result, err
	}

	defer func() {
		closeErr := resp.Body.Close()
		if closeErr != nil && err == nil {
			err = closeErr
		}
	}()

	err = result.decode(resp)

	return result, err
}
