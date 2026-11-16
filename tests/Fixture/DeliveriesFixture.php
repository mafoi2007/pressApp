<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DeliveriesFixture
 */
class DeliveriesFixture extends TestFixture
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
                'courier_id' => 1,
                'delivery_type' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'fee' => 1,
                'scheduled_at' => '2026-11-16 12:25:17',
                'completed_at' => '2026-11-16 12:25:17',
                'status' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-11-16 12:25:17',
                'modified' => '2026-11-16 12:25:17',
            ],
        ];
        parent::init();
    }
}
