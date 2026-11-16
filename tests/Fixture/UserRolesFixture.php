<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserRolesFixture
 */
class UserRolesFixture extends TestFixture
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
                'role_type' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-11-16 13:52:44',
                'modified' => '2026-11-16 13:52:44',
            ],
        ];
        parent::init();
    }
}
