<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserRoles Model
 *
 * @method \App\Model\Entity\UserRole newEmptyEntity()
 * @method \App\Model\Entity\UserRole newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\UserRole> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserRole get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\UserRole findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\UserRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\UserRole> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserRole|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\UserRole saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\UserRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserRole>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserRole> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserRole>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserRole>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserRole> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserRolesTable extends Table
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

        $this->setTable('user_roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'role_type',
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
            ->scalar('role_type')
            ->maxLength('role_type', 255)
            ->requirePresence('role_type', 'create')
            ->notEmptyString('role_type');

        return $validator;
    }
}
