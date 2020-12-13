// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package petstore

import (
	"bytes"
	"encoding/json"
	"errors"
)

// Pet structure is generated from "#/components/schemas/Pet".
type Pet struct {
	NewPet
	PetAllOf1
}

// NewPet structure is generated from "#/components/schemas/NewPet".
type NewPet struct {
	Name                 string                 `json:"name"`          // Required.
	Tag                  string                 `json:"tag,omitempty"`
	AdditionalProperties map[string]interface{} `json:"-"`             // All unmatched properties.
}

type marshalNewPet NewPet

var knownKeysNewPet = []string{
	"name",
	"tag",
}

// UnmarshalJSON decodes JSON.
func (n *NewPet) UnmarshalJSON(data []byte) error {
	var err error

	mn := marshalNewPet(*n)

	err = json.Unmarshal(data, &mn)
	if err != nil {
		return err
	}

	var rawMap map[string]json.RawMessage

	err = json.Unmarshal(data, &rawMap)
	if err != nil {
		rawMap = nil
	}

	for _, key := range knownKeysNewPet {
		delete(rawMap, key)
	}

	for key, rawValue := range rawMap {
		if mn.AdditionalProperties == nil {
			mn.AdditionalProperties = make(map[string]interface{}, 1)
		}

		var val interface{}

		err = json.Unmarshal(rawValue, &val)
		if err != nil {
			return err
		}

		mn.AdditionalProperties[key] = val
	}

	*n = NewPet(mn)

	return nil
}

// MarshalJSON encodes JSON.
func (n NewPet) MarshalJSON() ([]byte, error) {
	if len(n.AdditionalProperties) == 0 {
		return json.Marshal(marshalNewPet(n))
	}

	return marshalUnion(marshalNewPet(n), n.AdditionalProperties)
}

// PetAllOf1 structure is generated from "#/components/schemas/Pet/allOf/1".
type PetAllOf1 struct {
	// Format: int64.
	// Required.
	ID                   int64                  `json:"id"`
	AdditionalProperties map[string]interface{} `json:"-"`  // All unmatched properties.
}

type marshalPetAllOf1 PetAllOf1

var knownKeysPetAllOf1 = []string{
	"id",
}

// UnmarshalJSON decodes JSON.
func (p *PetAllOf1) UnmarshalJSON(data []byte) error {
	var err error

	mp := marshalPetAllOf1(*p)

	err = json.Unmarshal(data, &mp)
	if err != nil {
		return err
	}

	var rawMap map[string]json.RawMessage

	err = json.Unmarshal(data, &rawMap)
	if err != nil {
		rawMap = nil
	}

	for _, key := range knownKeysPetAllOf1 {
		delete(rawMap, key)
	}

	for key, rawValue := range rawMap {
		if mp.AdditionalProperties == nil {
			mp.AdditionalProperties = make(map[string]interface{}, 1)
		}

		var val interface{}

		err = json.Unmarshal(rawValue, &val)
		if err != nil {
			return err
		}

		mp.AdditionalProperties[key] = val
	}

	*p = PetAllOf1(mp)

	return nil
}

// MarshalJSON encodes JSON.
func (p PetAllOf1) MarshalJSON() ([]byte, error) {
	if len(p.AdditionalProperties) == 0 {
		return json.Marshal(marshalPetAllOf1(p))
	}

	return marshalUnion(marshalPetAllOf1(p), p.AdditionalProperties)
}

func marshalUnion(maps ...interface{}) ([]byte, error) {
	result := []byte("{")
	isObject := true

	for _, m := range maps {
		j, err := json.Marshal(m)
		if err != nil {
			return nil, err
		}

		if string(j) == "{}" {
			continue
		}

		if string(j) == "null" {
			continue
		}

		if j[0] != '{' {
			if len(result) == 1 && (isObject || bytes.Equal(result, j)) {
				result = j
				isObject = false

				continue
			}

			return nil, errors.New("failed to union map: object expected, " + string(j) + " received")
		}

		if !isObject {
			return nil, errors.New("failed to union " + string(result) + " and " + string(j))
		}

		if len(result) > 1 {
			result[len(result)-1] = ','
		}

		result = append(result, j[1:]...)
	}

	// Close empty result.
	if isObject && len(result) == 1 {
		result = append(result, '}')
	}

	return result, nil
}
