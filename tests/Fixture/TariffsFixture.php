<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TariffsFixture
 */
class TariffsFixture extends TestFixture
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
                'article_type_id' => 1,
                'service_id' => 1,
                'price' => 1,
                'created' => '2026-11-16 12:23:08',
                'modified' => '2026-11-16 12:23:08',
            ],
        ];
        parent::init();
    }
}
