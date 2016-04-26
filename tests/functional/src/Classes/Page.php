<?php

namespace Tests\Functional\Classes;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToOne;
use Kdyby\Doctrine\Entities\Attributes\Identifier;

/**
 * @Entity()
 */
class Page
{
    use Identifier;

    /**
     * @OneToOne(targetEntity="Article", inversedBy="page")
     * @var Article
     */
    private $article;

    public function getArticle()
    {
        return $this->article;
    }
}