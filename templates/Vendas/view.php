<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Venda $venda
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Menu') ?></h4>
            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $venda->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $venda->id], ['confirm' => __('Are you sure you want to delete # {0}?', $venda->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista de Vendas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Adicionar Venda'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="vendas view content">
            <h3><?= h($venda->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Fruta') ?></th>
                    <td><?= $venda->hasValue('fruta') ? $this->Html->link($venda->fruta->nome, ['controller' => 'Frutas', 'action' => 'view', $venda->fruta->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Vendedor') ?></th>
                    <td><?= $venda->hasValue('user') ? $this->Html->link($venda->user->username, ['controller' => 'Users', 'action' => 'view', $venda->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($venda->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Vendido') ?></th>
                    <td><?= $this->Number->format($venda->qtd_vendida) ?></td>
                </tr>
                <tr>
                    <th><?= __('Desconto') ?></th>
                    <td><?= $this->Number->format($venda->desconto) . '%' ?></td>
                </tr>
                <tr>
                    <th><?= __('Criado') ?></th>
                    <td><?= $this->Time->i18nFormat($venda->created, 'dd/MM/yyyy HH:mm') ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= $this->Time->i18nFormat($venda->modified, 'dd/MM/yyyy HH:mm') ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>