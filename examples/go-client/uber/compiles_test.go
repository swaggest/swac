package uber_test

import (
	"examples/uber"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestNewClient(t *testing.T) {
	c := uber.NewClient()
	assert.NotNil(t, c)
}
