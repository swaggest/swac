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
	"time"
)

// GetPaymentConfirmationRequest is operation request value.
type GetPaymentConfirmationRequest struct {
	// DateFrom is an optional `date_from` parameter in query.
	// Fetch payment instructions whose latest status update was after the supplied date time.
	DateFrom             *time.Time
	// DateTo is an optional `date_to` parameter in query.
	// Fetch payment instructions whose latest status update was up to the supplied date time.
	DateTo               *time.Time
	// Outcome is an optional `outcome` parameter in query.
	// The current outcome recorded for the payment instruction.
	Outcome              *GetPaymentConfirmationRequestQueryOutcome
	// ErrorCode is an optional `error_code` parameter in query.
	// The error code supplied for a failed payment instruction.
	ErrorCode            *GetPaymentConfirmationRequestQueryErrorCode
	// Amount is an optional `amount` parameter in query.
	// The payment instruction amount.
	Amount               *float64
	// Direction is an optional `direction` parameter in query.
	// The direction of the payment.
	Direction            *GetPaymentConfirmationRequestQueryDirection
	// StateKey is an optional `state_key` parameter in query.
	// The unique identifier of the customer.
	StateKey             *string
	// PaymentInstructionID is an optional `payment_instruction_id` parameter in query.
	// The unique identifier of the payment instruction.
	PaymentInstructionID *string
	// Page is an optional `page` parameter in query.
	// The page displayed, used to paginate the results.
	Page                 *int64
}

// encode creates *http.Request for request data.
func (request *GetPaymentConfirmationRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/payment_confirmation/"

	query := make(url.Values, 9)

	if request.DateFrom != nil {
		query.Set("date_from", (*request.DateFrom).Format(time.RFC3339))
	}

	if request.DateTo != nil {
		query.Set("date_to", (*request.DateTo).Format(time.RFC3339))
	}

	if request.Outcome != nil {
		query.Set("outcome", string(*request.Outcome))
	}

	if request.ErrorCode != nil {
		query.Set("error_code", string(*request.ErrorCode))
	}

	if request.Amount != nil {
		query.Set("amount", strconv.FormatFloat(*request.Amount, 'g', -1, 64))
	}

	if request.Direction != nil {
		query.Set("direction", string(*request.Direction))
	}

	if request.StateKey != nil {
		query.Set("state_key", *request.StateKey)
	}

	if request.PaymentInstructionID != nil {
		query.Set("payment_instruction_id", *request.PaymentInstructionID)
	}

	if request.Page != nil {
		query.Set("page", strconv.FormatInt(*request.Page, 10))
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

// GetPaymentConfirmationResponse is operation response value.
type GetPaymentConfirmationResponse struct {
	StatusCode int
	RawBody    []byte                                  // RawBody contains read bytes of response body.
	ValueOK    *GetPaymentConfirmationResponseValueOK  // ValueOK is a value of 200 OK response.
}

// decode loads data from *http.Response.
func (result *GetPaymentConfirmationResponse) decode(resp *http.Response) error {
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

// GetPaymentConfirmation performs REST operation.
func (c *Client) GetPaymentConfirmation(ctx context.Context, request GetPaymentConfirmationRequest) (result GetPaymentConfirmationResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/payment_confirmation/", &request)
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
