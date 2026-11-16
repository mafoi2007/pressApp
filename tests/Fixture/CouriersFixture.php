<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CouriersFixture
 */
class CouriersFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'is_active' => 1,
                'created' => '2026-11-16 12:25:37',
                'modified' => '2026-11-16 12:25:37',
            ],
        ];
        parent::init();
    }
}
