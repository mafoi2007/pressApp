<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DeliveriesTable&\Cake\ORM\Association\HasMany $Deliveries
 * @property \App\Model\Table\NotificationsTable&\Cake\ORM\Association\HasMany $Notifications
 * @property \App\Model\Table\OrderItemsTable&\Cake\ORM\Association\HasMany $OrderItems
 * @property \App\Model\Table\OrderStatusHistoriesTable&\Cake\ORM\Association\HasMany $OrderStatusHistories
 * @property \App\Model\Table\PaymentsTable&\Cake\ORM\Association\HasMany $Payments
 * @property \App\Model\Table\VDeliveryScheduleTable&\Cake\ORM\Association\HasMany $VDeliverySchedule
 *
 * @method \App\Model\Entity\Order newEmptyEntity()
 * @method \App\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Order> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Order findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Order> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Order>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Order> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('orders');
        $this->setDisplayField('ticket_number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Deliveries', [
            'foreignKey' => 'order_id',
        ]);
        $this->hasMany('Notifications', [
            'foreignKey' => 'order_id',
        ]);
        $this->hasMany('OrderItems', [
            'foreignKey' => 'order_id',
        ]);
        $this->hasMany('OrderStatusHistories', [
            'foreignKey' => 'order_id',
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'order_id',
        ]);
        $this->hasMany('VDeliverySchedule', [
            'foreignKey' => 'order_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('ticket_number')
            ->maxLength('ticket_number', 50)
            ->requirePresence('ticket_number', 'create')
            ->notEmptyString('ticket_number')
            ->add('ticket_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->nonNegativeInteger('client_id')
            ->notEmptyString('client_id');

        $validator
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->dateTime('deposited_at')
            ->notEmptyDateTime('deposited_at');

        $validator
            ->date('pickup_due_at')
            ->allowEmptyDate('pickup_due_at');

        $validator
            ->dateTime('picked_up_at')
            ->allowEmptyDateTime('picked_up_at');

        $validator
            ->scalar('status')
            ->maxLength('status', 30)
            ->notEmptyString('status');

        $validator
            ->nonNegativeInteger('discount')
            ->notEmptyString('discount');

        $validator
            ->scalar('observation')
            ->allowEmptyString('observation');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['ticket_number']), ['errorField' => 'ticket_number']);
        $rules->add($rules->existsIn(['client_id'], 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
