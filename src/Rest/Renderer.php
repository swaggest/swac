<?php

namespace Swac\Rest;

interface Renderer
{
    public function setConfig(Config $config);

    public function addOperation(Operation $operation);
}