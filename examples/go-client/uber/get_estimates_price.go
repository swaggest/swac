// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package uber

import (
	"bytes"
	"context"
	"encoding/json"
	"fmt"
	"io"
	"net/http"
	"net/url"
	"strconv"
)

// GetEstimatesPriceRequest is operation request value.
type GetEstimatesPriceRequest struct {
	// StartLatitude is a required `start_latitude` parameter in query.
	// Latitude component of start location.
	StartLatitude  float64
	// StartLongitude is a required `start_longitude` parameter in query.
	// Longitude component of start location.
	StartLongitude float64
	// EndLatitude is a required `end_latitude` parameter in query.
	// Latitude component of end location.
	EndLatitude    float64
	// EndLongitude is a required `end_longitude` parameter in query.
	// Longitude component of end location.
	EndLongitude   float64
}

// encode creates *http.Request for request data.
func (request *GetEstimatesPriceRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/estimates/price"

	query := make(url.Values, 4)
	query.Set("start_latitude", strconv.FormatFloat(request.StartLatitude, 'g', -1, 64))

	query.Set("start_longitude", strconv.FormatFloat(request.StartLongitude, 'g', -1, 64))

	query.Set("end_latitude", strconv.FormatFloat(request.EndLatitude, 'g', -1, 64))

	query.Set("end_longitude", strconv.FormatFloat(request.EndLongitude, 'g', -1, 64))

	if len(query) > 0 {
		requestURI += "?" + query.Encode()
	}

	req, err := http.NewRequest(http.MethodGet, requestURI, nil)
	if err != nil {
		return nil, err
	}

	req.Header.Set("Accept", "application/json")

	req = req.WithContext(ctx)

	return req, err
}

// GetEstimatesPriceResponse is operation response value.
type GetEstimatesPriceResponse struct {
	StatusCode int
	RawBody    []byte           // RawBody contains read bytes of response body.
	ValueOK    []PriceEstimate  // ValueOK is a value of 200 OK response.
	Default    *Error           // Default is a default value of response.
}

// decode loads data from *http.Response.
func (result *GetEstimatesPriceResponse) decode(resp *http.Response) error {
	var err error

	dump := bytes.NewBuffer(nil)
	body := io.TeeReader(resp.Body, dump)

	result.StatusCode = resp.StatusCode

	switch resp.StatusCode {
	case http.StatusOK:
		err = json.NewDecoder(body).Decode(&result.ValueOK)
		if err != nil {
			err = fmt.Errorf("failed to decode 'get /estimates/price' OK response: %w", err)
		}
	default:
		err = json.NewDecoder(body).Decode(&result.Default)
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

// GetEstimatesPrice performs REST operation.
func (c *Client) GetEstimatesPrice(ctx context.Context, request GetEstimatesPriceRequest) (result GetEstimatesPriceResponse, err error) {
	if c.InstrumentCtxFunc != nil {
		ctx = c.InstrumentCtxFunc(ctx, http.MethodGet, "/estimates/price", &request)
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
