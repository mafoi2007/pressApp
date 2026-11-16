<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property int $amount
 * @property string $payment_method
 * @property \Cake\I18n\DateTime $paid_at
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\User $user
 */
class Payment extends Entity
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
        'user_id' => true,
        'amount' => true,
        'payment_method' => true,
        'paid_at' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'user' => true,
    ];
}
