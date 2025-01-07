<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Frutas Model
 *
 * @property \App\Model\Table\ClassificacaosTable&\Cake\ORM\Association\BelongsTo $Classificacaos
 * @property \App\Model\Table\VendasTable&\Cake\ORM\Association\HasMany $Vendas
 *
 * @method \App\Model\Entity\Fruta newEmptyEntity()
 * @method \App\Model\Entity\Fruta newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Fruta> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fruta get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Fruta findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Fruta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Fruta> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fruta|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Fruta saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Fruta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruta>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fruta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruta> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fruta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruta>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fruta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fruta> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FrutasTable extends Table
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

        $this->setTable('frutas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Classificacaos', [
            'foreignKey' => 'classificacao_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Vendas', [
            'foreignKey' => 'fruta_id',
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
            ->integer('classificacao_id')
            ->notEmptyString('classificacao_id');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome', 'O nome da fruta é obrigatório.');

        $validator
            ->boolean('fresca')
            ->requirePresence('fresca', 'create')
            ->notEmptyString('fresca');

        $validator
            ->integer('qtd_disponivel')
            ->requirePresence('qtd_disponivel', 'create')
            ->greaterThan('qtd_disponivel', 0, 'A quantidade disponível deve ser maior que zero.')
            ->notEmptyString('qtd_disponivel', 'A quantidade disponível é obrigatória.');

        $validator
            ->decimal('preco')
            ->requirePresence('preco', 'create')
            ->greaterThan('preco', 0, 'O preço deve ser maior que zero.')
            ->notEmptyString('preco', 'O preço é obrigatório.');

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
        $rules->add($rules->existsIn(['classificacao_id'], 'Classificacaos'), ['errorField' => 'classificacao_id']);

        return $rules;
    }
}
