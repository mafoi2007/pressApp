<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderItem $orderItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order Item'), ['action' => 'edit', $orderItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order Item'), ['action' => 'delete', $orderItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Order Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderItems view content">
            <h3><?= h($orderItem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $orderItem->hasValue('order') ? $this->Html->link($orderItem->order->ticket_number, ['controller' => 'Orders', 'action' => 'view', $orderItem->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Article Type') ?></th>
                    <td><?= $orderItem->hasValue('article_type') ? $this->Html->link($orderItem->article_type->label, ['controller' => 'ArticleTypes', 'action' => 'view', $orderItem->article_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Service') ?></th>
                    <td><?= $orderItem->hasValue('service') ? $this->Html->link($orderItem->service->label, ['controller' => 'Services', 'action' => 'view', $orderItem->service->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($orderItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($orderItem->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Unit Price') ?></th>
                    <td><?= $this->Number->format($orderItem->unit_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($orderItem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($orderItem->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Reception Condition') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($orderItem->reception_condition)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>