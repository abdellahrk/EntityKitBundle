Tracks the ip of who created and updated an entity

```php
use Rami\EntityKitBundle\Common\Interfaces\IpTagged\IpTaggedInterface;
use Rami\EntityKitBundle\Entity\Traits\IpTaggedTrait;

class Blog implements IpTaggedInterface 
{
    use IpTaggedTrait;
    ...
}
```

This creates a `created_from_ip` and `updated_from_ip` columns and sets them according
