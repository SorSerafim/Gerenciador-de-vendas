<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FrutasFixture
 */
class FrutasFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'classificacao_id' => 1,
                'nome' => 'Lorem ipsum dolor sit amet',
                'fresca' => 1,
                'qtd_disponivel' => 1,
                'preco' => 1.5,
                'created' => 1733076837,
                'modified' => 1733076837,
            ],
        ];
        parent::init();
    }
}
