# Things to fix

* [x] Add status code to response structure
* [x] Add security interceptor
* [x] Add operation filtering options to `Rest`
* [x] Avoid param names collisions in field props
* [x] Fix `nil` `*json.RawMessage` handling
```go
subMap = append(subMap, []byte(keyEscaped)...)
if val != nil {
    subMap = append(subMap, []byte(*val)...)
} else {
    subMap = append(subMap, []byte("null")...)
}
subMap = append(subMap, '}')
```
* [ ] Use int instead of int64 by default?
* [ ] Add pointer setters?
* [x] Add descriptions to properties.
* [ ] Export JSON Schema of models
* [ ] Add validation interceptor
* [ ] Add other API KEY security token setters
* [ ] Fallback to schema from example
* [x] Add timeout configuration
* [x] Add comments to status response properties
* [ ] Split huge `Client.php`
* [ ] Add support for parameters in `form-data` and `cookie`
* [ ] Add structured errors
* [ ] Word wrap struct property comments in `go-code-builder`