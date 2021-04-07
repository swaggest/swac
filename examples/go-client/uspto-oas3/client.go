// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

// Package uspto contains autogenerated REST client.
package uspto

import (
	"context"
	"net/http"
	"time"
)

// DefaultBaseURL is the default base URL for this service.
const DefaultBaseURL = "{scheme}://developer.uspto.gov/ds-api"

// Client is a REST service HTTP client.
// USPTO Data Set API.
// The Data Set API (DSAPI) allows the public users to discover and search USPTO exported data sets. This is a generic API that allows USPTO users to make any CSV based data files searchable through API. With the help of GET call, it returns the list of data fields that are searchable. With the help of POST call, data can be fetched based on the filters on the field names. Please note that POST call is used to search the actual data. The reason for the POST call is that it allows users to specify any complex search criteria without worry about the GET size limitations as well as encoding of the input parameters.
type Client struct {
	BaseURL           string
	Timeout           time.Duration
	// InstrumentCtxFunc allows adding operation info to context.
	// A pointer to request structure passed into the function.
	// Nil value is ignored.
	InstrumentCtxFunc func(ctx context.Context, method, pattern string, reqStruct interface{}) context.Context
	transport         http.RoundTripper
}

// NewClient creates client instance with default transport.
func NewClient() *Client {
	return &Client{
		transport: http.DefaultTransport,
		Timeout:   30 * time.Second,
		BaseURL:   DefaultBaseURL,
	}
}

// SetTransport sets client transport.
func (c *Client) SetTransport(transport http.RoundTripper) {
	c.transport = transport
}
