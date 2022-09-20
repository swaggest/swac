# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.31] - 2022-09-20

### Added
- Dependencies update.


## [0.1.30] - 2022-08-12

### Added
- Dependencies update.

### Fixed
- Schema descriptions in parameters.

## [0.1.29] - 2022-04-28

### Added
- Support for PHP 8.1.
- Dependencies update.

### Fixed
- Handling of slices of named types in Go.
- Gateway Time Out status name in Go.

## [0.1.28] - 2022-01-02

### Added
- Support for file uploads in Go client (streaming implementation optimized for large files).
- STDIN support (with `-` as file name) for schema loading.
- Dependencies updated.

### Fixed
- Formatting in JS client.
- Non-JSON response handling in JS client.
- Unnecessary properties (untyped/empty bodies) in Go client responses.
- Scalar named types in header parameters in Go client.

## [0.1.27] - 2021-08-09

### Fixed
- Error during decoding of a response with no content in Go client.

## [0.1.26] - 2021-07-22

### Fixed
- Missing response decoding due to exception during code generation for enum, [#31](https://github.com/swaggest/swac/issues/31).

### Added
- Dependencies updated.

## [0.1.25] - 2021-07-16

### Added
- Dependencies updated.
- Support enumerated and date-time strings in path.

### Fixed
- Incorrect schema resolution in complex parameters.

## [0.1.24] - 2021-04-25

### Added
- Markdown rendered for OpenAPI/Swagger specs.
- File uploads support in JS client.

### Fixes
- Linting issues in JS client.

## [0.1.23] - 2021-04-20

### Added
- Dependencies updated.

## [0.1.22] - 2021-04-12

### Added
- Code generation improvements JavaScript client generator.

## [0.1.21] - 2021-04-08

### Added
- JavaScript client generator.

## [0.1.20] - 2021-04-06

### Added
- Response structures in Go now expose `RawBody` with consumed response bytes.

## [0.1.19] - 2021-03-17

### Changed
- Operations are now named by `operationId` where available, use `--ignore-operation-id` for previous behavior.

## [0.1.18] - 2020-12-13

### Changed
- Internal refactoring to reuse CLI options from `swaggest/json-cli`.

## [0.1.17] - 2020-12-13

### Added
- Dependencies updated.

## [0.1.16] - 2020-08-30

### Fixed
- Missing YAML lib in phar.

## [0.1.15] - 2020-08-25

### Added
- Dependencies updated.
- More tests.

### Fixed
- Nullability leak into an irrelevant schema in a Go client.
- Infinite recursion in PHP ReadMe generator.

## [0.1.14] - 2020-05-14

### Added
- More options for Go structures builder.
- Dependencies updated.

## [0.1.13] - 2020-04-28

### Added
- Support for consumes/produces in `swagger.json` and Go client.

## [0.1.12] - 2020-04-14

### Added
- Dependencies updated.

## [0.1.11] - 2020-04-04

### Added
- Dependencies updated.
- Option to only generate properties with `x-generate: true` set. 

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

[0.1.31]: https://github.com/swaggest/swac/compare/v0.1.30...v0.1.31
[0.1.30]: https://github.com/swaggest/swac/compare/v0.1.29...v0.1.30
[0.1.29]: https://github.com/swaggest/swac/compare/v0.1.28...v0.1.29
[0.1.28]: https://github.com/swaggest/swac/compare/v0.1.27...v0.1.28
[0.1.27]: https://github.com/swaggest/swac/compare/v0.1.26...v0.1.27
[0.1.26]: https://github.com/swaggest/swac/compare/v0.1.25...v0.1.26
[0.1.25]: https://github.com/swaggest/swac/compare/v0.1.24...v0.1.25
[0.1.24]: https://github.com/swaggest/swac/compare/v0.1.23...v0.1.24
[0.1.23]: https://github.com/swaggest/swac/compare/v0.1.22...v0.1.23
[0.1.22]: https://github.com/swaggest/swac/compare/v0.1.21...v0.1.22
[0.1.21]: https://github.com/swaggest/swac/compare/v0.1.20...v0.1.21
[0.1.20]: https://github.com/swaggest/swac/compare/v0.1.19...v0.1.20
[0.1.19]: https://github.com/swaggest/swac/compare/v0.1.18...v0.1.19
[0.1.18]: https://github.com/swaggest/swac/compare/v0.1.17...v0.1.18
[0.1.17]: https://github.com/swaggest/swac/compare/v0.1.16...v0.1.17
[0.1.16]: https://github.com/swaggest/swac/compare/v0.1.15...v0.1.16
[0.1.15]: https://github.com/swaggest/swac/compare/v0.1.14...v0.1.15
[0.1.14]: https://github.com/swaggest/swac/compare/v0.1.13...v0.1.14
[0.1.13]: https://github.com/swaggest/swac/compare/v0.1.12...v0.1.13
[0.1.12]: https://github.com/swaggest/swac/compare/v0.1.11...v0.1.12
[0.1.11]: https://github.com/swaggest/swac/compare/v0.1.10...v0.1.11
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
