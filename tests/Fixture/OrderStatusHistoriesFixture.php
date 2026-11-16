<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrderStatusHistoriesFixture
 */
class OrderStatusHistoriesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'order_id' => 1,
                'user_id' => 1,
                'old_status' => 'Lorem ipsum dolor sit amet',
                'new_status' => 'Lorem ipsum dolor sit amet',
                'changed_at' => '2026-11-16 12:26:16',
                'created' => '2026-11-16 12:26:16',
                'modified' => '2026-11-16 12:26:16',
            ],
        ];
        parent::init();
    }
}
