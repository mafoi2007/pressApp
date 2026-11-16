<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderStatusHistory $orderStatusHistory
 * @var \Cake\Collection\CollectionInterface|string[] $orders
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Order Status Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orderStatusHistories form content">
            <?= $this->Form->create($orderStatusHistory) ?>
            <fieldset>
                <legend><?= __('Add Order Status History') ?></legend>
                <?php
                    echo $this->Form->control('order_id', ['options' => $orders]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('old_status');
                    echo $this->Form->control('new_status');
                    echo $this->Form->control('changed_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
