package petstore_test

import (
	"encoding/json"
	"examples/petstore"
	"github.com/stretchr/testify/assert"
	"github.com/stretchr/testify/require"
	"testing"
)

func TestNewPet_MarshalJSON(t *testing.T) {
	p := petstore.Pet{}
	err := json.Unmarshal([]byte(`{"name":"Jack", "tag":"dog","id":123,"x-other":"abc"}`), &p)
	require.NoError(t, err)

	assert.Equal(t, "Jack", p.Name)
	assert.Equal(t, "dog", p.Tag)
	assert.Equal(t, int64(123), p.ID)

	// Additional properties are not unmarshaled into embedded structures.
	assert.Nil(t, p.NewPet.AdditionalProperties["x-other"])
	assert.Nil(t, p.PetAllOf1.AdditionalProperties["x-other"])
}
