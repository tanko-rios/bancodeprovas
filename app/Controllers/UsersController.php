<?php

    namespace App\Controllers;

    use App\Models\User;
    use Core\BaseController;
    use Core\DataBase;
    use Core\Container;
    use Core\Redirect;

    class UsersController extends BaseController
    {
        private $user;

        public function dateConvert($request){
          return date('Y-m-d',strtotime($request->post->birthdate));
        }

        public function __construct(){
          parent::__construct();
          $this->user = Container::getModel("User");
        }

        public function index(){
            $this->setPageTitle('Users');
            $this->view->users = $this->user->all();
            $this->renderView('/users/index.phtml', 'layout.phtml');
        }

        public function show($id){
            $this->view->users = $this->user->findById($id);
            $this->setPageTitle("{$this->view->users->name}");
            $this->renderView('/users/FindById.phtml', 'layout.phtml');
        }

        public function create(){
          $this->setPageTitle('Novo Usuário');
          $this->renderView('/users/create.phtml', 'layout.phtml');
        }

        public function store($request){
          if($this->user->create("{$request->post->name}", "{$request->post->email}", "{$request->post->password}", "{$request->post->image}", "{$this->dateConvert($request)}", "{$request->post->courses_id}")){
            Redirect::route("/users");
          }else{
            echo "Não foi possivel criar usuário!";
          }
        }
        public function edit($id){
          $this->view->user = $this->user->findById($id);
          $this->setPageTitle('Edit user - ' . $this->view->user->name);
          $this->renderView('users/edit.phtml' , 'layout.phtml');
        }

        public function update($id, $request){
          if($this->user->update("$id", "{$request->post->name}", "{$request->post->email}", "{$request->post->password}", "{$request->post->image}", "{$this->dateConvert($request)}", "{$request->post->courses_id}")){
            Redirect::route("/users");
          }else{
            echo "Não foi possivel atualizar usuário!";
          }
        }

        public function delete($id){
          if($this->user->delete($id)){
            Redirect::route('/users');
          }else{
            echo "Erro ao excluir usuário!";
          }
        }
  }