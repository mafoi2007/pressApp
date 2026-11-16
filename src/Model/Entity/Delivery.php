<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Delivery Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int|null $courier_id
 * @property string $delivery_type
 * @property string $address
 * @property int $fee
 * @property \Cake\I18n\DateTime $scheduled_at
 * @property \Cake\I18n\DateTime|null $completed_at
 * @property string $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Courier $courier
 */
class Delivery extends Entity
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
        'courier_id' => true,
        'delivery_type' => true,
        'address' => true,
        'fee' => true,
        'scheduled_at' => true,
        'completed_at' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'courier' => true,
    ];
}
