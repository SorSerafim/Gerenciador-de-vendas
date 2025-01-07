<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fruta $fruta
 * @var \Cake\Collection\CollectionInterface|string[] $classificacaos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Frutas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="frutas form content">
            <?= $this->Form->create($fruta) ?>
            <fieldset>
                <legend><?= __('Adicionar Fruta') ?></legend>
                <?php
                echo $this->Form->control('classificacao_id', ['options' => $classificacaos]);
                echo $this->Form->control('nome');
                echo $this->Form->control('fresca', [
                    'type' => 'checkbox',
                    'label' => 'Está fresca?',
                ]);
                echo $this->Form->control('qtd_disponivel', [
                    'label' => 'Quantidade',
                ]);
                echo $this->Form->control('preco', [
                    'label' => 'Preço',
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>