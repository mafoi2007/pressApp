<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tariffs Model
 *
 * @property \App\Model\Table\ArticleTypesTable&\Cake\ORM\Association\BelongsTo $ArticleTypes
 * @property \App\Model\Table\ServicesTable&\Cake\ORM\Association\BelongsTo $Services
 *
 * @method \App\Model\Entity\Tariff newEmptyEntity()
 * @method \App\Model\Entity\Tariff newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Tariff> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tariff get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Tariff findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Tariff patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Tariff> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tariff|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Tariff saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Tariff>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tariff>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tariff>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tariff> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tariff>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tariff>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Tariff>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Tariff> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TariffsTable extends Table
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

        $this->setTable('tariffs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ArticleTypes', [
            'foreignKey' => 'article_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Services', [
            'foreignKey' => 'service_id',
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
            ->nonNegativeInteger('article_type_id')
            ->notEmptyString('article_type_id');

        $validator
            ->nonNegativeInteger('service_id')
            ->notEmptyString('service_id');

        $validator
            ->nonNegativeInteger('price')
            ->notEmptyString('price');

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
        $rules->add($rules->isUnique(['article_type_id', 'service_id']), ['errorField' => 'article_type_id', 'message' => __('This combination of article_type_id and service_id already exists')]);
        $rules->add($rules->existsIn(['article_type_id'], 'ArticleTypes'), ['errorField' => 'article_type_id']);
        $rules->add($rules->existsIn(['service_id'], 'Services'), ['errorField' => 'service_id']);

        return $rules;
    }
}
