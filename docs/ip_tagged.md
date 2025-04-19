Tracks the ip of who created and updated an entity

using the default mapping
```php
use Rami\EntityKitBundle\Common\Interfaces\IpTagged\IpTaggedInterface;
use Rami\EntityKitBundle\Entity\Traits\MappedIpTaggedTrait;

class Blog implements IpTaggedInterface 
{
    use MappedIpTaggedTrait;
    ...
}
```

This creates a `created_from_ip` and `updated_from_ip` columns and sets them according

To define your custom mapping, use `IpTaggedTrait`

```php
use Rami\EntityKitBundle\Common\Interfaces\IpTagged\IpTaggedInterface;
use Rami\EntityKitBundle\Entity\Traits\IpTaggedTrait;
use Doctrine\ORM\Mapping as ORM;

class Blog implements IpTaggedInterface 
{
    use IpTaggedTrait;
    
    #[ORM\Column()] <-- Your mapping
    protected ?string $createdFromIp = null;
    
    #[ORM\Column()] <-- Your mapping
    protected ?stirng $updatedFromIp = null
}
```