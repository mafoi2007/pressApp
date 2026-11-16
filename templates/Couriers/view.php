<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Courier $courier
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Courier'), ['action' => 'edit', $courier->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Courier'), ['action' => 'delete', $courier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courier->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Couriers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Courier'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="couriers view content">
            <h3><?= h($courier->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($courier->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($courier->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($courier->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($courier->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($courier->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $courier->is_active ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Deliveries') ?></h4>
                <?php if (!empty($courier->deliveries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Delivery Type') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Fee') ?></th>
                            <th><?= __('Scheduled At') ?></th>
                            <th><?= __('Completed At') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($courier->deliveries as $delivery) : ?>
                        <tr>
                            <td><?= h($delivery->id) ?></td>
                            <td><?= h($delivery->order_id) ?></td>
                            <td><?= h($delivery->delivery_type) ?></td>
                            <td><?= h($delivery->address) ?></td>
                            <td><?= h($delivery->fee) ?></td>
                            <td><?= h($delivery->scheduled_at) ?></td>
                            <td><?= h($delivery->completed_at) ?></td>
                            <td><?= h($delivery->status) ?></td>
                            <td><?= h($delivery->created) ?></td>
                            <td><?= h($delivery->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Deliveries', 'action' => 'view', $delivery->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Deliveries', 'action' => 'edit', $delivery->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Deliveries', 'action' => 'delete', $delivery->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $delivery->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>