<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Deliveries Model
 *
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\CouriersTable&\Cake\ORM\Association\BelongsTo $Couriers
 *
 * @method \App\Model\Entity\Delivery newEmptyEntity()
 * @method \App\Model\Entity\Delivery newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Delivery> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Delivery get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Delivery findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Delivery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Delivery> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Delivery|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Delivery saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Delivery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Delivery>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Delivery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Delivery> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Delivery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Delivery>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Delivery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Delivery> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DeliveriesTable extends Table
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

        $this->setTable('deliveries');
        $this->setDisplayField('delivery_type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Couriers', [
            'foreignKey' => 'courier_id',
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
            ->nonNegativeInteger('order_id')
            ->notEmptyString('order_id');

        $validator
            ->nonNegativeInteger('courier_id')
            ->allowEmptyString('courier_id');

        $validator
            ->scalar('delivery_type')
            ->maxLength('delivery_type', 30)
            ->requirePresence('delivery_type', 'create')
            ->notEmptyString('delivery_type');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->nonNegativeInteger('fee')
            ->notEmptyString('fee');

        $validator
            ->dateTime('scheduled_at')
            ->requirePresence('scheduled_at', 'create')
            ->notEmptyDateTime('scheduled_at');

        $validator
            ->dateTime('completed_at')
            ->allowEmptyDateTime('completed_at');

        $validator
            ->scalar('status')
            ->maxLength('status', 30)
            ->notEmptyString('status');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'), ['errorField' => 'order_id']);
        $rules->add($rules->existsIn(['courier_id'], 'Couriers'), ['errorField' => 'courier_id']);

        return $rules;
    }
}
