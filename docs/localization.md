# Localization made simple

Start by activating the localization with default locale and available locales

```php
<?php

namespace App\Entity;

use Rami\EntityKitBundle\Common\Attributes\Localization;

#[Localization(defaultLocale: 'en', availableLocales: ['fr', 'es'])]
class Blog 
{
    ...
}
```

Then add the LocalizationTrait and run the migration to add fields supporting localizations

```php
<?php

namespace App\Entity;

use Rami\EntityKitBundle\Common\Attributes\Localization;
use Rami\EntityKitBundle\Entity\Traits\LocalizationTrait;

#[Localization(defaultLocale: 'en', availableLocales: ['fr', 'es'])]
class Blog 
{
    use LocalizationTrait;
    ...
}
```

Finally, localize your fields:

```php
<?php

namespace App\Entity;

use Rami\EntityKitBundle\Common\Attributes\Localization;
use Rami\EntityKitBundle\Entity\Traits\LocalizationTrait;
use Rami\EntityKitBundle\Common\Attributes\Localize;

#[Localization(defaultLocale: 'en', availableLocales: ['fr', 'es'])]
class Blog 
{
    use LocalizationTrait;

    #[Localize]
    #[ORM\Column(length: 255)]
    public ?string $title = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    #[Localize]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    ...
}
```

In your controller/service, you can add a new version of your entity by setting the new locale, then adding then populating the fields...

```php
public function createArticle(): Response
{
    $blog->setTitle('Article in English')
    $blog->setContent('This article is in English');
    $entityManager->persist($blog);
    $entityManager->flush();

    # Add a new version in French
    $blog->setLocale('fr');
    $blog->setTitle('Article en Français');
    $blog->setContent('Cet article est en Français');
    $entityManager->flush();

    # Add a new version in Spanish
    $blog->setLocale('es');
    ...
}
```

You can get a single translated field

```php
 $localizedTitle = $blog->getLocalizedField('title', 'fr');
 // returns title in French
```

You can get all locales with their translations
```php
$localesWithContents = $blog->getLocalizations();
// returns all locales with their fields
```

Get contents for a single locale
```php
$frenchContent = $blog->getLocaleContents('fr');
// Returns French localized content
```
