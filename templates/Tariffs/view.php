<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tariff $tariff
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tariff'), ['action' => 'edit', $tariff->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tariff'), ['action' => 'delete', $tariff->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tariff->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tariffs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tariff'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tariffs view content">
            <h3><?= h($tariff->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article Type') ?></th>
                    <td><?= $tariff->hasValue('article_type') ? $this->Html->link($tariff->article_type->label, ['controller' => 'ArticleTypes', 'action' => 'view', $tariff->article_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Service') ?></th>
                    <td><?= $tariff->hasValue('service') ? $this->Html->link($tariff->service->label, ['controller' => 'Services', 'action' => 'view', $tariff->service->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tariff->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($tariff->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($tariff->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($tariff->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>