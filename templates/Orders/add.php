<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orders form content">
            <?= $this->Form->create($order) ?>
            <fieldset>
                <legend><?= __('Add Order') ?></legend>
                <?php
                    echo $this->Form->control('ticket_number');
                    echo $this->Form->control('client_id', ['options' => $clients]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('deposited_at');
                    echo $this->Form->control('pickup_due_at', ['empty' => true]);
                    echo $this->Form->control('picked_up_at', ['empty' => true]);
                    echo $this->Form->control('status');
                    echo $this->Form->control('discount');
                    echo $this->Form->control('observation');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
