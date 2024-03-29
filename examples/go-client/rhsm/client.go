// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

// Package rhsm contains autogenerated REST client.
package rhsm

import (
	"context"
	"net/http"
	"time"
)

// DefaultBaseURL is the default base URL for this service.
const DefaultBaseURL = "https://api.access.redhat.com/management/v1"

type roundTripperFunc func(*http.Request) (*http.Response, error)

func (rt roundTripperFunc) RoundTrip(req *http.Request) (*http.Response, error) {
	return rt(req)
}

// Client is a REST service HTTP client.
// RHSM-API.
// API for Red Hat Subscription Management
//
// Version: 1.264.0.
//
// Contact:   https://access.redhat.com/support/cases/.
type Client struct {
	BaseURL                 string
	Timeout                 time.Duration
	// InstrumentCtxFunc allows adding operation info to context.
	// A pointer to request structure passed into the function.
	// Nil value is ignored.
	InstrumentCtxFunc       func(ctx context.Context, method, pattern string, reqStruct interface{}) context.Context
	transport               http.RoundTripper
	securityBearer          func(http.RoundTripper) http.RoundTripper
	securityBearerTransport http.RoundTripper
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
	if c.securityBearer != nil {
		c.securityBearerTransport = c.securityBearer(c.transport)
	}
}

// SetSecurityBearerToken sets security token.
func (c *Client) SetSecurityBearerToken(token string) {
	c.SetSecurityBearerMiddleware(func(tripper http.RoundTripper) http.RoundTripper {
		return roundTripperFunc(func(req *http.Request) (*http.Response, error) {
			req.Header.Set("Authorization", token)
			return tripper.RoundTrip(req)
		})
	})
}

// SetSecurityBearerMiddleware sets security middleware.
func (c *Client) SetSecurityBearerMiddleware(middleware func(http.RoundTripper) http.RoundTripper) {
	c.securityBearer = middleware
	if c.securityBearer != nil {
		c.securityBearerTransport = c.securityBearer(c.transport)
	} else {
		c.securityBearerTransport = nil
	}
}
