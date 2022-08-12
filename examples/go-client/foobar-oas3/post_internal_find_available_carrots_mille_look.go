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
)

// PostInternalFindAvailableCarrotsMilleLookRequest is operation request value.
type PostInternalFindAvailableCarrotsMilleLookRequest struct {
	// Mille is a required `mille` parameter in path.
	// Acme Mille
	Mille string
	// Look is a required `look` parameter in path.
	// Acme Look
	Look  string
	Body  *UsecaseFindAvailableCarrotsInput  // Body is a JSON request body.
}

// encode creates *http.Request for request data.
func (request *PostInternalFindAvailableCarrotsMilleLookRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/internal/find-available-carrots/" + url.PathEscape(request.Mille) + "/" + url.PathEscape(request.Look)

	body, err := json.Marshal(request.Body)
	if err != nil {
		return nil, err
	}

	req, err := http.NewRequest(http.MethodPost, requestURI, bytes.NewBuffer(body))
	if err != nil {
		return nil, err
	}

	req.Header.Set("Content-Type", "application/json; charset=utf-8")
	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// PostInternalFindAvailableCarrotsMilleLookResponse is operation response value.
type PostInternalFindAvailableCarrotsMilleLookResponse struct {
	StatusCode               int
	RawBody                  []byte                              // RawBody contains read bytes of response body.
	ValueOK                  *UsecaseFindAvailableCarrotsOutput  // ValueOK is a value of 200 OK response.
	ValueBadRequest          *RestErrResponse                    // ValueBadRequest is a value of 400 Bad Request response.
	ValueInternalServerError *RestErrResponse                    // ValueInternalServerError is a value of 500 Internal Server Error response.
}

// decode loads data from *http.Response.
func (result *PostInternalFindAvailableCarrotsMilleLookResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /internal/find-available-carrots/{mille}/{look}' OK response: %w", err)
		}
	case http.StatusBadRequest:
		err = json.NewDecoder(body).Decode(&result.ValueBadRequest)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /internal/find-available-carrots/{mille}/{look}' BadRequest response: %w", err)
		}
	case http.StatusInternalServerError:
		err = json.NewDecoder(body).Decode(&result.ValueInternalServerError)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /internal/find-available-carrots/{mille}/{look}' InternalServerError response: %w", err)
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

// PostInternalFindAvailableCarrotsMilleLook performs REST operation.
func (c *Client) PostInternalFindAvailableCarrotsMilleLook(ctx context.Context, request PostInternalFindAvailableCarrotsMilleLookRequest) (result PostInternalFindAvailableCarrotsMilleLookResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodPost, "/internal/find-available-carrots/{mille}/{look}", &request)
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
