To generate a uuid v4 on your entity

```php
use Rami\EntityKitBundle\Common\Interfaces\Uuid\UuidInterface;
use Rami\EntityKitBundle\Entity\Traits\UuidTrait;

class Blog implements UuidInterface 
{
    use UuidTrait;
}
```
This adds a `$uuid` variable with getter and setter and generates a uuid v4 for the entity