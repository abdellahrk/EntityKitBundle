This keeps track of timestamp of the lifecycle of a model.

```php
use Rami\EntityKitBundle\Infra\Interfaces\TimeStamped\TimeStampedInterface;
use Rami\EntityKitBundle\Entity\Traits\TimeStampedTrait;

class Blog implements TimeStampedInterface 
{
    use TimeStampedTrait;
    ...
}
```

This creates a `created_at` and `updated_at` columns and keep track of these.