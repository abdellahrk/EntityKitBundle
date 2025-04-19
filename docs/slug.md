The slug is useful to generate url

```php
use Rami\EntityKitBundle\Common\Interfaces\Slugged\SluggedInterface;
use Rami\EntityKitBundle\Entity\Traits\SluggedTrait;
use Rami\EntityKitBundle\Common\Attributes\Slugged;

#[Slugged(fields: ['title'])]
class Blog implements SluggedInterface 
{
    use SluggedTrait;
    
    #[ORM\Column(...)] <-- Your Mapping
    protected ?string slug = null;
}
```

if you want the default mapping, use `MappedSluggedTrait` instead of `SluggedTrait` and you won't have to define the `slug` property in your Entity

The attribute has some default params.
```markdown
fields: [] // An array of fields the entity has for slug generation
ensureUnique: true // True by default. if a slug exists, it appends an incremental number at the end
separator: '-' // defaults to '-'
shouldRegenerateOnUpdate: false // False by default
```