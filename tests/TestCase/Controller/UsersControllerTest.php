<?php

namespace Rx\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Rx\Controller\UsersController Test Case
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users',
        'app.Articles'
    ];

    public function setUp()
    {
        parent::setUp();

        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/users');

        $this->assertResponseOk();
        $response = json_decode((string)$this->_response->getBody(), true);
        $this->assertCount(2, $response['users']);
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/users/1');

        $this->assertResponseOk();
        $expected = [
            'user' => [
                'id' => 1,
                'email' => 'admin@rxsaude.com.br',
                'created' => '2019-03-18T01:12:08+00:00',
                'modified' => '2019-03-19T20:32:11+00:00',
                'articles' => [
                    [
                        'id' => 1,
                        'user_id' => 1,
                        'title' => 'Primeiro post',
                        'slug' => 'primeiro-post',
                        'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                        'published' => true,
                        'created' => '2019-03-19T01:12:07+00:00',
                        'modified' => '2019-03-19T01:12:07+00:00'
                    ],
                    [
                        'id' => 2,
                        'user_id' => 1,
                        'title' => 'Segundo post não publicado',
                        'slug' => 'segundo-post',
                        'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                        'published' => false,
                        'created' => '2019-03-19T01:12:07+00:00',
                        'modified' => '2019-03-19T01:12:07+00:00'
                    ]
                ]
            ],
        ];
        $expected = json_encode($expected, JSON_PRETTY_PRINT);
        $response = (string)$this->_response->getBody();
        $this->assertEquals($expected, $response);
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'email' => 'new@rxsaude.com.br',
            'password' => 'new_secredo',
        ];
        $this->enableCsrfToken();
        $this->post('/users', $data);

        $this->assertResponseSuccess();
        $articles = TableRegistry::getTableLocator()->get('Users');
        $query = $articles->find()->where(['email' => $data['email']]);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $data = [
            'email' => 'admin1@rxsaude.com.br',
        ];
        $this->enableCsrfToken();
        $this->put('/users/1', $data);

        $this->assertResponseSuccess();
        $articles = TableRegistry::getTableLocator()->get('Users');
        $query = $articles->find()->where(['email' => $data['email']]);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->delete('/users/1');

        $this->assertResponseSuccess();
        $articles = TableRegistry::getTableLocator()->get('Users');
        $query = $articles->find()->where(['id' => 1]);
        $this->assertEquals(0, $query->count());
    }
}
