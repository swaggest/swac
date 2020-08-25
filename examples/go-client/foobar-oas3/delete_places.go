// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package foobar

import (
	"bytes"
	"context"
	"encoding/json"
	"errors"
	"io"
	"io/ioutil"
	"net/http"
	"net/url"
	"strconv"
)

// DeletePlacesRequest is operation request value.
type DeletePlacesRequest struct {
	ID int64  // ID is a required `id` parameter in query.
}

// encode creates *http.Request for request data.
func (request *DeletePlacesRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/places"

	query := make(url.Values, 1)
	query.Set("id", strconv.FormatInt(request.ID, 10))

	if len(query) > 0 {
		requestURI += "?" + query.Encode()
	}

	req, err := http.NewRequest(http.MethodDelete, requestURI, nil)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// DeletePlacesResponse is operation response value.
type DeletePlacesResponse struct {
	StatusCode               int
	ValueBadRequest          *RestErrResponse  // ValueBadRequest is a value of 400 Bad Request response.
	ValueNotFound            *RestErrResponse  // ValueNotFound is a value of 404 Not Found response.
	ValueInternalServerError *RestErrResponse  // ValueInternalServerError is a value of 500 Internal Server Error response.
}

// decode loads data from *http.Response.
func (result *DeletePlacesResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusNoContent:
		// No body to decode.
	case http.StatusBadRequest:
		err = json.NewDecoder(body).Decode(&result.ValueBadRequest)
	case http.StatusNotFound:
		err = json.NewDecoder(body).Decode(&result.ValueNotFound)
	case http.StatusInternalServerError:
		err = json.NewDecoder(body).Decode(&result.ValueInternalServerError)
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

// DeletePlaces performs REST operation.
func (c *Client) DeletePlaces(ctx context.Context, request DeletePlacesRequest) (result DeletePlacesResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodDelete, "/places", &request)
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