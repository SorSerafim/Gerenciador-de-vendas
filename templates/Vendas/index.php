<div class="vendas index content">
    <?= $this->Html->link(__('Adicionar Venda'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Vendas') ?></h3>

    <!-- Filtros -->
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <fieldset>
        <legend><?= __('Filtros') ?></legend>
        <?= $this->Form->control('vendedor_id', [
            'type' => 'select',
            'options' => $vendedores, // Certifique-se de passar esta variável do controller para a view
            'empty' => 'Selecione um vendedor',
            'label' => 'Vendedor'
        ]) ?>
        <?= $this->Form->control('fruta_id', [
            'type' => 'select',
            'options' => $frutas, // Certifique-se de passar esta variável do controller para a view
            'empty' => 'Selecione uma fruta',
            'label' => 'Fruta'
        ]) ?>
    </fieldset>
    <?= $this->Form->button(__('Filtrar')) ?>
    <?= $this->Form->end() ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('fruta_id') ?></th>
                    <th><?= $this->Paginator->sort('vendedor_id') ?></th>
                    <th><?= $this->Paginator->sort('Quantidade') ?></th>
                    <th><?= $this->Paginator->sort('desconto') ?></th>
                    <th><?= __('Valor Final') ?></th>
                    <th><?= $this->Paginator->sort('Hora da venda') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $venda): ?>
                    <tr>
                        <td><?= $venda->hasValue('fruta') ? $this->Html->link($venda->fruta->nome, ['controller' => 'Frutas', 'action' => 'view', $venda->fruta->id]) : '' ?></td>
                        <td><?= $venda->hasValue('user') ? $this->Html->link($venda->user->username, ['controller' => 'Users', 'action' => 'view', $venda->user->id]) : '' ?></td>
                        <td><?= $this->Number->format($venda->qtd_vendida) ?></td>
                        <td><?= $this->Number->format($venda->desconto) . '%' ?></td>
                        <td>
                            <?= $this->Number->currency(
                                $venda->fruta->preco * $venda->qtd_vendida * (1 - $venda->desconto / 100),
                                'BRL'
                            ) ?>
                        </td>
                        <td><?= $this->Time->i18nFormat($venda->created, 'dd/MM/yyyy HH:mm') ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Detalhes'), ['action' => 'view', $venda->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $venda->id]) ?>
                            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $venda->id], ['confirm' => __('Are you sure you want to delete # {0}?', $venda->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>