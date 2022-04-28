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

// GetSystemsSystemUUIDPoolsRequest is operation request value.
type GetSystemsSystemUUIDPoolsRequest struct {
	SystemUUID string  // SystemUUID is a required `SystemUUID` parameter in path.
	// Limit is an optional `limit` parameter in query.
	// max number of results you want
	Limit      *int64
	// Offset is an optional `offset` parameter in query.
	// index from which you want next items
	Offset     *int64
}

// encode creates *http.Request for request data.
func (request *GetSystemsSystemUUIDPoolsRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/systems/" + url.PathEscape(request.SystemUUID) + "/pools"

	query := make(url.Values, 2)

	if request.Limit != nil {
		query.Set("limit", strconv.FormatInt(*request.Limit, 10))
	}

	if request.Offset != nil {
		query.Set("offset", strconv.FormatInt(*request.Offset, 10))
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

// GetSystemsSystemUUIDPoolsResponse is operation response value.
type GetSystemsSystemUUIDPoolsResponse struct {
	StatusCode               int
	RawBody                  []byte                                           // RawBody contains read bytes of response body.
	ValueOK                  *PoolsListMock                                   // ValueOK is a value of 200 OK response.
	ValueBadRequest          *GetAllocationsResponseValueBadRequest           // ValueBadRequest is a value of 400 Bad Request response.
	ValueUnauthorized        *GetAllocationsResponseValueUnauthorized         // ValueUnauthorized is a value of 401 Unauthorized response.
	ValueForbidden           *GetAllocationsResponseValueForbidden            // ValueForbidden is a value of 403 Forbidden response.
	ValueNotFound            *GetAllocationsResponseValueNotFound             // ValueNotFound is a value of 404 Not Found response.
	ValueInternalServerError *GetAllocationsResponseValueInternalServerError  // ValueInternalServerError is a value of 500 Internal Server Error response.
}

// decode loads data from *http.Response.
func (result *GetSystemsSystemUUIDPoolsResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /systems/{SystemUUID}/pools' OK response: %w", err)
		}
	case http.StatusBadRequest:
		err = json.NewDecoder(body).Decode(&result.ValueBadRequest)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /systems/{SystemUUID}/pools' BadRequest response: %w", err)
		}
	case http.StatusUnauthorized:
		err = json.NewDecoder(body).Decode(&result.ValueUnauthorized)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /systems/{SystemUUID}/pools' Unauthorized response: %w", err)
		}
	case http.StatusForbidden:
		err = json.NewDecoder(body).Decode(&result.ValueForbidden)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /systems/{SystemUUID}/pools' Forbidden response: %w", err)
		}
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /systems/{SystemUUID}/pools' NotFound response: %w", err)
		}
	case http.StatusInternalServerError:
		err = json.NewDecoder(body).Decode(&result.ValueInternalServerError)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /systems/{SystemUUID}/pools' InternalServerError response: %w", err)
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

// GetSystemsSystemUUIDPools performs REST operation.
func (c *Client) GetSystemsSystemUUIDPools(ctx context.Context, request GetSystemsSystemUUIDPoolsRequest) (result GetSystemsSystemUUIDPoolsResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/systems/{SystemUUID}/pools", &request)
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
