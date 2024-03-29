// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package rhsm

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

// GetAllocationsRequest is operation request value.
type GetAllocationsRequest struct {
	// Limit is an optional `limit` parameter in query.
	// max number of results you want
	Limit  *int64
	// Offset is an optional `offset` parameter in query.
	// index from which you want next items
	Offset *int64
	Type   *GetAllocationsRequestQueryType  // Type is an optional `type` parameter in query.
}

// encode creates *http.Request for request data.
func (request *GetAllocationsRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/allocations"

	query := make(url.Values, 3)

	if request.Limit != nil {
		query.Set("limit", strconv.FormatInt(*request.Limit, 10))
	}

	if request.Offset != nil {
		query.Set("offset", strconv.FormatInt(*request.Offset, 10))
	}

	if request.Type != nil {
		query.Set("type", string(*request.Type))
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

// GetAllocationsResponse is operation response value.
type GetAllocationsResponse struct {
	StatusCode               int
	RawBody                  []byte                                           // RawBody contains read bytes of response body.
	ValueOK                  *GetAllocationsResponseValueOK                   // ValueOK is a value of 200 OK response.
	ValueBadRequest          *GetAllocationsResponseValueBadRequest           // ValueBadRequest is a value of 400 Bad Request response.
	ValueUnauthorized        *GetAllocationsResponseValueUnauthorized         // ValueUnauthorized is a value of 401 Unauthorized response.
	ValueForbidden           *GetAllocationsResponseValueForbidden            // ValueForbidden is a value of 403 Forbidden response.
	ValueNotFound            *GetAllocationsResponseValueNotFound             // ValueNotFound is a value of 404 Not Found response.
	ValueInternalServerError *GetAllocationsResponseValueInternalServerError  // ValueInternalServerError is a value of 500 Internal Server Error response.
}

// decode loads data from *http.Response.
func (result *GetAllocationsResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /allocations' OK response: %w", err)
		}
	case http.StatusBadRequest:
		err = json.NewDecoder(body).Decode(&result.ValueBadRequest)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /allocations' BadRequest response: %w", err)
		}
	case http.StatusUnauthorized:
		err = json.NewDecoder(body).Decode(&result.ValueUnauthorized)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /allocations' Unauthorized response: %w", err)
		}
	case http.StatusForbidden:
		err = json.NewDecoder(body).Decode(&result.ValueForbidden)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /allocations' Forbidden response: %w", err)
		}
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /allocations' NotFound response: %w", err)
		}
	case http.StatusInternalServerError:
		err = json.NewDecoder(body).Decode(&result.ValueInternalServerError)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /allocations' InternalServerError response: %w", err)
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

// GetAllocations performs REST operation.
func (c *Client) GetAllocations(ctx context.Context, request GetAllocationsRequest) (result GetAllocationsResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/allocations", &request)
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

	transport := c.transport
	if c.securityBearerTransport != nil {
		transport = c.securityBearerTransport
	}

	resp, err := transport.RoundTrip(req)
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
