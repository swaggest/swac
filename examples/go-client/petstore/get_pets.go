// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package petstore

import (
	"bytes"
	"context"
	"encoding/json"
	"io"
	"net/http"
	"net/url"
	"strconv"
	"strings"
)

// GetPetsRequest is operation request value.
type GetPetsRequest struct {
	// Tags is an optional `tags` parameter in query.
	// tags to filter by
	Tags  []string
	// Limit is an optional `limit` parameter in query.
	// maximum number of results to return
	Limit *int64
}

// encode creates *http.Request for request data.
func (request *GetPetsRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/pets"

	query := make(url.Values, 2)

	if request.Tags != nil {
		query.Set("tags", strings.Join(request.Tags, ","))
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

	req.Header.Set("Content-Type", "application/json")
	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// GetPetsResponse is operation response value.
type GetPetsResponse struct {
	StatusCode int
	ValueOK    []Pet   // ValueOK is a value of 200 OK response.
	Default    *Error  // Default is a default value of response.
}

// decode loads data from *http.Response.
func (result *GetPetsResponse) decode(resp *http.Response) error {
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

// GetPets performs REST operation.
func (c *Client) GetPets(ctx context.Context, request GetPetsRequest) (result GetPetsResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/pets", &request)
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
