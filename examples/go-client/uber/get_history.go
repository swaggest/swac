// Code generated by github.com/swaggest/swac v0.1.5, DO NOT EDIT.

package uber

import (
	"bytes"
	"context"
	"encoding/json"
	"io"
	"net/http"
	"net/url"
	"strconv"
)

// GetHistoryRequest is operation request value.
type GetHistoryRequest struct {
	// Offset is an optional `offset` parameter in query.
	// Offset the list of returned results by this amount. Default is zero.
	Offset *int64
	// Limit is an optional `limit` parameter in query.
	// Number of items to retrieve. Default is 5, maximum is 100.
	Limit  *int64
}

// encode creates *http.Request for request data.
func (request *GetHistoryRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/history"

	query := make(url.Values, 2)

	if request.Offset != nil {
		query.Set("offset", strconv.FormatInt(*request.Offset, 10))
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

// GetHistoryResponse is operation response value.
type GetHistoryResponse struct {
	StatusCode int
	ValueOK    *Activities  // ValueOK is a value of 200 OK response.
	Default    *Error       // Default is a default value of response.
}

// decode loads data from *http.Response.
func (result *GetHistoryResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
	default:
		err = json.NewDecoder(resp.Body).Decode(&result.Default)
	}

	if err != nil {
		return responseError{
			resp: resp,
			body: dump.Bytes(),
			err:  err,
		}
	}

	return nil
}

// GetHistory performs REST operation.
func (c *Client) GetHistory(ctx context.Context, request GetHistoryRequest) (result GetHistoryResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/history", &request)
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
