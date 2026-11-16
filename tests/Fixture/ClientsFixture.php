<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientsFixture
 */
class ClientsFixture extends TestFixture
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
                'address' => 'Lorem ipsum dolor sit amet',
                'neighborhood' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-11-16 12:21:50',
                'modified' => '2026-11-16 12:21:50',
            ],
        ];
        parent::init();
    }
}
