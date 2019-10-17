<?php

namespace Swac\Php\Client\Template;

use Swac\Rest\ApiKeySecurity;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\NamedReference;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpConstant;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\PhpCodeBuilder\Property\Setter;
use Swaggest\RestClient\AbstractConfig;
use Swaggest\RestClient\Security\ApiKey;

class ConfigClass extends PhpClass
{
    /** @var PhpApp */
    private $app;

    private $namespace;

    /**
     * ConfigClass constructor.
     * @param PhpApp $app
     * @param string $namespace
     */
    public function __construct(PhpApp $app, $namespace)
    {
        $this->app = $app;
        $this->namespace = $namespace;

        $this->setExtends(PhpClass::byFQN(AbstractConfig::class));
    }

    public function setBaseUrl($baseUrl)
    {
        $prop = new PhpClassProperty('baseUrl', PhpStdType::string(), PhpFlags::VIS_PROTECTED);
        $prop->setDefault($baseUrl);
        $this->addProperty($prop);
    }

    public function addApiKeySecurity(ApiKeySecurity $apiKeySecurity)
    {
        $propName = PhpCode::makePhpName($apiKeySecurity->name);

        $nameConst = new PhpConstant(PhpCode::makePhpConstantName($apiKeySecurity->name), $apiKeySecurity->name);
        $this->addConstant($nameConst);

        $secClass = new PhpClass();
        $secClass->setName(PhpCode::makePhpName($apiKeySecurity->name, false));
        $secClass->setExtends(PhpClass::byFQN(ApiKey::class));
        $secClass->setNamespace($this->namespace . '\Security');
        $prop = new PhpClassProperty('name', PhpStdType::string(), PhpFlags::VIS_PROTECTED);
        $prop->setDefault($apiKeySecurity->paramName);
        $secClass->addProperty($prop);
        $prop = new PhpClassProperty('in', PhpStdType::string(), PhpFlags::VIS_PROTECTED);
        $prop->setDefault(new NamedReference('IN_' . strtoupper($apiKeySecurity->paramIn),
            PhpClass::byFQN(ApiKey::class)));
        $secClass->addProperty($prop);

        $prop = new PhpClassProperty(
            $propName,
            $secClass,
            PhpFlags::VIS_PROTECTED
        );

        $setter = new Setter($prop);
        $setter->setBody(<<<PHP
\$this->security[self::{$nameConst->getName()}] = \${$propName};
return \$this;
PHP
        );
        $this->addMethod($setter);
        $this->app->addClass($secClass);
    }

}