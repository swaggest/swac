<?php

namespace Swac\Rest;

use Swaggest\JsonSchema\Schema;

class Parameter
{
    const QUERY = 'query';
    const PATH = 'path';
    const HEADER = 'header';
    const FORM_DATA = 'formData';
    const COOKIE = 'cookie';
    const BODY = 'body';

    const COLLECTION_FORMAT = 'collectionFormat';

    const CSV = 'csv';
    const SSV = 'ssv';
    const TSV = 'tsv';
    const PIPES = 'pipes';
    const MULTI = 'multi';


    /** @var string */
    public $name;

    /** @var string */
    public $in;

    /** @var string */
    public $description;

    /** @var bool */
    public $required;

    /** @var bool */
    public $deprecated;

    /** @var Schema */
    public $schema;

    /** @var mixed[] */
    public $examples;

    /** @var bool indicates that parameter is a file to upload */
    public $isFile;

    /** @var bool indicates that parameter is an array of files to upload */
    public $isFiles;

    /** @var string */
    public $collectionFormat;

    /** @var mixed[] map of blackboxed context data */
    public $meta = [];

    /** @var bool indicates if parameter value is JSON encoded */
    public $isJson = false;
}