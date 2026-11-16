<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notifications Model
 *
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\Notification newEmptyEntity()
 * @method \App\Model\Entity\Notification newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Notification> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Notification get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Notification findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Notification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Notification> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Notification|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Notification saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Notification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Notification>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Notification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Notification> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Notification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Notification>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Notification>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Notification> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NotificationsTable extends Table
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

        $this->setTable('notifications');
        $this->setDisplayField('channel');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
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
            ->scalar('channel')
            ->maxLength('channel', 30)
            ->requirePresence('channel', 'create')
            ->notEmptyString('channel');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        $validator
            ->dateTime('sent_at')
            ->notEmptyDateTime('sent_at');

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

        return $rules;
    }
}
