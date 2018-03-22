<?php

    namespace App\Controllers;

    use Core\BaseController;
    use Core\Container;

    class ExamsController extends BaseController{

        public function __construct(){
            parent::__construct();
            $this->exam = Container::getModel("Exam");
        }

        public function index(){
            $this->setPageTitle('Provas');
            $this->view->exams = $this->exam->readAll();
            $this->renderView('exams/index', 'layout');
        }

        public function show($id){
            $this->view->exam = $this->exam->readSingle($id);
            $this->setPageTitle('Prova');
            if ($this->view->exam->id){
                $this->renderView('exams/show', 'layout');
            } else {
                $this->renderView('404');
            }
        }

        public function create(){
            $this->setPageTitle('Nova Prova');
            $this->renderView('exams/create', 'layout');
        }

        public function store($request){
            date_default_timezone_set("America/Bahia");
            $this->exam->createExam("{$request->post->professor}", "{$request->post->period}", date('Y-m-d'), 1, "{$request->post->unit}");
            header("location: /exams");
        }

        public function edit($id){
            $this->view->exam = $this->exam->readSingle($id);
            $this->setPageTitle('Edição de prova');
            $this->renderView('exams/edit', 'layout');
        }

        public function update($id, $request){
            $this->exam->update("{$id}", "{$request->post->professor}", "{$request->post->period}", '1',"{$request->post->unit}");
            header("location: /exam/{$id}/show");
        }

        public function delete($id){
            $this->exam->deleteExam($id);
            header("location: /exams");
        }
    }
