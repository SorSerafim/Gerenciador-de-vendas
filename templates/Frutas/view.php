<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fruta $fruta
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Menu') ?></h4>
            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fruta->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fruta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fruta->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista de Frutas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Adicionar Fruta'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="frutas view content">
            <h3><?= h($fruta->nome) ?></h3>
            <table>
                <tr>
                    <th><?= __('Classificação') ?></th>
                    <td><?= $fruta->hasValue('classificacao') ? $this->Html->link($fruta->classificacao->classificacao, ['controller' => 'Classificacaos', 'action' => 'view', $fruta->classificacao->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Fruta') ?></th>
                    <td><?= h($fruta->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($fruta->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantidade Disponível') ?></th>
                    <td><?= $this->Number->format($fruta->qtd_disponivel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Preço') ?></th>
                    <td><?= $this->Number->format($fruta->preco, ['before' => 'R$ ', 'places' => 2]) ?></td>
                </tr>
                <tr>
                    <th><?= __('Criado') ?></th>
                    <td><?= $this->Time->i18nFormat($fruta->created, 'dd/MM/yyyy HH:mm') ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= $this->Time->i18nFormat($fruta->modified, 'dd/MM/yyyy HH:mm') ?></td>
                </tr>
                <tr>
                    <th><?= __('Está Fresca') ?></th>
                    <td><?= (bool)$fruta->fresca ? __('Sim') : __('Não'); ?></td>

                </tr>
            </table>
            <div class="related">
                <h4><?= __('Vendas Relacionadas') ?></h4>
                <?php if (!empty($fruta->vendas)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Fruta Id') ?></th>
                                <th><?= __('Vendedor Id') ?></th>
                                <th><?= __('Quantidade Vendida') ?></th>
                                <th><?= __('Desconto') ?></th>
                                <th><?= __('Criado') ?></th>
                                <th><?= __('Modificado') ?></th>
                            </tr>
                            <?php foreach ($fruta->vendas as $venda) : ?>
                                <tr>
                                    <td><?= h($venda->id) ?></td>
                                    <td><?= h($venda->fruta_id) ?></td>
                                    <td><?= h($venda->vendedor_id) ?></td>
                                    <td><?= h($venda->qtd_vendida) ?></td>
                                    <td><?= $this->Number->format($venda->desconto) . '%' ?></td>
                                    <td><?= $this->Time->i18nFormat($venda->created, 'dd/MM/yyyy HH:mm') ?></td>
                                    <td><?= $this->Time->i18nFormat($venda->modified, 'dd/MM/yyyy HH:mm') ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>