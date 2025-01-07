<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClassificacaosFixture
 */
class ClassificacaosFixture extends TestFixture
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
                'classificacao' => 'Lorem ipsum dolor ',
                'created' => 1733076844,
                'modified' => 1733076844,
            ],
        ];
        parent::init();
    }
}
