<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property int $id
 * @property int $order_id
 * @property string $channel
 * @property string|null $message
 * @property \Cake\I18n\DateTime $sent_at
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Order $order
 */
class Notification extends Entity
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
        'channel' => true,
        'message' => true,
        'sent_at' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
    ];
}
