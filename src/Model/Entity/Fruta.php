<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fruta Entity
 *
 * @property int $id
 * @property int $classificacao_id
 * @property string $nome
 * @property bool $fresca
 * @property int $qtd_disponivel
 * @property string $preco
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Classificacao $classificacao
 * @property \App\Model\Entity\Venda[] $vendas
 */
class Fruta extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'classificacao_id' => true,
        'nome' => true,
        'fresca' => true,
        'qtd_disponivel' => true,
        'preco' => true,
        'created' => true,
        'modified' => true,
        'classificacao' => true,
        'vendas' => true,
    ];
}
