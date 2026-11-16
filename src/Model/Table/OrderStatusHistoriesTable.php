<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderStatusHistories Model
 *
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\OrderStatusHistory newEmptyEntity()
 * @method \App\Model\Entity\OrderStatusHistory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderStatusHistory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderStatusHistory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrderStatusHistory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrderStatusHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrderStatusHistory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderStatusHistory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrderStatusHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatusHistory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatusHistory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatusHistory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrderStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrderStatusHistory> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderStatusHistoriesTable extends Table
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

        $this->setTable('order_status_histories');
        $this->setDisplayField('new_status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('old_status')
            ->maxLength('old_status', 30)
            ->allowEmptyString('old_status');

        $validator
            ->scalar('new_status')
            ->maxLength('new_status', 30)
            ->requirePresence('new_status', 'create')
            ->notEmptyString('new_status');

        $validator
            ->dateTime('changed_at')
            ->notEmptyDateTime('changed_at');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
