This keeps track of who created and who modified an entity.

using the defaults:

```php
use Rami\EntityKitBundle\Common\Interfaces\Authored\AuthoredInterface;
use \Rami\EntityKitBundle\Entity\Traits\MappedAuthoredTrait;

class Blog implements AuthoredInterface 
{
    use MappedAuthoredTrait
    ...
}
```

to define your mappings, use `AuthoredTrait` instead

```php
use Doctrine\ORM\Mapping as ORM;use Rami\EntityKitBundle\Common\Interfaces\Authored\AuthoredInterface;
use \Rami\EntityKitBundle\Entity\Traits\AuthoredTrait;
use Doctrine\ORM\Mapping as ORM;

class Blog implements AuthoredInterface 
{
    use AuthoredTrait
    
    #[ORM\Column()] <-- define your mapping
    protected ?string $createdBy = null;
    
    #[ORM\Column()] <-- define your mapping
    protected ?string $updatedBy = null;
}
```


This creates a `created_by` and `updated_by` columns automatically keep track of these.