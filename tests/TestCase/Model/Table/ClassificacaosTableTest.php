<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassificacaosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassificacaosTable Test Case
 */
class ClassificacaosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClassificacaosTable
     */
    protected $Classificacaos;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Classificacaos',
        'app.Frutas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Classificacaos') ? [] : ['className' => ClassificacaosTable::class];
        $this->Classificacaos = $this->getTableLocator()->get('Classificacaos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Classificacaos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ClassificacaosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
