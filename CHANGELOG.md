# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.10] - 2020-02-02

### Added
- Dependencies updated.

## [0.1.9] - 2020-01-23

### Fixed
- Exception on unprocessed response schema due to invalid reference.

## [0.1.8] - 2019-12-04

### Added
- Option to add field tags with name and location to request structure properties, e.g. 'ID int `query:"id"`' in Go client.

### Fixed
- Header parameters support in Go client.

## [0.1.7] - 2019-12-02

### Added
- Dependencies updated.

## [0.1.6] - 2019-12-02

### Added
- Header parameters support in Go client.

## [0.1.5] - 2019-11-20

### Added
- Flag to not add field property for undefined `additionalProperties` in Go client.
- Flag to skip adding "DO NOT EDIT" comments in Go client.
- `InstrumentCtxFunc` context control in Go client.
- Response decoding error with body and extra information in Go client.

### Fixed
- Redundant trailing `/` is removed from base url in Go client.
- Code style issues in Go client.
- Response with status `No Content` body decoding in Go client.

## [0.1.4] - 2019-11-18

### Added
- Content type headers for request and accepted response in Go/PHP clients.

## [0.1.3] - 2019-11-16

### Added
- Dependencies updated.

### Fixed 
- Client constructor in `Go` client was missing `baseURL` argument.

## [0.1.2] - 2019-10-27

### Added
- Change log.
- Dependencies updated.

### Changed
- `Value` prefix added to response value by status properties.

### Fixed 
- Whitespaces and initialisms.

## [0.1.1] - 2019-10-23

### Changed
- Keep path parameters in operation name of PHP client.

[0.1.10]: https://github.com/swaggest/swac/compare/v0.1.9...v0.1.10
[0.1.9]: https://github.com/swaggest/swac/compare/v0.1.8...v0.1.9
[0.1.8]: https://github.com/swaggest/swac/compare/v0.1.7...v0.1.8
[0.1.7]: https://github.com/swaggest/swac/compare/v0.1.6...v0.1.7
[0.1.6]: https://github.com/swaggest/swac/compare/v0.1.5...v0.1.6
[0.1.5]: https://github.com/swaggest/swac/compare/v0.1.4...v0.1.5
[0.1.4]: https://github.com/swaggest/swac/compare/v0.1.3...v0.1.4
[0.1.3]: https://github.com/swaggest/swac/compare/v0.1.2...v0.1.3
[0.1.2]: https://github.com/swaggest/swac/compare/v0.1.1...v0.1.2
[0.1.1]: https://github.com/swaggest/swac/compare/v0.1.0...v0.1.1
