// Code generated by github.com/swaggest/swac v0.0.3, DO NOT EDIT.

package uber

import (
	"context"
	"encoding/json"
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
	requestUri := baseURL + "/estimates/price"
	query := make(url.Values, 4)
	query.Set("start_latitude", strconv.FormatFloat(request.StartLatitude, 'g', -1, 64))
	query.Set("start_longitude", strconv.FormatFloat(request.StartLongitude, 'g', -1, 64))
	query.Set("end_latitude", strconv.FormatFloat(request.EndLatitude, 'g', -1, 64))
	query.Set("end_longitude", strconv.FormatFloat(request.EndLongitude, 'g', -1, 64))
	if len(query) > 0 {
		requestUri += "?" + query.Encode()
	}
	req, err := http.NewRequest(http.MethodGet, requestUri, nil)
	if err != nil {
	    return nil, err
	}
	req = req.WithContext(ctx)
	return req, err
}

// GetEstimatesPriceResponse is operation response value.
type GetEstimatesPriceResponse struct {
	StatusCode int
	OK         []PriceEstimate  // OK is a value of 200 OK response.
	Default    *Error           // Default is a default value of response.
}

// decode loads data from *http.Response.
func (result *GetEstimatesPriceResponse) decode(resp *http.Response) error {
	result.StatusCode = resp.StatusCode
	switch resp.StatusCode {
	case http.StatusOK:
	    err := json.NewDecoder(resp.Body).Decode(&result.OK)
	    if err != nil {
	        return err
	    }
	default:
	    err := json.NewDecoder(resp.Body).Decode(&result.Default)
	    if err != nil {
	        return err
	    }
	}
	return nil

}

// GetEstimatesPrice performs REST operation.
func (c *Client) GetEstimatesPrice(ctx context.Context, request GetEstimatesPriceRequest) (GetEstimatesPriceResponse, error) {
	result := GetEstimatesPriceResponse{}
	ctx = context.WithValue(ctx, "restOperationPath", "/estimates/price")
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
	defer resp.Body.Close()
	err = result.decode(resp)
	if err != nil {
	    return result, err
	}
	return result, nil
}
