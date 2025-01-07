<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classificacaos Model
 *
 * @property \App\Model\Table\FrutasTable&\Cake\ORM\Association\HasMany $Frutas
 *
 * @method \App\Model\Entity\Classificacao newEmptyEntity()
 * @method \App\Model\Entity\Classificacao newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Classificacao> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Classificacao get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Classificacao findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Classificacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Classificacao> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Classificacao|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Classificacao saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Classificacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classificacao>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Classificacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classificacao> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Classificacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classificacao>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Classificacao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Classificacao> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ClassificacaosTable extends Table
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

        $this->setTable('classificacaos');
        $this->setDisplayField('classificacao');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Frutas', [
            'foreignKey' => 'classificacao_id',
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
            ->scalar('classificacao')
            ->maxLength('classificacao', 20)
            ->requirePresence('classificacao', 'create')
            ->notEmptyString('classificacao', 'A classificação é obrigatória.')
            ->inList('classificacao', ['extra', 'primeira', 'segunda', 'terceira'], 'Classificação inválida.');

        return $validator;
    }
}
