<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $article_type_id
 * @property int $service_id
 * @property int $quantity
 * @property int $unit_price
 * @property string|null $reception_condition
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\ArticleType $article_type
 * @property \App\Model\Entity\Service $service
 */
class OrderItem extends Entity
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
        'order_id' => true,
        'article_type_id' => true,
        'service_id' => true,
        'quantity' => true,
        'unit_price' => true,
        'reception_condition' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'article_type' => true,
        'service' => true,
    ];
}
