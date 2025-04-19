This keeps track of timestamp of the lifecycle of a model.

using the default mapping

```php
use Rami\EntityKitBundle\Common\Interfaces\TimeStamped\TimeStampedInterface;
use Rami\EntityKitBundle\Entity\Traits\MappedTimeStampedTrait;

class Blog implements TimeStampedInterface 
{
    use MappedTimeStampedTrait;
    ...
}
```

This creates a `created_at` and `updated_at` columns and keep track of these.

Using your custom mapping

```php
use Rami\EntityKitBundle\Common\Interfaces\TimeStamped\TimeStampedInterface;
use Rami\EntityKitBundle\Entity\Traits\MappedTimeStampedTrait;
use Doctrine\ORM\Mapping as ORM;

class Blog implements TimeStampedInterface 
{
    use TimeStampedTrait;
    
    #[ORM\Column()] <-- Your mapping
    protected ?DateTimeImmutable $createdAt = null;
    
    #[ORM\Column()] <-- Your mapping
    protected ?DateTimeImmutable $updatedAt = null;
}
```