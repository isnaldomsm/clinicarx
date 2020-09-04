<?php

namespace Rx\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Rx\Controller\ArticlesController Test Case
 */
class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Articles',
        'app.Users',
        'app.Tags',
        'app.ArticlesTags'
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
        $this->get('/articles');

        $this->assertResponseOk();
        $response = json_decode((string)$this->_response->getBody(), true);
        $this->assertCount(1, $response['articles']);

        foreach ($response['articles'] as $article) {
            $this->assertTrue($article['published']);
        }
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/articles/1');

        $this->assertResponseOk();
        $expected = [
            'article' => [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Primeiro post',
                'slug' => 'primeiro-post',
                'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'published' => true,
                'created' => '2019-03-19T01:12:07+00:00',
                'modified' => '2019-03-19T01:12:07+00:00',
                'tags' => [
                    [
                        'id' => 1,
                        'title' => 'tag1',
                        'created' => '2019-03-18T01:12:08+00:00',
                        'modified' => '2019-03-18T01:12:08+00:00',
                        '_joinData' => [
                            'article_id' => 1,
                            'tag_id' => 1,
                        ]
                    ]
                ],
                'user' => [
                    'id' => 1,
                    'email' => 'admin@rxsaude.com.br',
                    'created' => '2019-03-18T01:12:08+00:00',
                    'modified' => '2019-03-19T20:32:11+00:00'
                ],
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
            'user_id' => 1,
            'published' => true,
            'slug' => 'new-article',
            'title' => 'New Article',
            'body' => 'New Body'
        ];
        $this->enableCsrfToken();
        $this->post('/articles', $data);

        $this->assertResponseSuccess();
        $articles = TableRegistry::getTableLocator()->get('Articles');
        $query = $articles->find()->where(['title' => $data['title']]);
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
            'slug' => 'new-article',
            'title' => 'New Article',
            'body' => 'New Body'
        ];
        $this->enableCsrfToken();
        $this->put('/articles/1', $data);

        $this->assertResponseSuccess();
        $articles = TableRegistry::getTableLocator()->get('Articles');
        $query = $articles->find()->where(['title' => $data['title']]);
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
        $this->delete('/articles/1');

        $this->assertResponseSuccess();
        $articles = TableRegistry::getTableLocator()->get('Articles');
        $query = $articles->find()->where(['id' => 1]);
        $this->assertEquals(0, $query->count());
    }
}
