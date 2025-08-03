### Add Soft Delete to entities 
This adds deletedAt property and exclude from Doctrine fetch results

Add `SoftDeleteTrait` to your entities

```php
use \Rami\EntityKitBundle\Entity\Traits\SoftDeleteTrait

class Blog 
{
    use SoftDeleteTrait;
    
    ...
}
```

### Disable soft delete
Soft delete is enabled by default when added to an entity. To disable it, set the `enabled` flag to `false`
```yaml
entity_kit:
  soft_delete:
    enabled: false
```

This removes the constraint on the query and returns the entities with non null deleted_at field

### Exclude some uris
```yaml
entity_kit:
  soft_delete:
    excludeUris:
      - /admin
      - /deleted-users   
```

If you want the admin to show the deleted users, simply exclude the uri in the `entity_kit` parameter like `/admin`