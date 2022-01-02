<?php

namespace Swac;

use Swaggest\JsonSchema\Schema;

class Util
{
    /**
     * @param Schema $schema
     * @param string $type
     * @todo move to swaggest/json-schema
     */
    public static function hasType($schema, $type)
    {
        if ($schema === null || $schema->type === null) {
            return false;
        }

        if (is_array($schema->type)) {
            return in_array($type, $schema->type);
        }

        return $schema->type === $type;
    }
}