package uspto_test

import (
	"examples/uspto-oas3"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestNewClient(t *testing.T) {
	c := uspto.NewClient()
	assert.NotNil(t, c)
}
