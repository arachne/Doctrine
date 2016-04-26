<?php

namespace Tests\Functional;

use Arachne\EntityLoader\EntityLoader;
use Codeception\TestCase\Test;
use Tests\Functional\Classes\Article;
use Tests\Functional\Classes\ArticleQuery;

class FilterInTest extends Test
{
    public function testId()
    {
        $entityLoader = $this->guy->grabService(EntityLoader::class);
        $article = $entityLoader->filterIn(Article::class, 1);
        $this->assertInstanceOf(Article::class, $article);
        $this->assertSame($article->getId(), 1);
    }

    public function testArray()
    {
        $entityLoader = $this->guy->grabService(EntityLoader::class);
        $article = $entityLoader->filterIn(Article::class, [
            'name' => 'Lorem Ipsum',
        ]);
        $this->assertInstanceOf(Article::class, $article);
        $this->assertSame($article->getId(), 1);
    }

    public function testQuery()
    {
        $entityLoader = $this->guy->grabService(EntityLoader::class);
        $article = $entityLoader->filterIn(Article::class, new ArticleQuery());
        $this->assertInstanceOf(Article::class, $article);
        $this->assertSame($article->getId(), 1);
    }

    /**
     * @expectedException Nette\Application\BadRequestException
     * @expectedExceptionMessage Desired entity of type 'Tests\Functional\Classes\Article' could not be found.
     */
    public function testError()
    {
        $entityLoader = $this->guy->grabService(EntityLoader::class);
        $entityLoader->filterIn(Article::class, 2);
    }
}