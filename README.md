# Swagger 2.0 compiler

A tool to render API spec as code.

[![Build Status](https://travis-ci.org/swaggest/swac.svg?branch=master)](https://travis-ci.org/swaggest/swac)
[![codecov](https://codecov.io/gh/swaggest/swac/branch/master/graph/badge.svg)](https://codecov.io/gh/swaggest/swac)
[![Image Size](https://images.microbadger.com/badges/image/swaggest/swac.svg)](https://microbadger.com/images/swaggest/swac)
![Code lines](https://sloc.xyz/github/swaggest/swac/?category=code)
![Comments](https://sloc.xyz/github/swaggest/swac/?category=comments)

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

[Examples](/examples/php-client).

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

## Roadmap

* OpenAPI 3.0 support