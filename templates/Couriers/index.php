<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Courier> $couriers
 */
?>
<div class="couriers index content">
    <?= $this->Html->link(__('New Courier'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Couriers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($couriers as $courier): ?>
                <tr>
                    <td><?= $this->Number->format($courier->id) ?></td>
                    <td><?= h($courier->name) ?></td>
                    <td><?= h($courier->phone) ?></td>
                    <td><?= h($courier->is_active) ?></td>
                    <td><?= h($courier->created) ?></td>
                    <td><?= h($courier->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $courier->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $courier->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $courier->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $courier->id),
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