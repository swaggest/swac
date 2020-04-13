// Code generated by github.com/swaggest/swac <version>, DO NOT EDIT.

package uspto

import (
	"bytes"
	"encoding/json"
	"errors"
)

// ComponentsSchemasDataSetList structure is generated from "#/components/schemas/dataSetList".
type ComponentsSchemasDataSetList struct {
	Total                int64                                   `json:"total,omitempty"`
	Apis                 []ComponentsSchemasDataSetListApisItems `json:"apis,omitempty"`
	AdditionalProperties map[string]interface{}                  `json:"-"`               // All unmatched properties.
}

type marshalComponentsSchemasDataSetList ComponentsSchemasDataSetList

var knownKeysComponentsSchemasDataSetList = []string{
	"total",
	"apis",
}

// UnmarshalJSON decodes JSON.
func (c *ComponentsSchemasDataSetList) UnmarshalJSON(data []byte) error {
	var err error

	mc := marshalComponentsSchemasDataSetList(*c)

	err = json.Unmarshal(data, &mc)
	if err != nil {
		return err
	}

	var rawMap map[string]json.RawMessage

	err = json.Unmarshal(data, &rawMap)
	if err != nil {
		rawMap = nil
	}

	for _, key := range knownKeysComponentsSchemasDataSetList {
		delete(rawMap, key)
	}

	for key, rawValue := range rawMap {
		if mc.AdditionalProperties == nil {
			mc.AdditionalProperties = make(map[string]interface{}, 1)
		}

		var val interface{}

		err = json.Unmarshal(rawValue, &val)
		if err != nil {
			return err
		}

		mc.AdditionalProperties[key] = val
	}

	*c = ComponentsSchemasDataSetList(mc)

	return nil
}

// MarshalJSON encodes JSON.
func (c ComponentsSchemasDataSetList) MarshalJSON() ([]byte, error) {
	if len(c.AdditionalProperties) == 0 {
		return json.Marshal(marshalComponentsSchemasDataSetList(c))
	}

	return marshalUnion(marshalComponentsSchemasDataSetList(c), c.AdditionalProperties)
}

// ComponentsSchemasDataSetListApisItems structure is generated from "#/components/schemas/dataSetList->apis->items".
type ComponentsSchemasDataSetListApisItems struct {
	APIKey               string                 `json:"apiKey,omitempty"`              // To be used as a dataset parameter value.
	APIVersionNumber     string                 `json:"apiVersionNumber,omitempty"`    // To be used as a version parameter value.
	// The URL describing the dataset's fields.
	// Format: uriref.
	APIURL               string                 `json:"apiUrl,omitempty"`
	// A URL to the API console for each API.
	// Format: uriref.
	APIDocumentationURL  string                 `json:"apiDocumentationUrl,omitempty"`
	AdditionalProperties map[string]interface{} `json:"-"`                             // All unmatched properties.
}

type marshalComponentsSchemasDataSetListApisItems ComponentsSchemasDataSetListApisItems

var knownKeysComponentsSchemasDataSetListApisItems = []string{
	"apiKey",
	"apiVersionNumber",
	"apiUrl",
	"apiDocumentationUrl",
}

// UnmarshalJSON decodes JSON.
func (c *ComponentsSchemasDataSetListApisItems) UnmarshalJSON(data []byte) error {
	var err error

	mc := marshalComponentsSchemasDataSetListApisItems(*c)

	err = json.Unmarshal(data, &mc)
	if err != nil {
		return err
	}

	var rawMap map[string]json.RawMessage

	err = json.Unmarshal(data, &rawMap)
	if err != nil {
		rawMap = nil
	}

	for _, key := range knownKeysComponentsSchemasDataSetListApisItems {
		delete(rawMap, key)
	}

	for key, rawValue := range rawMap {
		if mc.AdditionalProperties == nil {
			mc.AdditionalProperties = make(map[string]interface{}, 1)
		}

		var val interface{}

		err = json.Unmarshal(rawValue, &val)
		if err != nil {
			return err
		}

		mc.AdditionalProperties[key] = val
	}

	*c = ComponentsSchemasDataSetListApisItems(mc)

	return nil
}

// MarshalJSON encodes JSON.
func (c ComponentsSchemasDataSetListApisItems) MarshalJSON() ([]byte, error) {
	if len(c.AdditionalProperties) == 0 {
		return json.Marshal(marshalComponentsSchemasDataSetListApisItems(c))
	}

	return marshalUnion(marshalComponentsSchemasDataSetListApisItems(c), c.AdditionalProperties)
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
