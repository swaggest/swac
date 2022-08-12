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
)

// DeleteCloudAccessProvidersProviderShortNameAccountsRequest is operation request value.
type DeleteCloudAccessProvidersProviderShortNameAccountsRequest struct {
	ProviderShortName string                                                           // ProviderShortName is a required `ProviderShortName` parameter in path.
	Account           *DeleteCloudAccessProvidersProviderShortNameAccountsRequestBody  // Account is a JSON request body.
}

// encode creates *http.Request for request data.
func (request *DeleteCloudAccessProvidersProviderShortNameAccountsRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/cloud_access_providers/" + url.PathEscape(request.ProviderShortName) + "/accounts"

	body, err := json.Marshal(request.Account)
	if err != nil {
		return nil, err
	}

	req, err := http.NewRequest(http.MethodDelete, requestURI, bytes.NewBuffer(body))
	if err != nil {
		return nil, err
	}

	req.Header.Set("Content-Type", "application/json")
	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// DeleteCloudAccessProvidersProviderShortNameAccountsResponse is operation response value.
type DeleteCloudAccessProvidersProviderShortNameAccountsResponse struct {
	StatusCode               int
	RawBody                  []byte                                           // RawBody contains read bytes of response body.
	ValueBadRequest          *GetAllocationsResponseValueBadRequest           // ValueBadRequest is a value of 400 Bad Request response.
	ValueUnauthorized        *GetAllocationsResponseValueUnauthorized         // ValueUnauthorized is a value of 401 Unauthorized response.
	ValueForbidden           *GetAllocationsResponseValueForbidden            // ValueForbidden is a value of 403 Forbidden response.
	ValueNotFound            *GetAllocationsResponseValueNotFound             // ValueNotFound is a value of 404 Not Found response.
	ValueInternalServerError *GetAllocationsResponseValueInternalServerError  // ValueInternalServerError is a value of 500 Internal Server Error response.
}

// decode loads data from *http.Response.
func (result *DeleteCloudAccessProvidersProviderShortNameAccountsResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusNoContent:
		// No body to decode.
	case http.StatusBadRequest:
		err = json.NewDecoder(body).Decode(&result.ValueBadRequest)
		if err != nil {
			err = fmt.Errorf("failed to decode 'delete /cloud_access_providers/{ProviderShortName}/accounts' BadRequest response: %w", err)
		}
	case http.StatusUnauthorized:
		err = json.NewDecoder(body).Decode(&result.ValueUnauthorized)
		if err != nil {
			err = fmt.Errorf("failed to decode 'delete /cloud_access_providers/{ProviderShortName}/accounts' Unauthorized response: %w", err)
		}
	case http.StatusForbidden:
		err = json.NewDecoder(body).Decode(&result.ValueForbidden)
		if err != nil {
			err = fmt.Errorf("failed to decode 'delete /cloud_access_providers/{ProviderShortName}/accounts' Forbidden response: %w", err)
		}
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
		if err != nil {
			err = fmt.Errorf("failed to decode 'delete /cloud_access_providers/{ProviderShortName}/accounts' NotFound response: %w", err)
		}
	case http.StatusInternalServerError:
		err = json.NewDecoder(body).Decode(&result.ValueInternalServerError)
		if err != nil {
			err = fmt.Errorf("failed to decode 'delete /cloud_access_providers/{ProviderShortName}/accounts' InternalServerError response: %w", err)
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

// DeleteCloudAccessProvidersProviderShortNameAccounts performs REST operation.
func (c *Client) DeleteCloudAccessProvidersProviderShortNameAccounts(ctx context.Context, request DeleteCloudAccessProvidersProviderShortNameAccountsRequest) (result DeleteCloudAccessProvidersProviderShortNameAccountsResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodDelete, "/cloud_access_providers/{ProviderShortName}/accounts", &request)
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