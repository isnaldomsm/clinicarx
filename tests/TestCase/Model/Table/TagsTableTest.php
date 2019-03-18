<?php
namespace Rx\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Rx\Model\Table\TagsTable;

/**
 * Rx\Model\Table\TagsTable Test Case
 */
class TagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Rx\Model\Table\TagsTable
     */
    public $Tags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Tags',
        'app.Articles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Tags') ? [] :
            ['className' => TagsTable::class];

        $this->Tags = TableRegistry::getTableLocator()->get('Tags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tags);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->assertCount(2, $this->Tags->getValidator('default'));

        $article = $this->Tags->newEntity(
            [
                'id' => 1,
            ]
        );

        $this->assertTrue($article->hasErrors());
        $this->assertArrayHasKey(
            '_required',
            $article->getError('title')
        );
    }
}
