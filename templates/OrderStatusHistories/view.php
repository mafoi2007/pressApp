<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderStatusHistory $orderStatusHistory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Status History'), ['action' => 'edit', $orderStatusHistory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Status History'), ['action' => 'delete', $orderStatusHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderStatusHistory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Status Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Status History'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderStatusHistories view content">
            <h3><?= h($orderStatusHistory->new_status) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $orderStatusHistory->hasValue('order') ? $this->Html->link($orderStatusHistory->order->ticket_number, ['controller' => 'Orders', 'action' => 'view', $orderStatusHistory->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $orderStatusHistory->hasValue('user') ? $this->Html->link($orderStatusHistory->user->name, ['controller' => 'Users', 'action' => 'view', $orderStatusHistory->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Old Status') ?></th>
                    <td><?= h($orderStatusHistory->old_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('New Status') ?></th>
                    <td><?= h($orderStatusHistory->new_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderStatusHistory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Changed At') ?></th>
                    <td><?= h($orderStatusHistory->changed_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($orderStatusHistory->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($orderStatusHistory->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>