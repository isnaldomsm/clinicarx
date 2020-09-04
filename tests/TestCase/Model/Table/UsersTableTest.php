<?php
namespace Rx\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Rx\Model\Table\UsersTable;

/**
 * Rx\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Rx\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('Users') ? [] :
            ['className' => UsersTable::class];

        $this->Users = TableRegistry::getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->assertCount(3, $this->Users->getValidator('default'));

        $user = $this->Users->newEntity(
            [
                'email' => 'blablabla',
            ]
        );

        $this->assertTrue($user->hasErrors());
        $this->assertArrayHasKey(
            'email',
            $user->getError('email')
        );
        $this->assertArrayHasKey(
            '_required',
            $user->getError('password')
        );
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $user = $this->Users->newEntity(
            [
                'email' => 'admin@rxsaude.com.br',
                'password' => '123'
            ]
        );
        $this->assertFalse($user->hasErrors());

        $this->Users->save($user);
        $this->assertTrue($user->hasErrors());
        $this->assertArrayHasKey(
            '_isUnique',
            $user->getError('email')
        );
    }
}
