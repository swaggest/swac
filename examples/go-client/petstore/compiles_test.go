package petstore_test

import (
	"examples/petstore"
	"github.com/stretchr/testify/assert"
	"testing"
)

func TestNewClient(t *testing.T) {
	c := petstore.NewClient()
	assert.NotNil(t, c)
}
