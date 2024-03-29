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
	"strconv"
)

// UploadProfileRequest is operation request value.
type UploadProfileRequest struct {
	Profile    UploadFile  // Profile is an optional `profile` parameter in formData.
	Sample     float64     // Sample is a required `sample` parameter in formData.
	pipeUpload
}

// encode creates *http.Request for request data.
func (request *UploadProfileRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/upload/profile"

	request.initPipe()
	go func() {
		defer request.close()

		request.addFile(request.Profile, "profile")
		request.multipartWriter.WriteField("sample", strconv.FormatFloat(request.Sample, 'g', -1, 64))

	}()

	req, err := http.NewRequest(http.MethodPost, requestURI, request.pipeReader)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Content-Type", request.multipartWriter.FormDataContentType())
	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// UploadProfileResponse is operation response value.
type UploadProfileResponse struct {
	StatusCode    int
	RawBody       []byte            // RawBody contains read bytes of response body.
	ValueConflict *RestErrResponse  // ValueConflict is a value of 409 Conflict response.
}

// decode loads data from *http.Response.
func (result *UploadProfileResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusAccepted:
		// No body to decode.
	case http.StatusConflict:
		err = json.NewDecoder(body).Decode(&result.ValueConflict)
		if err != nil {
			err = fmt.Errorf("failed to decode 'post /upload/profile' Conflict response: %w", err)
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

// UploadProfile performs REST operation.
func (c *Client) UploadProfile(ctx context.Context, request UploadProfileRequest) (result UploadProfileResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodPost, "/upload/profile", &request)
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
		request.Cancel(err)

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
