<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderStatusHistoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderStatusHistoriesTable Test Case
 */
class OrderStatusHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderStatusHistoriesTable
     */
    protected $OrderStatusHistories;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.OrderStatusHistories',
        'app.Orders',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderStatusHistories') ? [] : ['className' => OrderStatusHistoriesTable::class];
        $this->OrderStatusHistories = $this->getTableLocator()->get('OrderStatusHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderStatusHistories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\OrderStatusHistoriesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\OrderStatusHistoriesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
