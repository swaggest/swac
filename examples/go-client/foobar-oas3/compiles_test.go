package foobar_test

import (
	"examples/foobar-oas3"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestNewClient(t *testing.T) {
	c := foobar.NewClient("/")
	assert.NotNil(t, c)
}
