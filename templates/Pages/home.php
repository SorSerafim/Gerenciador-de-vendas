<div class="home index content">
    <h1>Olá, <?= $this->request->getAttribute('identity')->username ?>!</h1>
    <h2><?= __('Bem-vindo ao Sistema de Gestão de Frutas') ?></h2>
    <ul>
        <li><?= $this->Html->link(__('Cadastro de Frutas'), ['controller' => 'Frutas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Relatório de Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Gerenciar Usuários'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    </ul>
</div>