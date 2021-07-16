// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package acme

import (
	"bytes"
	"context"
	"encoding/json"
	"errors"
	"io"
	"io/ioutil"
	"net/http"
	"net/url"
	"strings"
)

// PostDocumentUploadStateKeyRequest is operation request value.
type PostDocumentUploadStateKeyRequest struct {
	// Document is a required `document` parameter in formData.
	// format: file
	Document     string
	DocumentType PostDocumentUploadStateKeyRequestFormDataDocumentType  // DocumentType is a required `document_type` parameter in formData.
	StateKey     string                                                 // StateKey is a required `state_key` parameter in path.
}

// encode creates *http.Request for request data.
func (request *PostDocumentUploadStateKeyRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/document_upload/" + url.PathEscape(request.StateKey) + "/"

	formData := make(url.Values, 2)
	formData.Set("document", request.Document)

	formData.Set("document_type", string(request.DocumentType))

	var body io.Reader

	if len(formData) > 0 {
		body = strings.NewReader(formData.Encode())
	}

	req, err := http.NewRequest(http.MethodPost, requestURI, body)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Content-Type", "application/x-www-form-urlencoded")
	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// PostDocumentUploadStateKeyResponse is operation response value.
type PostDocumentUploadStateKeyResponse struct {
	StatusCode   int
	RawBody      []byte                                           // RawBody contains read bytes of response body.
	ValueCreated *PostDocumentUploadStateKeyResponseValueCreated  // ValueCreated is a value of 201 Created response.
}

// decode loads data from *http.Response.
func (result *PostDocumentUploadStateKeyResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusCreated:
		err = json.NewDecoder(body).Decode(&result.ValueCreated)
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

// PostDocumentUploadStateKey performs REST operation.
func (c *Client) PostDocumentUploadStateKey(ctx context.Context, request PostDocumentUploadStateKeyRequest) (result PostDocumentUploadStateKeyResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodPost, "/document_upload/{state_key}/", &request)
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
