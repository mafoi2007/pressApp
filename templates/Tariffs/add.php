<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tariff $tariff
 * @var \Cake\Collection\CollectionInterface|string[] $articleTypes
 * @var \Cake\Collection\CollectionInterface|string[] $services
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tariffs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tariffs form content">
            <?= $this->Form->create($tariff) ?>
            <fieldset>
                <legend><?= __('Add Tariff') ?></legend>
                <?php
                    echo $this->Form->control('article_type_id', ['options' => $articleTypes]);
                    echo $this->Form->control('service_id', ['options' => $services]);
                    echo $this->Form->control('price');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
