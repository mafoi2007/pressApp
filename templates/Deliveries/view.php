<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery $delivery
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Delivery'), ['action' => 'edit', $delivery->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Delivery'), ['action' => 'delete', $delivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delivery->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Deliveries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Delivery'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="deliveries view content">
            <h3><?= h($delivery->delivery_type) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $delivery->hasValue('order') ? $this->Html->link($delivery->order->ticket_number, ['controller' => 'Orders', 'action' => 'view', $delivery->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Courier') ?></th>
                    <td><?= $delivery->hasValue('courier') ? $this->Html->link($delivery->courier->name, ['controller' => 'Couriers', 'action' => 'view', $delivery->courier->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Delivery Type') ?></th>
                    <td><?= h($delivery->delivery_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($delivery->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($delivery->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($delivery->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fee') ?></th>
                    <td><?= $this->Number->format($delivery->fee) ?></td>
                </tr>
                <tr>
                    <th><?= __('Scheduled At') ?></th>
                    <td><?= h($delivery->scheduled_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Completed At') ?></th>
                    <td><?= h($delivery->completed_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($delivery->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($delivery->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>