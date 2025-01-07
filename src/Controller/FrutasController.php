<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Frutas Controller
 *
 * @property \App\Model\Table\FrutasTable $Frutas
 */
class FrutasController extends AppController
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

        if ($user->isadm) {
            // Lógica para usuários administradores
            $this->Flash->success(__('Bem-vindo, Administrador!'));

            // Continue com a lógica normal
            $query = $this->Frutas->find()
                ->contain(['Classificacaos']);
            $frutas = $this->paginate($query);

            $this->set(compact('frutas'));
        } else {
            // Redireciona para a página "não autorizado"
            $this->Flash->error(__('Somente administradores podem cadastrar frutas!'));
            return $this->redirect('/pages/acessonegado');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Fruta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $fruta = $this->Frutas->get($id, contain: ['Classificacaos', 'Vendas']);
        $this->set(compact('fruta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $fruta = $this->Frutas->newEmptyEntity();
        if ($this->request->is('post')) {
            $fruta = $this->Frutas->patchEntity($fruta, $this->request->getData());
            if ($this->Frutas->save($fruta)) {
                $this->Flash->success(__('The fruta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fruta could not be saved. Please, try again.'));
        }
        $classificacaos = $this->Frutas->Classificacaos->find('list', limit: 200)->all();
        $this->set(compact('fruta', 'classificacaos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fruta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();

        $fruta = $this->Frutas->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fruta = $this->Frutas->patchEntity($fruta, $this->request->getData());
            if ($this->Frutas->save($fruta)) {
                $this->Flash->success(__('The fruta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fruta could not be saved. Please, try again.'));
        }
        $classificacaos = $this->Frutas->Classificacaos->find('list', limit: 200)->all();
        $this->set(compact('fruta', 'classificacaos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fruta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $fruta = $this->Frutas->get($id);
        if ($this->Frutas->delete($fruta)) {
            $this->Flash->success(__('The fruta has been deleted.'));
        } else {
            $this->Flash->error(__('The fruta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
