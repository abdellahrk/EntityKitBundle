<?php

namespace Rami\EntityKitBundle\Infra\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Slugged
{
    public function __construct(
        public ?array $fields = [],
        public bool         $ensureUnique = true,
        public string       $separator = '-',
        public bool         $shouldRegenerateOnUpdate = false
    ) {}
}