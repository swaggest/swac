// Code generated by github.com/swaggest/swac v0.1.8, DO NOT EDIT.

package petstore

import (
	"bytes"
	"context"
	"errors"
	"io"
	"io/ioutil"
	"net/http"
	"net/url"
	"strconv"
)

// DeletePetsIDRequest is operation request value.
type DeletePetsIDRequest struct {
	// ID is a required `id` parameter in path.
	// ID of pet to delete
	ID int64
}

// encode creates *http.Request for request data.
func (request *DeletePetsIDRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/pets/" + url.PathEscape(strconv.FormatInt(request.ID, 10))

	req, err := http.NewRequest(http.MethodDelete, requestURI, nil)
	if err != nil {
		return nil, err
	}

	req = req.WithContext(ctx)

	return req, err
}

// DeletePetsIDResponse is operation response value.
type DeletePetsIDResponse struct {
	StatusCode int
}

// decode loads data from *http.Response.
func (result *DeletePetsIDResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusNoContent:
		// No body to decode.
	default:
		_, readErr := ioutil.ReadAll(body)
		if readErr != nil {
			err = errors.New("unexpected response status: " + resp.Status +
				", could not read response body: " + readErr.Error())
		} else {
			err = errors.New("unexpected response status: " + resp.Status)
		}
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

// DeletePetsID performs REST operation.
func (c *Client) DeletePetsID(ctx context.Context, request DeletePetsIDRequest) (result DeletePetsIDResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodDelete, "/pets/{id}", &request)
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
