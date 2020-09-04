<?php
namespace Rx\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Rx\Model\Table\ArticlesTagsTable;

/**
 * Rx\Model\Table\ArticlesTagsTable Test Case
 */
class ArticlesTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Rx\Model\Table\ArticlesTagsTable
     */
    public $ArticlesTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ArticlesTags',
        'app.Articles',
        'app.Tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ArticlesTags') ?
            [] : ['className' => ArticlesTagsTable::class];

        $this->ArticlesTags = TableRegistry::getTableLocator()
            ->get('ArticlesTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArticlesTags);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $articleTag = $this->ArticlesTags->newEntity(
            [
                'article_id' => 10,
                'tag_id' => 10,
            ]
        );
        $this->assertFalse($articleTag->hasErrors());

        $this->ArticlesTags->save($articleTag);
        $this->assertTrue($articleTag->hasErrors());
        $this->assertArrayHasKey(
            '_existsIn',
            $articleTag->getError('article_id')
        );
        $this->assertArrayHasKey(
            '_existsIn',
            $articleTag->getError('tag_id')
        );
    }
}
