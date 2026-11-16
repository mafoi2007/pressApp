<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Couriers Model
 *
 * @property \App\Model\Table\DeliveriesTable&\Cake\ORM\Association\HasMany $Deliveries
 *
 * @method \App\Model\Entity\Courier newEmptyEntity()
 * @method \App\Model\Entity\Courier newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Courier> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Courier get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Courier findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Courier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Courier> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Courier|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Courier saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Courier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Courier>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Courier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Courier> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Courier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Courier>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Courier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Courier> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CouriersTable extends Table
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

        $this->setTable('couriers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Deliveries', [
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
            ->scalar('name')
            ->maxLength('name', 150)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 30)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone')
            ->add('phone', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

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
        $rules->add($rules->isUnique(['phone']), ['errorField' => 'phone']);

        return $rules;
    }
}
