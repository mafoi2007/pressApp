<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'role' => 'Lorem ipsum dolor sit amet',
                'is_active' => 1,
                'created' => '2026-11-16 12:22:01',
                'modified' => '2026-11-16 12:22:01',
            ],
        ];
        parent::init();
    }
}
