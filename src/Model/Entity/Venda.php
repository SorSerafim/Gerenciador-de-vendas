<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Venda Entity
 *
 * @property int $id
 * @property int|null $fruta_id
 * @property int|null $vendedor_id
 * @property int $qtd_vendida
 * @property int $desconto
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Fruta $fruta
 * @property \App\Model\Entity\User $user
 */
class Venda extends Entity
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
        'fruta_id' => true,
        'vendedor_id' => true,
        'qtd_vendida' => true,
        'desconto' => true,
        'created' => true,
        'modified' => true,
        'fruta' => true,
        'user' => true,
    ];
}
