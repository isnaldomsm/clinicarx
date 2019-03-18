<?php
namespace Rx\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticlesFixture
 *
 */
class ArticlesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'null' => false, 'autoIncrement' => true],
        'user_id' => ['type' => 'integer', 'null' => false],
        'title' => ['type' => 'string', 'length' => 255, 'null' => false],
        'slug' => ['type' => 'string', 'length' => 191, 'null' => false],
        'body' => ['type' => 'text', 'null' => true],
        'published' => ['type' => 'boolean', 'null' => true, 'default' => false],
        'created' => ['type' => 'datetime', 'null' => true],
        'modified' => ['type' => 'datetime', 'null' => true],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
            'user_id_fk' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id']],
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
                'id' => 1,
                'user_id' => 1,
                'title' => 'Primeiro post',
                'slug' => 'primeiro-post',
                'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'published' => true,
                'created' => '2019-03-19 01:12:07',
                'modified' => '2019-03-19 01:12:07'
            ],
        ];
        parent::init();
    }
}
