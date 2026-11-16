<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'ticket_number' => 'Lorem ipsum dolor sit amet',
                'client_id' => 1,
                'user_id' => 1,
                'deposited_at' => '2026-11-16 12:23:23',
                'pickup_due_at' => '2026-11-16',
                'picked_up_at' => '2026-11-16 12:23:23',
                'status' => 'Lorem ipsum dolor sit amet',
                'discount' => 1,
                'observation' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2026-11-16 12:23:23',
                'modified' => '2026-11-16 12:23:23',
            ],
        ];
        parent::init();
    }
}
