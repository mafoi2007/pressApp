<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string|null $address
 * @property string|null $neighborhood
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\VOrderBalance[] $v_order_balances
 */
class Client extends Entity
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
        'name' => true,
        'phone' => true,
        'address' => true,
        'neighborhood' => true,
        'created' => true,
        'modified' => true,
        'orders' => true,
        'v_order_balances' => true,
    ];
}
