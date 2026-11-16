<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery $delivery
 * @var string[]|\Cake\Collection\CollectionInterface $orders
 * @var string[]|\Cake\Collection\CollectionInterface $couriers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $delivery->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $delivery->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Deliveries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="deliveries form content">
            <?= $this->Form->create($delivery) ?>
            <fieldset>
                <legend><?= __('Edit Delivery') ?></legend>
                <?php
                    echo $this->Form->control('order_id', ['options' => $orders]);
                    echo $this->Form->control('courier_id', ['options' => $couriers, 'empty' => true]);
                    echo $this->Form->control('delivery_type');
                    echo $this->Form->control('address');
                    echo $this->Form->control('fee');
                    echo $this->Form->control('scheduled_at');
                    echo $this->Form->control('completed_at', ['empty' => true]);
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
