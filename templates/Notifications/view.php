<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification $notification
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Notifications'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Notification'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="notifications view content">
            <h3><?= h($notification->channel) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $notification->hasValue('order') ? $this->Html->link($notification->order->ticket_number, ['controller' => 'Orders', 'action' => 'view', $notification->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Channel') ?></th>
                    <td><?= h($notification->channel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($notification->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sent At') ?></th>
                    <td><?= h($notification->sent_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($notification->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($notification->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Message') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($notification->message)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>