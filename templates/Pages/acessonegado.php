<div class="error not-authorized">
    <h1><?= __('Acesso Negado') ?></h1>
    <p><?= __('Você não tem permissão para acessar esta página.') ?></p>
    <p><?= $this->Html->link(__('Voltar para a página inicial'), ['controller' => 'Pages', 'action' => 'home']) ?></p>
</div>