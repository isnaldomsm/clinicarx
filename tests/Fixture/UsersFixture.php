<?php
namespace Rx\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'null' => false, 'autoIncrement' => true],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false],
        'created' => ['type' => 'datetime', 'null' => true],
        'modified' => ['type' => 'datetime', 'null' => true],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
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
                'email' => 'admin@rxsaude.com.br',
                'password' => 'admin_secredo',
                'created' => '2019-03-18 01:12:08',
                'modified' => '2019-03-19 20:32:11'
            ],
            [
                'id' => 2,
                'email' => 'user@rxsaude.com.br',
                'password' => 'user_secredo',
                'created' => '2019-03-19 11:32:00',
                'modified' => '2019-03-25 14:12:25'
            ],
        ];
        parent::init();
    }
}
