// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

// Package acme contains autogenerated REST client.
package acme

import (
	"context"
	"net/http"
	"strings"
	"time"
)

// Client is a REST service HTTP client.
// Some Service.
//

// Version: v1.
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
}