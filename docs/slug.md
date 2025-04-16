The slug is useful to generate url

```php
use Rami\EntityKitBundle\Infra\Interfaces\Slugged\SluggedInterface;
use Rami\EntityKitBundle\Entity\Traits\SluggedTrait;
use Rami\EntityKitBundle\Infra\Attributes\Slugged;

#[Slugged(fields: ['title'])]
class Blog implements SluggedInterface 
{
    use SluggedTrait;
}
```

The attribute has some default params.
```markdown
fields: [] // An array of fields the entity has for slug generation
ensureUnique: true // True by default. if a slug exists, it appends an incremental number at the end
separator: '-' // defaults to '-'
shouldRegenerateOnUpdate: false // False by default
```