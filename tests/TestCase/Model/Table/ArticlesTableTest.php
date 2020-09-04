<?php
namespace Rx\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Rx\Model\Table\ArticlesTable;

/**
 * Rx\Model\Table\ArticlesTable Test Case
 */
class ArticlesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Rx\Model\Table\ArticlesTable
     */
    public $Articles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Articles',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('Articles') ? [] :
            ['className' => ArticlesTable::class];

        $this->Articles = TableRegistry::getTableLocator()
            ->get('Articles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Articles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->assertCount(6, $this->Articles->getValidator('default'));

        $article = $this->Articles->newEntity(
            [
                'id' => 1,
            ]
        );

        $this->assertTrue($article->hasErrors());
        $this->assertArrayHasKey(
            '_required',
            $article->getError('user_id')
        );
        $this->assertArrayHasKey(
            '_required',
            $article->getError('title')
        );
        $this->assertArrayHasKey(
            '_required',
            $article->getError('slug')
        );
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $article = $this->Articles->newEntity(
            [
                'user_id' => 0,
                'title' => 'Segundo Post',
                'slug' => 'sec-post'
            ]
        );
        $this->assertFalse($article->hasErrors());

        $this->Articles->save($article);
        $this->assertTrue($article->hasErrors());
        $this->assertArrayHasKey(
            '_existsIn',
            $article->getError('user_id')
        );
    }
}
