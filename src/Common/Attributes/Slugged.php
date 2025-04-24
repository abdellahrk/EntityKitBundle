<?php

namespace Rami\EntityKitBundle\Common\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Slugged
{
    public function __construct(
        public ?array $fields = [],
        public ?string $prefix = null,
        public ?string $suffix = null,
        public bool         $ensureUnique = true,
        public string       $separator = '-',
        public bool         $shouldRegenerateOnUpdate = false
    ) {}
}