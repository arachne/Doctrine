<?php

declare(strict_types=1);

namespace Tests\Functional\Fixtures;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToOne;
use Kdyby\Doctrine\Entities\Attributes\Identifier;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @Entity()
 */
class Article
{
    use Identifier;

    /**
     * @Column()
     * @NotBlank()
     *
     * @var string
     */
    private $name;

    /**
     * @OneToOne(targetEntity="Page", mappedBy="article")
     *
     * @var Page
     */
    private $page;

    public function getName(): string
    {
        return $this->name;
    }

    public function getPage(): Page
    {
        return $this->page;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPage(Page $page): void
    {
        $this->page = $page;
    }
}
