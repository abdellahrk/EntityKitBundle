<?php

/*
 * Copyright (c) 2026.
 *
 * This file is part of the Entity Kit Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\EntityKitBundle\Tests\Functional\Localization;

use Rami\EntityKitBundle\Common\Attributes\Localization;
use Rami\EntityKitBundle\Tests\Util\App\BaseKernel;
use ReflectionClass;
use Rami\EntityKitBundle\Tests\Util\Entity\Localization\News;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

class LocalizedEntityTest extends BaseKernel
{
    public function testdefaultLocaleDefined(): void
    {
        $news = new News();

        $news->setTitle("Hello");
        $news->setContent("This is an awesome article");

        $reflection = new ReflectionClass($news);

        $localization = $reflection->getAttributes(Localization::class)[0]?->newInstance();

        assertNotNull($localization, "Localization not configured");
    }

    public function testSwitchingBackToDefaultLocale(): void
    {
        $news = new News();
        $news->setLocale("en");
        $news->setTitle("English Title");
        $news->setContent("This is an awesome article");

        $this->entityManager->persist($news);
        $this->entityManager->flush();

        $news->setLocale("fr");
        $news->setTitle("Titre Français");
        $this->entityManager->flush();

        $this->entityManager->clear();
        $fetchedArticle = $this->entityManager->find(News::class, $news->getId());

        assertEquals("English Title", $fetchedArticle->getTitle());

        assertEquals("Titre Français", $fetchedArticle->getLocalizedField("title", "fr"));
    }

    public function testFieldTranslation(): void
    {
        $news = new News();

        $news->setTitle("Hello");
        $news->setContent("This is an awesome article");

        $reflection = new ReflectionClass($news);

        $localization = $reflection->getAttributes(Localization::class)[0]?->newInstance();

        $this->entityManager->persist($news);
        $this->entityManager->flush();

        $news->setLocale("fr");
        $news->setTitle("Bonjour");
        $this->entityManager->flush();

        $articleTitle = $news->getLocalizedField("title", "fr");
        assertEquals($articleTitle, "Bonjour");

        $this->entityManager->remove($news);
        $this->entityManager->flush();
        $this->entityManager->close();
    }
}
