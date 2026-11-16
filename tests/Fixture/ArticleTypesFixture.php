<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticleTypesFixture
 */
class ArticleTypesFixture extends TestFixture
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
                'label' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-11-16 12:22:21',
                'modified' => '2026-11-16 12:22:21',
            ],
        ];
        parent::init();
    }
}
