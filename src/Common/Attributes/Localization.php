<?php

namespace Rami\EntityKitBundle\Common\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Localization
{
    /**
     * @param array $locales
     */
    public function __construct(public string $defaultLocale, public array $locales = []) {}
}
