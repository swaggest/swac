// Code generated by github.com/swaggest/swac v0.1.5, DO NOT EDIT.

package petstore

import (
	"bytes"
	"encoding/json"
	"errors"
)

// ComponentsSchemasNewPet structure is generated from "#/components/schemas/NewPet".
type ComponentsSchemasNewPet struct {
	Name                 string                 `json:"name,omitempty"`
	Tag                  string                 `json:"tag,omitempty"`
	AdditionalProperties map[string]interface{} `json:"-"`              // All unmatched properties
}

type marshalComponentsSchemasNewPet ComponentsSchemasNewPet

var ignoreKeysComponentsSchemasNewPet = []string{
	"name",
	"tag",
}

// UnmarshalJSON decodes JSON.
func (i *ComponentsSchemasNewPet) UnmarshalJSON(data []byte) error {
	var err error

	ii := marshalComponentsSchemasNewPet(*i)

	err = json.Unmarshal(data, &ii)
	if err != nil {
		return err
	}

	var m map[string]json.RawMessage

	err = json.Unmarshal(data, &m)
	if err != nil {
		m = nil
	}

	for _, key := range ignoreKeysComponentsSchemasNewPet {
		delete(m, key)
	}

	for key, rawValue := range m {
		if ii.AdditionalProperties == nil {
			ii.AdditionalProperties = make(map[string]interface{}, 1)
		}

		var val interface{}

		err = json.Unmarshal(rawValue, &val)
		if err != nil {
			return err
		}

		ii.AdditionalProperties[key] = val
	}

	*i = ComponentsSchemasNewPet(ii)

	return nil
}

// MarshalJSON encodes JSON.
func (i ComponentsSchemasNewPet) MarshalJSON() ([]byte, error) {
	return marshalUnion(marshalComponentsSchemasNewPet(i), i.AdditionalProperties)
}

// ComponentsSchemasPetAllOf1 structure is generated from "#/components/schemas/Pet/allOf/1".
type ComponentsSchemasPetAllOf1 struct {
	ID                   int64                  `json:"id,omitempty"`
	AdditionalProperties map[string]interface{} `json:"-"`            // All unmatched properties
}

type marshalComponentsSchemasPetAllOf1 ComponentsSchemasPetAllOf1

var ignoreKeysComponentsSchemasPetAllOf1 = []string{
	"id",
}

// UnmarshalJSON decodes JSON.
func (i *ComponentsSchemasPetAllOf1) UnmarshalJSON(data []byte) error {
	var err error

	ii := marshalComponentsSchemasPetAllOf1(*i)

	err = json.Unmarshal(data, &ii)
	if err != nil {
		return err
	}

	var m map[string]json.RawMessage

	err = json.Unmarshal(data, &m)
	if err != nil {
		m = nil
	}

	for _, key := range ignoreKeysComponentsSchemasPetAllOf1 {
		delete(m, key)
	}

	for key, rawValue := range m {
		if ii.AdditionalProperties == nil {
			ii.AdditionalProperties = make(map[string]interface{}, 1)
		}

		var val interface{}

		err = json.Unmarshal(rawValue, &val)
		if err != nil {
			return err
		}

		ii.AdditionalProperties[key] = val
	}

	*i = ComponentsSchemasPetAllOf1(ii)

	return nil
}

// MarshalJSON encodes JSON.
func (i ComponentsSchemasPetAllOf1) MarshalJSON() ([]byte, error) {
	return marshalUnion(marshalComponentsSchemasPetAllOf1(i), i.AdditionalProperties)
}

// ComponentsSchemasPet structure is generated from "#/components/schemas/Pet".
type ComponentsSchemasPet struct {
	ComponentsSchemasNewPet *ComponentsSchemasNewPet    `json:"-"`
	AllOf1                  *ComponentsSchemasPetAllOf1 `json:"-"`
}

// UnmarshalJSON decodes JSON.
func (i *ComponentsSchemasPet) UnmarshalJSON(data []byte) error {
	var err error

	err = json.Unmarshal(data, &i.ComponentsSchemasNewPet)
	if err != nil {
		return err
	}

	err = json.Unmarshal(data, &i.AllOf1)
	if err != nil {
		return err
	}

	return nil
}

// MarshalJSON encodes JSON.
func (i ComponentsSchemasPet) MarshalJSON() ([]byte, error) {
	return marshalUnion(i.ComponentsSchemasNewPet, i.AllOf1)
}

func marshalUnion(maps ...interface{}) ([]byte, error) {
	result := make([]byte, 1, 100)
	result[0] = '{'
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
