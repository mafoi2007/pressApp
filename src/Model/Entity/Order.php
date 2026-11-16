<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $ticket_number
 * @property int $client_id
 * @property int $user_id
 * @property \Cake\I18n\DateTime $deposited_at
 * @property \Cake\I18n\Date|null $pickup_due_at
 * @property \Cake\I18n\DateTime|null $picked_up_at
 * @property string $status
 * @property int $discount
 * @property string|null $observation
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Delivery[] $deliveries
 * @property \App\Model\Entity\Notification[] $notifications
 * @property \App\Model\Entity\OrderItem[] $order_items
 * @property \App\Model\Entity\OrderStatusHistory[] $order_status_histories
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\VDeliverySchedule[] $v_delivery_schedule
 */
class Order extends Entity
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
        'ticket_number' => true,
        'client_id' => true,
        'user_id' => true,
        'deposited_at' => true,
        'pickup_due_at' => true,
        'picked_up_at' => true,
        'status' => true,
        'discount' => true,
        'observation' => true,
        'created' => true,
        'modified' => true,
        'client' => true,
        'user' => true,
        'deliveries' => true,
        'notifications' => true,
        'order_items' => true,
        'order_status_histories' => true,
        'payments' => true,
        'v_delivery_schedule' => true,
    ];
}
