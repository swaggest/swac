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

// DotGraphRequest is operation request value.
type DotGraphRequest struct {
	RootSymbol    *string           // RootSymbol is an optional `rootSymbol` parameter in query.
	// GraphLimit is an optional `graphLimit` parameter in query.
	// Maximum number of nodes (symbols) in graph.
	GraphLimit    *int64
	// GraphPriority is an optional `graphPriority` parameter in query.
	// Graph resource determines nodes selection to expose strongest contributors.
	GraphPriority *GraphResource
	Aggregate     *AggregatorGroup  // Aggregate is an optional `aggregate` parameter in query.
}

// encode creates *http.Request for request data.
func (request *DotGraphRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/profile.dot"

	query := make(url.Values, 4)

	if request.RootSymbol != nil {
		query.Set("rootSymbol", *request.RootSymbol)
	}

	if request.GraphLimit != nil {
		query.Set("graphLimit", strconv.FormatInt(*request.GraphLimit, 10))
	}

	if request.GraphPriority != nil {
		query.Set("graphPriority", string(*request.GraphPriority))
	}

	if j, err := json.Marshal(request.Aggregate); err != nil {
		return nil, fmt.Errorf("failed to marshal request parameter 'aggregate': %w", err)
	} else {
		query.Set("aggregate", string(j))
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

// DotGraphResponse is operation response value.
type DotGraphResponse struct {
	StatusCode    int
	RawBody       []byte            // RawBody contains read bytes of response body.
	ValueOK       []byte            // ValueOK is a value of 200 OK response.
	ValueNotFound *RestErrResponse  // ValueNotFound is a value of 404 Not Found response.
}

// decode loads data from *http.Response.
func (result *DotGraphResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		_, readErr := ioutil.ReadAll(body)
		if readErr != nil {
			err = fmt.Errorf("could not read response body: %w", readErr)
		}

		result.ValueOK = dump.Bytes()
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /profile.dot' NotFound response: %w", err)
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

// DotGraph performs REST operation.
func (c *Client) DotGraph(ctx context.Context, request DotGraphRequest) (result DotGraphResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/profile.dot", &request)
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
