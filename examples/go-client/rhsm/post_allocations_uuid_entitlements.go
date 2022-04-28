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

// PostAllocationsUuidEntitlementsRequest is operation request value.
type PostAllocationsUuidEntitlementsRequest struct {
	Pool     string  // Pool is a required `pool` parameter in query.
	// Quantity is an optional `quantity` parameter in query.
	// quantity you want to attach
	Quantity *int64
	Uuid     string  // Uuid is a required `uuid` parameter in path.
}

// encode creates *http.Request for request data.
func (request *PostAllocationsUuidEntitlementsRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/allocations/" + url.PathEscape(request.Uuid) + "/entitlements"

	query := make(url.Values, 2)
	query.Set("pool", request.Pool)

	if request.Quantity != nil {
		query.Set("quantity", strconv.FormatInt(*request.Quantity, 10))
	}

	if len(query) > 0 {
		requestURI += "?" + query.Encode()
	}

	req, err := http.NewRequest(http.MethodPost, requestURI, nil)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Content-Type", "application/json")
	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// PostAllocationsUuidEntitlementsResponse is operation response value.
type PostAllocationsUuidEntitlementsResponse struct {
	StatusCode               int
	RawBody                  []byte                                           // RawBody contains read bytes of response body.
	ValueOK                  *PostAllocationsUuidEntitlementsResponseValueOK  // ValueOK is a value of 200 OK response.
	ValueBadRequest          *GetAllocationsResponseValueBadRequest           // ValueBadRequest is a value of 400 Bad Request response.
	ValueUnauthorized        *GetAllocationsResponseValueUnauthorized         // ValueUnauthorized is a value of 401 Unauthorized response.
	ValueForbidden           *GetAllocationsResponseValueForbidden            // ValueForbidden is a value of 403 Forbidden response.
	ValueNotFound            *GetAllocationsResponseValueNotFound             // ValueNotFound is a value of 404 Not Found response.
	ValueInternalServerError *GetAllocationsResponseValueInternalServerError  // ValueInternalServerError is a value of 500 Internal Server Error response.
}

// decode loads data from *http.Response.
func (result *PostAllocationsUuidEntitlementsResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /allocations/{uuid}/entitlements' OK response: %w", err)
		}
	case http.StatusBadRequest:
		err = json.NewDecoder(body).Decode(&result.ValueBadRequest)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /allocations/{uuid}/entitlements' BadRequest response: %w", err)
		}
	case http.StatusUnauthorized:
		err = json.NewDecoder(body).Decode(&result.ValueUnauthorized)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /allocations/{uuid}/entitlements' Unauthorized response: %w", err)
		}
	case http.StatusForbidden:
		err = json.NewDecoder(body).Decode(&result.ValueForbidden)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /allocations/{uuid}/entitlements' Forbidden response: %w", err)
		}
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /allocations/{uuid}/entitlements' NotFound response: %w", err)
		}
	case http.StatusInternalServerError:
		err = json.NewDecoder(body).Decode(&result.ValueInternalServerError)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /allocations/{uuid}/entitlements' InternalServerError response: %w", err)
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

// PostAllocationsUuidEntitlements performs REST operation.
func (c *Client) PostAllocationsUuidEntitlements(ctx context.Context, request PostAllocationsUuidEntitlementsRequest) (result PostAllocationsUuidEntitlementsResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodPost, "/allocations/{uuid}/entitlements", &request)
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
