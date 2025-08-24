Singleton
-
Add a singleton entity where only one entity can be created or new entities cannot be created if one or more already exists.

This is good for an app configuration saved in the database

use the `Singleton` attribute on your entity class

```php
use Rami\EntityKitBundle\Common\Attributes\Singleton

#[Singleton]
class Blog 
{
  // properties omitted
}
```

This prevents new entities of type `Blog` from being created.