<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Order'), ['action' => 'edit', $order->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Orders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Order'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="orders view content">
            <h3><?= h($order->ticket_number) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ticket Number') ?></th>
                    <td><?= h($order->ticket_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $order->hasValue('client') ? $this->Html->link($order->client->name, ['controller' => 'Clients', 'action' => 'view', $order->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $order->hasValue('user') ? $this->Html->link($order->user->name, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($order->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($order->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount') ?></th>
                    <td><?= $this->Number->format($order->discount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deposited At') ?></th>
                    <td><?= h($order->deposited_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pickup Due At') ?></th>
                    <td><?= h($order->pickup_due_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picked Up At') ?></th>
                    <td><?= h($order->picked_up_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($order->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($order->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Observation') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($order->observation)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Deliveries') ?></h4>
                <?php if (!empty($order->deliveries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Courier Id') ?></th>
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
                        <?php foreach ($order->deliveries as $delivery) : ?>
                        <tr>
                            <td><?= h($delivery->id) ?></td>
                            <td><?= h($delivery->courier_id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Notifications') ?></h4>
                <?php if (!empty($order->notifications)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Channel') ?></th>
                            <th><?= __('Message') ?></th>
                            <th><?= __('Sent At') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->notifications as $notification) : ?>
                        <tr>
                            <td><?= h($notification->id) ?></td>
                            <td><?= h($notification->channel) ?></td>
                            <td><?= h($notification->message) ?></td>
                            <td><?= h($notification->sent_at) ?></td>
                            <td><?= h($notification->created) ?></td>
                            <td><?= h($notification->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'action' => 'view', $notification->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Notifications', 'action' => 'edit', $notification->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Notifications', 'action' => 'delete', $notification->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $notification->id),
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
                <h4><?= __('Related Order Items') ?></h4>
                <?php if (!empty($order->order_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Article Type Id') ?></th>
                            <th><?= __('Service Id') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Unit Price') ?></th>
                            <th><?= __('Reception Condition') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->order_items as $orderItem) : ?>
                        <tr>
                            <td><?= h($orderItem->id) ?></td>
                            <td><?= h($orderItem->article_type_id) ?></td>
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
                <h4><?= __('Related Order Status Histories') ?></h4>
                <?php if (!empty($order->order_status_histories)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Old Status') ?></th>
                            <th><?= __('New Status') ?></th>
                            <th><?= __('Changed At') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->order_status_histories as $orderStatusHistory) : ?>
                        <tr>
                            <td><?= h($orderStatusHistory->id) ?></td>
                            <td><?= h($orderStatusHistory->user_id) ?></td>
                            <td><?= h($orderStatusHistory->old_status) ?></td>
                            <td><?= h($orderStatusHistory->new_status) ?></td>
                            <td><?= h($orderStatusHistory->changed_at) ?></td>
                            <td><?= h($orderStatusHistory->created) ?></td>
                            <td><?= h($orderStatusHistory->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OrderStatusHistories', 'action' => 'view', $orderStatusHistory->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'OrderStatusHistories', 'action' => 'edit', $orderStatusHistory->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'OrderStatusHistories', 'action' => 'delete', $orderStatusHistory->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $orderStatusHistory->id),
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
                <h4><?= __('Related Payments') ?></h4>
                <?php if (!empty($order->payments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Payment Method') ?></th>
                            <th><?= __('Paid At') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->payments as $payment) : ?>
                        <tr>
                            <td><?= h($payment->id) ?></td>
                            <td><?= h($payment->user_id) ?></td>
                            <td><?= h($payment->amount) ?></td>
                            <td><?= h($payment->payment_method) ?></td>
                            <td><?= h($payment->paid_at) ?></td>
                            <td><?= h($payment->created) ?></td>
                            <td><?= h($payment->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payment->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payment->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Payments', 'action' => 'delete', $payment->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $payment->id),
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
                <h4><?= __('Related V Delivery Schedule') ?></h4>
                <?php if (!empty($order->v_delivery_schedule)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Scheduled At') ?></th>
                            <th><?= __('Delivery Type') ?></th>
                            <th><?= __('Ticket Number') ?></th>
                            <th><?= __('Client Name') ?></th>
                            <th><?= __('Client Phone') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Fee') ?></th>
                            <th><?= __('Courier Name') ?></th>
                            <th><?= __('Status') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($order->v_delivery_schedule as $vDeliverySchedule) : ?>
                        <tr>
                            <td><?= h($vDeliverySchedule->id) ?></td>
                            <td><?= h($vDeliverySchedule->scheduled_at) ?></td>
                            <td><?= h($vDeliverySchedule->delivery_type) ?></td>
                            <td><?= h($vDeliverySchedule->ticket_number) ?></td>
                            <td><?= h($vDeliverySchedule->client_name) ?></td>
                            <td><?= h($vDeliverySchedule->client_phone) ?></td>
                            <td><?= h($vDeliverySchedule->address) ?></td>
                            <td><?= h($vDeliverySchedule->fee) ?></td>
                            <td><?= h($vDeliverySchedule->courier_name) ?></td>
                            <td><?= h($vDeliverySchedule->status) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'VDeliverySchedule', 'action' => 'view', $vDeliverySchedule->]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'VDeliverySchedule', 'action' => 'edit', $vDeliverySchedule->]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'VDeliverySchedule', 'action' => 'delete', $vDeliverySchedule->],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $vDeliverySchedule->),
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