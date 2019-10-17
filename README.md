# Swagger 2.0 compiler

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
docker run swaggest/swac swac --help
```
```
v0.0.2 swac
OpenAPI/Swagger compiler, https://github.com/swaggest/swac
Usage: 
   swac <action>
   action   Action name                                 
            Allowed values: php-guzzle-client, go-client
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
v0.0.1 swac php-guzzle-client
Usage: 
   swac php-guzzle-client <schemaPath> --namespace <namespace>
   schemaPath   Path to swagger.json
   
Options: 
   --project-path <projectPath>   Path to project root, default ./                                               
   --namespace <namespace>        Project namespace                                                              
   --operations <operations>      Operations filter in form of comma-separated list of method/path, default empty
 ```

Generated client depends on [`swaggest/rest-client`](https://github.com/swaggest/php-rest-client), `guzzlehttp/guzzle` 6, 
and [`swaggest/json-schema`](https://github.com/swaggest/php-json-schema).


[Examples](/examples/php-guzzle-client).

### Go Client

```
swac go-client --help 
```
```
v0.0.1 swac go-client
Usage: 
   swac go-client <schemaPath>
   schemaPath   Path to swagger.json
   
Options: 
   --out <out>                 Path to output package, default ./client                                       
   --pkg-name <pkgName>        Output package name, default "client"                                          
   --operations <operations>   Operations filter in form of comma-separated list of method/path, default empty
```

[Examples](/examples/go-client).

Generated client is a single package without external dependencies.

## Roadmap

* OpenAPI 3.0 support
