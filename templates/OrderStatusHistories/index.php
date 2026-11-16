<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrderStatusHistory> $orderStatusHistories
 */
?>
<div class="orderStatusHistories index content">
    <?= $this->Html->link(__('New Order Status History'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Order Status Histories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('old_status') ?></th>
                    <th><?= $this->Paginator->sort('new_status') ?></th>
                    <th><?= $this->Paginator->sort('changed_at') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderStatusHistories as $orderStatusHistory): ?>
                <tr>
                    <td><?= $this->Number->format($orderStatusHistory->id) ?></td>
                    <td><?= $orderStatusHistory->hasValue('order') ? $this->Html->link($orderStatusHistory->order->ticket_number, ['controller' => 'Orders', 'action' => 'view', $orderStatusHistory->order->id]) : '' ?></td>
                    <td><?= $orderStatusHistory->hasValue('user') ? $this->Html->link($orderStatusHistory->user->name, ['controller' => 'Users', 'action' => 'view', $orderStatusHistory->user->id]) : '' ?></td>
                    <td><?= h($orderStatusHistory->old_status) ?></td>
                    <td><?= h($orderStatusHistory->new_status) ?></td>
                    <td><?= h($orderStatusHistory->changed_at) ?></td>
                    <td><?= h($orderStatusHistory->created) ?></td>
                    <td><?= h($orderStatusHistory->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $orderStatusHistory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderStatusHistory->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $orderStatusHistory->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $orderStatusHistory->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>