<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VendasFixture
 */
class VendasFixture extends TestFixture
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
                'fruta_id' => 1,
                'vendedor_id' => 1,
                'qtd_vendida' => 1,
                'desconto' => 1,
                'created' => 1733076830,
                'modified' => 1733076830,
            ],
        ];
        parent::init();
    }
}
