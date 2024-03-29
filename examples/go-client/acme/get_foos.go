// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package acme

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

// GetFoosRequest is operation request value.
type GetFoosRequest struct {
	// Postcode is a required `postcode` parameter in query.
	// Filter Foos by postcode
	Postcode       string
	// ActivityOption is an optional `activity_option` parameter in query.
	// Filter Foos by activity option
	ActivityOption *string
	// ActivityDay is an optional `activity_day` parameter in query.
	// Filter Foos by activity day (priority over activity_option)
	ActivityDay    *int64
	// Project is a required `project` parameter in query.
	// Which project is the request coming from
	Project        string
	Country        string   // Country is a required `country` parameter in query.
}

// encode creates *http.Request for request data.
func (request *GetFoosRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/Foos"

	query := make(url.Values, 5)
	query.Set("postcode", request.Postcode)

	if request.ActivityOption != nil {
		query.Set("activity_option", *request.ActivityOption)
	}

	if request.ActivityDay != nil {
		query.Set("activity_day", strconv.FormatInt(*request.ActivityDay, 10))
	}

	query.Set("project", request.Project)

	query.Set("country", request.Country)

	if len(query) > 0 {
		requestURI += "?" + query.Encode()
	}

	req, err := http.NewRequest(http.MethodGet, requestURI, nil)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Accept", "application/vnd.acme.v1+json")

	req = req.WithContext(ctx)

	return req, err
}

// GetFoosResponse is operation response value.
type GetFoosResponse struct {
	StatusCode int
	RawBody    []byte  // RawBody contains read bytes of response body.
	ValueOK    *Foo    // ValueOK is a value of 200 OK response.
}

// decode loads data from *http.Response.
func (result *GetFoosResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /Foos' OK response: %w", err)
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

// GetFoos performs REST operation.
func (c *Client) GetFoos(ctx context.Context, request GetFoosRequest) (result GetFoosResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/Foos", &request)
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
