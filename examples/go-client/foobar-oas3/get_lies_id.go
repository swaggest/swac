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

// GetLiesIDRequest is operation request value.
type GetLiesIDRequest struct {
	Locale *string  // Locale is an optional `locale` parameter in query.
	Hole   *int64   // Hole is an optional `hole` parameter in query.
	ID     string   // ID is a required `id` parameter in path.
}

// encode creates *http.Request for request data.
func (request *GetLiesIDRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/lies/" + url.PathEscape(request.ID)

	query := make(url.Values, 2)

	if request.Locale != nil {
		query.Set("locale", *request.Locale)
	}

	if request.Hole != nil {
		query.Set("hole", strconv.FormatInt(*request.Hole, 10))
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

// GetLiesIDResponse is operation response value.
type GetLiesIDResponse struct {
	StatusCode               int
	RawBody                  []byte            // RawBody contains read bytes of response body.
	ValueOK                  *LiesLie          // ValueOK is a value of 200 OK response.
	ValueBadRequest          *RestErrResponse  // ValueBadRequest is a value of 400 Bad Request response.
	ValueNotFound            *RestErrResponse  // ValueNotFound is a value of 404 Not Found response.
	ValueInternalServerError *RestErrResponse  // ValueInternalServerError is a value of 500 Internal Server Error response.
}

// decode loads data from *http.Response.
func (result *GetLiesIDResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /lies/{id}' OK response: %w", err)
		}
	case http.StatusBadRequest:
		err = json.NewDecoder(body).Decode(&result.ValueBadRequest)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /lies/{id}' BadRequest response: %w", err)
		}
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /lies/{id}' NotFound response: %w", err)
		}
	case http.StatusInternalServerError:
		err = json.NewDecoder(body).Decode(&result.ValueInternalServerError)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /lies/{id}' InternalServerError response: %w", err)
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

// GetLiesID performs REST operation.
func (c *Client) GetLiesID(ctx context.Context, request GetLiesIDRequest) (result GetLiesIDResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/lies/{id}", &request)
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
	if c.securityJWTTransport != nil {
		transport = c.securityJWTTransport
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
