### Auditing
Adds created_at, updated_at, created_by, and updated_by fields

Use this if you want your entities to populate at once these fields

```php
use Rami\EntityKitBundle\Contract\AuditingInterface;
use \Rami\EntityKitBundle\Entity\Traits\AuditingTrait;

class Blog implements AuditingInterface 
{
    use AuditingTrait;
    ...
}
```
