This keeps track of who created and who modified an entity.

```php
use Rami\EntityKitBundle\Common\Interfaces\Authored\AuthoredInterface;
use \Rami\EntityKitBundle\Entity\Traits\AuthoredTrait;

class Blog implements AuthoredInterface 
{
    use Traits\AuthoredTrait
    ...
}
```

This creates a `created_by` and `updated_by` columns automatically keep track of these.