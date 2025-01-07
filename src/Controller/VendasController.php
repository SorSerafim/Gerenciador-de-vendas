<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Vendas Controller
 *
 * @property \App\Model\Table\VendasTable $Vendas
 */
class VendasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        // Obtém o usuário autenticado
        $user = $this->Authentication->getIdentity();

        if (!$user->isadm) {
            // Lógica para usuários vendedores
            $this->Flash->success(__('Bem-vindo, Vendedor!'));

            // Filtros de frutas e vendedores
            $frutaId = $this->request->getQuery('fruta_id');
            $vendedorId = $this->request->getQuery('vendedor_id');

            // Configuração da query
            $query = $this->Vendas->find()
                ->contain(['Frutas', 'Users']);

            // Aplica os filtros se existirem
            if ($frutaId) {
                $query->where(['fruta_id' => $frutaId]);
            }

            if ($vendedorId) {
                $query->where(['vendedor_id' => $vendedorId]);
            }

            // Paginação
            $vendas = $this->paginate($query);

            // Obtém os dados para os selects
            $frutas = $this->Vendas->Frutas->find('list', ['keyField' => 'id', 'valueField' => 'nome']);
            $vendedores = $this->Vendas->Users->find('list', ['keyField' => 'id', 'valueField' => 'username']);

            $this->set(compact('vendas', 'frutas', 'vendedores'));
        } else {
            // Redireciona para a página "não autorizado"
            $this->Flash->error(__('Somente vendedores podem acessar o relatório!'));
            return $this->redirect('/pages/acessonegado');
        }
    }


    /**
     * View method
     *
     * @param string|null $id Venda id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $venda = $this->Vendas->get($id, contain: ['Frutas', 'Users']);
        $this->set(compact('venda'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $venda = $this->Vendas->newEmptyEntity();
        if ($this->request->is('post')) {
            $venda = $this->Vendas->patchEntity($venda, $this->request->getData());

            // Carregar a fruta associada
            $fruta = $this->Vendas->Frutas->get($venda->fruta_id);

            if (!$fruta) {
                $this->Flash->error(__('Fruta não encontrada.'));
                return $this->redirect(['action' => 'add']);
            }

            // Verificar disponibilidade e calcular preço
            if ($venda->qtd_vendida > $fruta->qtd_disponivel) {
                $this->Flash->error(__('Quantidade solicitada excede o estoque disponível.'));
            } else {

                $fruta->qtd_disponivel -= $venda->qtd_vendida;

                $this->Vendas->Frutas->save($fruta);

                $venda->total = $venda->qtd_vendida * $fruta->preco * (1 - $venda->desconto / 100);

                if ($this->Vendas->save($venda)) {

                    $this->Flash->success(__('Venda realizada com sucesso.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Não foi possível salvar a venda.'));
                }
            }
        }

        $frutas = $this->Vendas->Frutas->find('list', ['limit' => 200]);
        $users = $this->Vendas->Users->find('list', ['limit' => 200]);

        $this->set(compact('venda', 'frutas', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Venda id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Authentication->getIdentity();

        if (!$user->isadm) {

            $this->Flash->success(__('Bem-vindo, vendedor!'));

            $venda = $this->Vendas->get($id, contain: []);

            if ($this->request->is(['patch', 'post', 'put'])) {

                $venda = $this->Vendas->patchEntity($venda, $this->request->getData());

                if ($this->Vendas->save($venda)) {

                    $this->Flash->success(__('The venda has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The venda could not be saved. Please, try again.'));
            }

            $frutas = $this->Vendas->Frutas->find('list', limit: 200)->all();
            $users = $this->Vendas->Users->find('list', limit: 200)->all();

            $this->set(compact('venda', 'frutas', 'users'));
        } else {

            $this->Flash->error(__('Você não tem permissão para acessar esta página.'));
            return $this->redirect('/pages/acessonegado');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Venda id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $venda = $this->Vendas->get($id);
        if ($this->Vendas->delete($venda)) {
            $this->Flash->success(__('The venda has been deleted.'));
        } else {
            $this->Flash->error(__('The venda could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
