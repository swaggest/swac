// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

// Package foobar contains autogenerated REST client.
package foobar

import (
	"context"
	"net/http"
	"strings"
	"time"
)

type roundTripperFunc func(*http.Request) (*http.Response, error)

func (rt roundTripperFunc) RoundTrip(req *http.Request) (*http.Response, error) {
	return rt(req)
}

// Client is a REST service HTTP client.
type Client struct {
	BaseURL              string
	Timeout              time.Duration
	// InstrumentCtxFunc allows adding operation info to context.
	// A pointer to request structure passed into the function.
	// Nil value is ignored.
	InstrumentCtxFunc    func(ctx context.Context, method, pattern string, reqStruct interface{}) context.Context
	transport            http.RoundTripper
	securityJWT          func(http.RoundTripper) http.RoundTripper
	securityJWTTransport http.RoundTripper
}

// NewClient creates client instance with default transport.
func NewClient(baseURL string) *Client {
	return &Client{
		transport: http.DefaultTransport,
		Timeout:   30 * time.Second,
		BaseURL: strings.TrimRight(baseURL, "/"),
	}
}

// SetTransport sets client transport.
func (c *Client) SetTransport(transport http.RoundTripper) {
	c.transport = transport
	if c.securityJWT != nil {
		c.securityJWTTransport = c.securityJWT(c.transport)
	}
}

// SetSecurityJWTToken sets security token.
func (c *Client) SetSecurityJWTToken(token string) {
	c.SetSecurityJWTMiddleware(func(tripper http.RoundTripper) http.RoundTripper {
		return roundTripperFunc(func(req *http.Request) (*http.Response, error) {
			req.Header.Set("Authorization", token)
			return tripper.RoundTrip(req)
		})
	})
}

// SetSecurityJWTMiddleware sets security middleware.
func (c *Client) SetSecurityJWTMiddleware(middleware func(http.RoundTripper) http.RoundTripper) {
	c.securityJWT = middleware
	if c.securityJWT != nil {
		c.securityJWTTransport = c.securityJWT(c.transport)
	} else {
		c.securityJWTTransport = nil
	}
}
