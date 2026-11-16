<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tariffs Controller
 *
 * @property \App\Model\Table\TariffsTable $Tariffs
 */
class TariffsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Tariffs->find()
            ->contain(['ArticleTypes', 'Services']);
        $tariffs = $this->paginate($query);

        $this->set(compact('tariffs'));
    }

    /**
     * View method
     *
     * @param string|null $id Tariff id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tariff = $this->Tariffs->get($id, contain: ['ArticleTypes', 'Services']);
        $this->set(compact('tariff'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tariff = $this->Tariffs->newEmptyEntity();
        if ($this->request->is('post')) {
            $tariff = $this->Tariffs->patchEntity($tariff, $this->request->getData());
            if ($this->Tariffs->save($tariff)) {
                $this->Flash->success(__('The tariff has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tariff could not be saved. Please, try again.'));
        }
        $articleTypes = $this->Tariffs->ArticleTypes->find('list', limit: 200)->all();
        $services = $this->Tariffs->Services->find('list', limit: 200)->all();
        $this->set(compact('tariff', 'articleTypes', 'services'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tariff id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tariff = $this->Tariffs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tariff = $this->Tariffs->patchEntity($tariff, $this->request->getData());
            if ($this->Tariffs->save($tariff)) {
                $this->Flash->success(__('The tariff has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tariff could not be saved. Please, try again.'));
        }
        $articleTypes = $this->Tariffs->ArticleTypes->find('list', limit: 200)->all();
        $services = $this->Tariffs->Services->find('list', limit: 200)->all();
        $this->set(compact('tariff', 'articleTypes', 'services'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tariff id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tariff = $this->Tariffs->get($id);
        if ($this->Tariffs->delete($tariff)) {
            $this->Flash->success(__('The tariff has been deleted.'));
        } else {
            $this->Flash->error(__('The tariff could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
