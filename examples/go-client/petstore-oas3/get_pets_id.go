// Code generated by github.com/swaggest/swac v0.1.1, DO NOT EDIT.

package petstore

import (
	"context"
	"encoding/json"
	"errors"
	"net/http"
	"net/url"
	"strconv"
)

// GetPetsIDRequest is operation request value.
type GetPetsIDRequest struct {
	// ID is a required `id` parameter in path.
	// ID of pet to fetch
	ID int64
}

// encode creates *http.Request for request data.
func (request *GetPetsIDRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestUri := baseURL + "/pets/" + url.PathEscape(strconv.FormatInt(request.ID, 10))
	req, err := http.NewRequest(http.MethodGet, requestUri, nil)
	if err != nil {
	    return nil, err
	}
	req = req.WithContext(ctx)
	return req, err
}

// GetPetsIDResponse is operation response value.
type GetPetsIDResponse struct {
	StatusCode int
	OK         *ComponentsSchemasPet  // OK is a value of 200 OK response.
}

// decode loads data from *http.Response.
func (result *GetPetsIDResponse) decode(resp *http.Response) error {
	result.StatusCode = resp.StatusCode
	switch resp.StatusCode {
	case http.StatusOK:
	    err := json.NewDecoder(resp.Body).Decode(&result.OK)
	    if err != nil {
	        return err
	    }
	default:
	    return errors.New("unexpected response status: " + resp.Status)
	}
	return nil

}

// GetPetsID performs REST operation.
func (c *Client) GetPetsID(ctx context.Context, request GetPetsIDRequest) (GetPetsIDResponse, error) {
	result := GetPetsIDResponse{}
	ctx = context.WithValue(ctx, "restOperationPath", "/pets/{id}")
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
