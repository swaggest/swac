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
	"strconv"
)

// GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadRequest is operation request value.
type GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadRequest struct {
	Signed     bool                                                                                // Signed is a required `signed` parameter in query.
	FileFormat *GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadRequestQueryFileFormat  // FileFormat is an optional `file_format` parameter in query.
	StateKey   string                                                                              // StateKey is a required `state_key` parameter in path.
	DocumentID string                                                                              // DocumentID is a required `document_id` parameter in path.
}

// encode creates *http.Request for request data.
func (request *GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/credit_facility_customer_document/" + url.PathEscape(request.StateKey) + "/" + url.PathEscape(request.DocumentID) + "/download/"

	query := make(url.Values, 2)
	query.Set("signed", strconv.FormatBool(request.Signed))

	if request.FileFormat != nil {
		query.Set("file_format", string(*request.FileFormat))
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

// GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadResponse is operation response value.
type GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadResponse struct {
	StatusCode int
	RawBody    []byte       // RawBody contains read bytes of response body.
	ValueOK    interface{}  // ValueOK is a value of 200 OK response.
}

// decode loads data from *http.Response.
func (result *GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
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

// GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownload performs REST operation.
func (c *Client) GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownload(ctx context.Context, request GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadRequest) (result GetCreditFacilityCustomerDocumentStateKeyDocumentIDDownloadResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/credit_facility_customer_document/{state_key}/{document_id}/download/", &request)
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
