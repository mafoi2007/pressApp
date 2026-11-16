<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ArticleType $articleType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Article Type'), ['action' => 'edit', $articleType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Article Type'), ['action' => 'delete', $articleType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articleType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Article Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Article Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="articleTypes view content">
            <h3><?= h($articleType->label) ?></h3>
            <table>
                <tr>
                    <th><?= __('Label') ?></th>
                    <td><?= h($articleType->label) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($articleType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($articleType->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($articleType->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Order Items') ?></h4>
                <?php if (!empty($articleType->order_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Order Id') ?></th>
                            <th><?= __('Service Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Reception Condition') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($articleType->order_items as $orderItem) : ?>
                        <tr>
                            <td><?= h($orderItem->id) ?></td>
                            <td><?= h($orderItem->order_id) ?></td>
                            <td><?= h($orderItem->service_id) ?></td>
                            <td><?= h($orderItem->quantity) ?></td>
                            <td><?= h($orderItem->unit_price) ?></td>
                            <td><?= h($orderItem->reception_condition) ?></td>
                            <td><?= h($orderItem->created) ?></td>
                            <td><?= h($orderItem->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrderItems', 'action' => 'view', $orderItem->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderItems', 'action' => 'edit', $orderItem->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'OrderItems', 'action' => 'delete', $orderItem->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $orderItem->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Tariffs') ?></h4>
                <?php if (!empty($articleType->tariffs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Service Id') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($articleType->tariffs as $tariff) : ?>
                        <tr>
                            <td><?= h($tariff->id) ?></td>
                            <td><?= h($tariff->service_id) ?></td>
                            <td><?= h($tariff->price) ?></td>
                            <td><?= h($tariff->created) ?></td>
                            <td><?= h($tariff->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Tariffs', 'action' => 'view', $tariff->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Tariffs', 'action' => 'edit', $tariff->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Tariffs', 'action' => 'delete', $tariff->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $tariff->id),
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