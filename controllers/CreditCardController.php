<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\CreditCard;

class CreditCardController extends Controller {
    
    public function index() {
        $cards = CreditCard::findAll();
        return $this->render('credit_cards/index', ['cards' => $cards]);
    }

    public function create() {
        return $this->render('credit_cards/create');
    }

    public function store(Request $request) {
        $body = $request->getBody();
        $card = new CreditCard($body);
        $card->save();
        $this->redirect('/cards');
    }

    // public function edit(Request $request) {
    //     $id = $request->getParam('id');
    //     return $this->render('credit_cards/edit', ['id' => $id]);
    // }

    // public function update(Request $request) {
    //     $body = $request->getBody();
    //     $body = print_r($body, true);
    //     return "<pre>$body</pre>";
    // }

    public function delete(Request $request) {
        $body = $request->getBody();
        $id = $body['id'];
        $card = CreditCard::findById($id);
        $card->delete();
        $this->redirect('/cards');
    }
}