<?php

namespace Rami\EntityKitBundle\EventListener\Slugged;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Persistence\ManagerRegistry;
use Rami\EntityKitBundle\Exceptions\PropertyDoesNotExistException;
use Rami\EntityKitBundle\Infra\Attributes\Slugged;
use Rami\EntityKitBundle\Infra\Interfaces\Slugged\SluggedInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

readonly class SluggedListener
{
    public function __construct(
        private ManagerRegistry $managerRegistry,
    )
    {
    }

    /**
     * @throws \ReflectionException
     * @throws PropertyDoesNotExistException
     */
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof SluggedInterface) {
            return;
        }

        $this->applySlug($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof SluggedInterface) {
            return;
        }
        $this->applySlug($entity);
    }

    /**
     * @throws \ReflectionException
     * @throws PropertyDoesNotExistException
     */
    private function applySlug($entity): void
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        if (!$propertyAccessor->isReadable($entity, 'slug')) {
            throw new PropertyDoesNotExistException();
        }

        $attribute = new \ReflectionClass($entity);
        $attribute = $attribute->getAttributes(Slugged::class)[0] ?? null;

        $attributes = $attribute->newInstance();

        if (null !== $entity->getSlug() && false === $attributes->shouldRegenerateOnUpdate) {
            return;
        }

        if (empty($attributes->fields)) return;

        $fields =  $attributes->fields;
        $separator = $attributes->separator;

        $slugFieds = null;

        foreach ($fields as $field) {
            if (!$propertyAccessor->isReadable($entity, $field)) {
                throw new PropertyDoesNotExistException();
            }
            $slugFieds[] = $propertyAccessor->getValue($entity, $field);
        }

        $slugFied = implode( ' ', $slugFieds);

        $slugger = new AsciiSlugger();

        $slugFied = $slugger->slug($slugFied, $separator)->lower();

        if (true === $attributes->ensureUnique) {
            $slugFied = $this->ensureUniqueSlug($entity, $slugFied, $separator);
        }

        $entity->setSlug($slugFied);
    }

    private function ensureUniqueSlug(object $entity, string $slug, $separator): string
    {
        $managerRegistry = $this->managerRegistry->getManagerForClass(get_class($entity));
        $count = 1;

        while (true) {
            $existing = $managerRegistry->getRepository(get_class($entity))->findOneBy(['slug' => $slug]);
            if (!$existing) {
                break;
            }
            $slug = $this->parseExistingSlug($slug, $separator, $count);
            $count++;
        }

        return $slug;
    }

    private function parseExistingSlug(string $slug, string $separator, int $count): string
    {
        $words = explode($separator, $slug);
        if ($words === $slug) {
            return $slug;
        }

        array_pop($words);

        if ($count == 1) {
            return $slug.$separator.$count;
        }

        return implode($separator, $words) . $separator . $count;
    }
}