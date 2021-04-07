# OpenAPI 3.0 / Swagger 2.0 compiler

A tool to render API spec as code.

[![Build Status](https://travis-ci.org/swaggest/swac.svg?branch=master)](https://travis-ci.org/swaggest/swac)
[![codecov](https://codecov.io/gh/swaggest/swac/branch/master/graph/badge.svg)](https://codecov.io/gh/swaggest/swac)
[![Image Size](https://images.microbadger.com/badges/image/swaggest/swac.svg)](https://microbadger.com/images/swaggest/swac)
![Code lines](https://sloc.xyz/github/swaggest/swac/?category=code)
![Comments](https://sloc.xyz/github/swaggest/swac/?category=comments)

## Installation

### Phar

Download `swac` from [releases](https://github.com/swaggest/swac/releases) page.

### Docker

```bash
docker run --rm swaggest/swac swac --help
```

```
v0.1.21 swac
OpenAPI/Swagger compiler, https://github.com/swaggest/swac
Usage: 
   swac <action>
   action   Action name                                            
            Allowed values: php-guzzle-client, go-client, js-client
...
```

Example

```bash
mkdir petstore && cd petstore
docker run -v $(pwd):/code swaggest/swac swac php-guzzle-client https://raw.githubusercontent.com/OAI/OpenAPI-Specification/master/examples/v2.0/json/petstore.json --namespace MyApp\\Petstore
```

### Composer

[Install PHP Composer](https://getcomposer.org/doc/00-intro.md)

```bash
composer global require swaggest/swac
```

## Usage

### PHP Client

```
swac php-guzzle-client --help
```

```
v0.1.0 swac php-guzzle-client
OpenAPI/Swagger compiler, https://github.com/swaggest/swac
Usage: 
   swac php-guzzle-client <schemaPath> --namespace <namespace>
   schemaPath   Path/URL to OpenAPI/Swagger schema
   
Options: 
   --operations <operations>      Operations filter in form of comma-separated list of method/path, default empty
   --project-path <projectPath>   Path to project root, default ./                                               
   --namespace <namespace>        Project namespace
```

The generated client depends on [`swaggest/rest-client`](https://github.com/swaggest/php-rest-client),
`guzzlehttp/guzzle` 6, and [`swaggest/json-schema`](https://github.com/swaggest/php-json-schema).

[Examples](/examples/php-guzzle-client).

### Go Client

```
swac go-client --help 
```

```
v0.1.14 swac go-client
OpenAPI/Swagger compiler, https://github.com/swaggest/swac
Usage: 
   swac go-client <schemaPath>
   schemaPath   Path/URL to OpenAPI/Swagger schema
   
Options: 
   --operations <operations>               Operations filter in form of comma-separated list of method/path, default empty                  
   --out <out>                             Path to output package, default ./client                                                         
   --pkg-name <pkgName>                    Output package name, default "client"                                                            
   --skip-default-additional-properties    Do not add field property for undefined `additionalProperties`                                   
   --skip-do-not-edit                      Skip adding "DO NOT EDIT" comments                                                               
   --add-request-tags                      Add field tags with name and location to request structure properties, e.g. 'ID int `query:"id"`'
   --show-const-properties                 Show properties with constant values, hidden by default                                          
   --keep-parent-in-property-names         Keep parent prefix in property name, removed by default                                          
   --ignore-nullable                       Add `omitempty` to nullable properties, removed by default                                       
   --ignore-xgo-type                       Ignore `x-go-type` in schema to skip generation                                                  
   --with-zero-values                      Use pointer types to avoid zero value ambiguity                                                  
   --fluent-setters                        Add fluent setters to struct fields                                                              
   --ignore-required                       Ignore if property is required when deciding on pointer type or omitempty                        
   --renames <renames...>                  Map of exported symbol renames, example From:To                                                  
   --with-tests                            Generate (un)marshaling tests for entities (experimental feature)                                
   --require-xgenerate                     Generate properties with `x-generate: true` only                                                 
   --validate-required                     Generate validation code to check required properties during unmarshal                           
```

[Examples](/examples/go-client).

The generated client is a single package without external dependencies.

### JavaScript Client

```
swac js-client --help 
```

```
v0.1.21 swac js-client
OpenAPI/Swagger compiler, https://github.com/swaggest/swac
Usage: 
   swac js-client <schema>
   schema   Path/URL to OpenAPI/Swagger schema
   
Options: 
   --operations <operations>      Operations filter in form of comma-separated list of method/path, default empty         
   --ignore-operation-id          Ignore operationId and always name operations using method and path                     
   --client-name <clientName>     Name of generated client class, default APIClient                                       
   --types-prefix <typesPrefix>   Prefix generated jsdoc class names                                                      
   --out <out>                    Path to output files, default ./client                                                  
   --patches <patches...>         JSON patches to apply to schema file before processing, merge patches are also supported
```

[Examples](/examples/js-client).

```
swac js-client openapi.json --out ./ --client-name Backend --types-prefix xh
```

The generated client is a ES5 class using `XMLHttpRequest` and `jsdoc` type definitions without external dependencies
suitable for direct usage in browsers.
