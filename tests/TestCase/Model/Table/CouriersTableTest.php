<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CouriersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CouriersTable Test Case
 */
class CouriersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CouriersTable
     */
    protected $Couriers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Couriers',
        'app.Deliveries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Couriers') ? [] : ['className' => CouriersTable::class];
        $this->Couriers = $this->getTableLocator()->get('Couriers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Couriers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CouriersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\CouriersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
