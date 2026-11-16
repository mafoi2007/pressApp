<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tariff Entity
 *
 * @property int $id
 * @property int $article_type_id
 * @property int $service_id
 * @property int $price
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\ArticleType $article_type
 * @property \App\Model\Entity\Service $service
 */
class Tariff extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'article_type_id' => true,
        'service_id' => true,
        'price' => true,
        'created' => true,
        'modified' => true,
        'article_type' => true,
        'service' => true,
    ];
}
