<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ArticleTypes Controller
 *
 * @property \App\Model\Table\ArticleTypesTable $ArticleTypes
 */
class ArticleTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ArticleTypes->find();
        $articleTypes = $this->paginate($query);

        $this->set(compact('articleTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Article Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $articleType = $this->ArticleTypes->get($id, contain: ['OrderItems', 'Tariffs']);
        $this->set(compact('articleType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $articleType = $this->ArticleTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $articleType = $this->ArticleTypes->patchEntity($articleType, $this->request->getData());
            if ($this->ArticleTypes->save($articleType)) {
                $this->Flash->success(__('The article type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article type could not be saved. Please, try again.'));
        }
        $this->set(compact('articleType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $articleType = $this->ArticleTypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $articleType = $this->ArticleTypes->patchEntity($articleType, $this->request->getData());
            if ($this->ArticleTypes->save($articleType)) {
                $this->Flash->success(__('The article type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article type could not be saved. Please, try again.'));
        }
        $this->set(compact('articleType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $articleType = $this->ArticleTypes->get($id);
        if ($this->ArticleTypes->delete($articleType)) {
            $this->Flash->success(__('The article type has been deleted.'));
        } else {
            $this->Flash->error(__('The article type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
