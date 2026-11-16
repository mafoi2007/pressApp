<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TariffsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TariffsTable Test Case
 */
class TariffsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TariffsTable
     */
    protected $Tariffs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Tariffs',
        'app.ArticleTypes',
        'app.Services',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tariffs') ? [] : ['className' => TariffsTable::class];
        $this->Tariffs = $this->getTableLocator()->get('Tariffs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tariffs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TariffsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\TariffsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
