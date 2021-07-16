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
)

// PostAnonymisedDataEvaluationRequest is operation request value.
type PostAnonymisedDataEvaluationRequest struct {
	Body *PostAnonymisedDataEvaluationRequestBody  // Body is a JSON request body.
}

// encode creates *http.Request for request data.
func (request *PostAnonymisedDataEvaluationRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/anonymised_data_evaluation/"

	body, err := json.Marshal(request.Body)
	if err != nil {
		return nil, err
	}

	req, err := http.NewRequest(http.MethodPost, requestURI, bytes.NewBuffer(body))
	if err != nil {
		return nil, err
	}

	req.Header.Set("Content-Type", "application/json")
	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// PostAnonymisedDataEvaluationResponse is operation response value.
type PostAnonymisedDataEvaluationResponse struct {
	StatusCode int
	RawBody    []byte                                        // RawBody contains read bytes of response body.
	ValueOK    *PostAnonymisedDataEvaluationResponseValueOK  // ValueOK is a value of 200 OK response.
}

// decode loads data from *http.Response.
func (result *PostAnonymisedDataEvaluationResponse) decode(resp *http.Response) error {
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

// PostAnonymisedDataEvaluation performs REST operation.
func (c *Client) PostAnonymisedDataEvaluation(ctx context.Context, request PostAnonymisedDataEvaluationRequest) (result PostAnonymisedDataEvaluationResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodPost, "/anonymised_data_evaluation/", &request)
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
