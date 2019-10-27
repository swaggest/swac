// Code generated by github.com/swaggest/swac v0.1.2, DO NOT EDIT.

package petstore

import (
	"context"
	"encoding/json"
	"net/http"
	"net/url"
	"strconv"
)

// DeletePetsIDRequest is operation request value.
type DeletePetsIDRequest struct {
	// ID is a required `id` parameter in path.
	// ID of pet to delete
	ID int64
}

// encode creates *http.Request for request data.
func (request *DeletePetsIDRequest) encode(ctx context.Context, baseURL string) (*http.Request, error) {
	requestURI := baseURL + "/pets/" + url.PathEscape(strconv.FormatInt(request.ID, 10))

	req, err := http.NewRequest(http.MethodDelete, requestURI, nil)
	if err != nil {
	    return nil, err
	}

	req = req.WithContext(ctx)

	return req, err
}

// DeletePetsIDResponse is operation response value.
type DeletePetsIDResponse struct {
	StatusCode     int
	ValueNoContent interface{}  // ValueNoContent is a value of 204 No Content response.
	Default        *Error       // Default is a default value of response.
}

// decode loads data from *http.Response.
func (result *DeletePetsIDResponse) decode(resp *http.Response) error {
	result.StatusCode = resp.StatusCode
	switch resp.StatusCode {
	case http.StatusNoContent:
	    err := json.NewDecoder(resp.Body).Decode(&result.ValueNoContent)
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

// DeletePetsID performs REST operation.
func (c *Client) DeletePetsID(ctx context.Context, request DeletePetsIDRequest) (DeletePetsIDResponse, error) {
	result := DeletePetsIDResponse{}
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
