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

// GetCreditFacilityRepaymentScheduleStateKeyRequest is operation request value.
type GetCreditFacilityRepaymentScheduleStateKeyRequest struct {
	// Mode is a required `mode` parameter in query.
	// Specify which simulation mode this repayment schedule should take into account.
	Mode     GetCreditFacilityRepaymentScheduleStateKeyRequestQueryMode
	// Amount is an optional `amount` parameter in query.
	// The amount you want to repay or draw-down. If not specified, will return the current loan schedule, if any.
	Amount   *float64
	// StateKey is a required `state_key` parameter in path.
	// The state_key used to represent a customer.
	StateKey string
}

// encode creates *http.Request for request data.
func (request *GetCreditFacilityRepaymentScheduleStateKeyRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/credit_facility_repayment_schedule/" + url.PathEscape(request.StateKey) + "/"

	query := make(url.Values, 2)
	query.Set("mode", string(request.Mode))

	if request.Amount != nil {
		query.Set("amount", strconv.FormatFloat(*request.Amount, 'g', -1, 64))
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

// GetCreditFacilityRepaymentScheduleStateKeyResponse is operation response value.
type GetCreditFacilityRepaymentScheduleStateKeyResponse struct {
	StatusCode int
	RawBody    []byte                                                      // RawBody contains read bytes of response body.
	ValueOK    *GetCreditFacilityRepaymentScheduleStateKeyResponseValueOK  // ValueOK is a value of 200 OK response.
}

// decode loads data from *http.Response.
func (result *GetCreditFacilityRepaymentScheduleStateKeyResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /credit_facility_repayment_schedule/{state_key}/' OK response: %w", err)
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

// GetCreditFacilityRepaymentScheduleStateKey performs REST operation.
func (c *Client) GetCreditFacilityRepaymentScheduleStateKey(ctx context.Context, request GetCreditFacilityRepaymentScheduleStateKeyRequest) (result GetCreditFacilityRepaymentScheduleStateKeyResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/credit_facility_repayment_schedule/{state_key}/", &request)
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
