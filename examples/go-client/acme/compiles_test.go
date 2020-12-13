package acme_test

import (
	"examples/acme"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestNewClient(t *testing.T) {
	c := acme.NewClient("/")
	assert.NotNil(t, c)
}
