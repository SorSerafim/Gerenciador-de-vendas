<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vendas Model
 *
 * @property \App\Model\Table\FrutasTable&\Cake\ORM\Association\BelongsTo $Frutas
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Venda newEmptyEntity()
 * @method \App\Model\Entity\Venda newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Venda> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Venda get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Venda findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Venda patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Venda> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Venda|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Venda saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Venda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Venda>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Venda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Venda> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Venda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Venda>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Venda>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Venda> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendasTable extends Table
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

        $this->setTable('vendas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Frutas', [
            'foreignKey' => 'fruta_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'vendedor_id',
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
            ->integer('fruta_id')
            ->allowEmptyString('fruta_id');

        $validator
            ->integer('vendedor_id')
            ->allowEmptyString('vendedor_id');

        $validator
            ->integer('qtd_vendida')
            ->requirePresence('qtd_vendida', 'create')
            ->notEmptyString('qtd_vendida')
            ->greaterThan('qtd_vendida', 0, 'A quantidade vendida deve ser maior que zero.')
            ->notEmptyString('qtd_vendida', 'A quantidade vendida é obrigatória.');

        $validator
            ->integer('desconto')
            ->notEmptyString('desconto', 'O desconto é obrigatório.')
            ->add('desconto', 'validValue', [
                'rule' => ['inList', [0, 5, 10, 15, 20, 25]],
                'message' => 'O desconto deve ser 0%, 5%, 10%, 15%, 20% ou 25%.'
            ]);

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
        $rules->add($rules->existsIn(['fruta_id'], 'Frutas'), ['errorField' => 'fruta_id']);
        $rules->add($rules->existsIn(['vendedor_id'], 'Users'), ['errorField' => 'vendedor_id']);

        return $rules;
    }

    public function applyDiscount($price, $discount)
    {
        return $price - ($price * ($discount / 100));
    }
}
