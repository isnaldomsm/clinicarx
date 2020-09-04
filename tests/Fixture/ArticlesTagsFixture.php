<?php
namespace Rx\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticlesTagsFixture
 *
 */
class ArticlesTagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'article_id' => ['type' => 'integer', 'null' => false],
        'tag_id' => ['type' => 'integer', 'null' => false],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['article_id', 'tag_id']],
            'sqlite_autoindex_articles_tags_1' => ['type' => 'unique', 'columns' => ['article_id', 'tag_id']],
            'tag_id_fk' => ['type' => 'foreign', 'columns' => ['tag_id'], 'references' => ['tags', 'id']],
            'article_id_fk' => ['type' => 'foreign', 'columns' => ['article_id'], 'references' => ['articles', 'id']],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'article_id' => 1,
                'tag_id' => 1
            ],
        ];
        parent::init();
    }
}
