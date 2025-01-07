<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Fruta> $frutas
 */
?>
<div class="frutas index content">
    <?= $this->Html->link(__('Adicionar Fruta'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Frutas') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <!--<th><?= $this->Paginator->sort('id') ?></th>-->
                    <th><?= $this->Paginator->sort('classificação') ?></th>
                    <th><?= $this->Paginator->sort('Fruta') ?></th>
                    <th><?= $this->Paginator->sort('É Fresca?') ?></th>
                    <th><?= $this->Paginator->sort('Quantidade') ?></th>
                    <th><?= $this->Paginator->sort('Preço') ?></th>
                    <th><?= $this->Paginator->sort('Criada') ?></th>
                    <!--<th><?= $this->Paginator->sort('Modificada') ?></th>-->
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($frutas as $fruta): ?>
                    <tr>
                        <!--<td><?= $this->Number->format($fruta->id) ?></td>-->
                        <td><?= $fruta->hasValue('classificacao') ? $this->Html->link($fruta->classificacao->classificacao, ['controller' => 'Classificacaos', 'action' => 'view', $fruta->classificacao->id]) : '' ?></td>
                        <td><?= h($fruta->nome) ?></td>
                        <td><?= $fruta->fresca ? __('Sim') : __('Não'); ?></td>
                        <td><?= $this->Number->format($fruta->qtd_disponivel) ?></td>
                        <td><?= $this->Number->format($fruta->preco, ['before' => 'R$ ', 'places' => 2]) ?></td>
                        <td><?= $this->Time->i18nFormat($fruta->created, 'dd/MM/yyyy HH:mm') ?></td>
                        <!--<td><?= $this->Time->i18nFormat($fruta->modified, 'dd/MM/yyyy HH:mm') ?></td>-->
                        <td class="actions">
                            <?= $this->Html->link(__('Detalhes'), ['action' => 'view', $fruta->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fruta->id]) ?>
                            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fruta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fruta->id)]) ?>
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