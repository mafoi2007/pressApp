<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticleTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArticleTypesTable Test Case
 */
class ArticleTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArticleTypesTable
     */
    protected $ArticleTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.ArticleTypes',
        'app.OrderItems',
        'app.Tariffs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ArticleTypes') ? [] : ['className' => ArticleTypesTable::class];
        $this->ArticleTypes = $this->getTableLocator()->get('ArticleTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ArticleTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ArticleTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ArticleTypesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
