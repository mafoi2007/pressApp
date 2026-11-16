<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 */
class PaymentsFixture extends TestFixture
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
                'amount' => 1,
                'payment_method' => 'Lorem ipsum dolor sit amet',
                'paid_at' => '2026-11-16 12:24:51',
                'created' => '2026-11-16 12:24:51',
                'modified' => '2026-11-16 12:24:51',
            ],
        ];
        parent::init();
    }
}
