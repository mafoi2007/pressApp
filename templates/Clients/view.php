<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Client'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="clients view content">
            <h3><?= h($client->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($client->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($client->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($client->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Neighborhood') ?></th>
                    <td><?= h($client->neighborhood) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($client->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($client->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($client->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Orders') ?></h4>
                <?php if (!empty($client->orders)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Ticket Number') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Deposited At') ?></th>
                            <th><?= __('Pickup Due At') ?></th>
                            <th><?= __('Picked Up At') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Discount') ?></th>
                            <th><?= __('Observation') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($client->orders as $order) : ?>
                        <tr>
                            <td><?= h($order->id) ?></td>
                            <td><?= h($order->ticket_number) ?></td>
                            <td><?= h($order->user_id) ?></td>
                            <td><?= h($order->deposited_at) ?></td>
                            <td><?= h($order->pickup_due_at) ?></td>
                            <td><?= h($order->picked_up_at) ?></td>
                            <td><?= h($order->status) ?></td>
                            <td><?= h($order->discount) ?></td>
                            <td><?= h($order->observation) ?></td>
                            <td><?= h($order->created) ?></td>
                            <td><?= h($order->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $order->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'edit', $order->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Orders', 'action' => 'delete', $order->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $order->id),
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
                <h4><?= __('Related V Order Balances') ?></h4>
                <?php if (!empty($client->v_order_balances)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Ticket Number') ?></th>
                            <th><?= __('Client Name') ?></th>
                            <th><?= __('Client Phone') ?></th>
                            <th><?= __('Deposited At') ?></th>
                            <th><?= __('Pickup Due At') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Discount') ?></th>
                            <th><?= __('Items Amount') ?></th>
                            <th><?= __('Delivery Fees') ?></th>
                            <th><?= __('Paid') ?></th>
                            <th><?= __('Total') ?></th>
                            <th><?= __('Remaining Balance') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($client->v_order_balances as $vOrderBalance) : ?>
                        <tr>
                            <td><?= h($vOrderBalance->id) ?></td>
                            <td><?= h($vOrderBalance->ticket_number) ?></td>
                            <td><?= h($vOrderBalance->client_name) ?></td>
                            <td><?= h($vOrderBalance->client_phone) ?></td>
                            <td><?= h($vOrderBalance->deposited_at) ?></td>
                            <td><?= h($vOrderBalance->pickup_due_at) ?></td>
                            <td><?= h($vOrderBalance->status) ?></td>
                            <td><?= h($vOrderBalance->discount) ?></td>
                            <td><?= h($vOrderBalance->items_amount) ?></td>
                            <td><?= h($vOrderBalance->delivery_fees) ?></td>
                            <td><?= h($vOrderBalance->paid) ?></td>
                            <td><?= h($vOrderBalance->total) ?></td>
                            <td><?= h($vOrderBalance->remaining_balance) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'VOrderBalances', 'action' => 'view', $vOrderBalance->]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'VOrderBalances', 'action' => 'edit', $vOrderBalance->]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'VOrderBalances', 'action' => 'delete', $vOrderBalance->],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $vOrderBalance->),
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