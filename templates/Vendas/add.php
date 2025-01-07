<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Venda $venda
 * @var \Cake\Collection\CollectionInterface|string[] $frutas
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Vendas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="vendas form content">
            <?= $this->Form->create($venda) ?>
            <fieldset>
                <legend><?= __('Adicionar Venda') ?></legend>
                <?php
                echo $this->Form->control('fruta_id', ['options' => $frutas, 'empty' => true]);
                echo $this->Form->control('vendedor_id', ['options' => $users, 'empty' => true]);
                echo $this->Form->control('qtd_vendida', [
                    'label' => 'Quantidade',
                ]);
                echo $this->Form->control('desconto', [
                    'type' => 'select',
                    'options' => [
                        0 => '0%',
                        5 => '5%',
                        10 => '10%',
                        15 => '15%',
                        20 => '20%',
                        25 => '25%'
                    ],
                    'empty' => false
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>