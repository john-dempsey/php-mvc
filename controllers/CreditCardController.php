<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Session;
use app\core\Validator;
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
        $year = date('Y');
        $body = $request->getBody();
        $rules = [
            "name"      => "present|minlength:6|maxlength:256",
            "number"    => "present|length:16",
            "exp_month" => "present|integer|min:1|max:12",
            "exp_year"  => "present|integer|min:$year|max:" . ($year + 5),
            "cvv"       => "present|integer|length:3",
        ];
        $validator = new Validator();
        $errors = $validator->validate($rules, $body);
        if ($errors) {
            $request->session->set(Session::FORM_ERRORS, $errors);
            $request->session->set(Session::FORM_DATA, $body);
            $request->session->set(Session::FLASH, [
                'type' => 'danger',
                'message' => 'Please correct the errors below'
            ]);
            $this->redirect('/cards/create');
        }
        else {
            $card = new CreditCard($body);
            $card->save();
            $request->session->set(Session::FLASH, [
                'type' => 'success',
                'message' => 'Credit card added successfully'
            ]);
            $this->redirect('/cards');
        }
    }

    public function edit(Request $request) {
        $body = $request->getBody();
        $id = $body['id'];
        $card = CreditCard::findById($id);
        if (!$card) {
            $request->session->set(Session::FLASH, [
                'type' => 'warning',
                'message' => 'Credit card not found'
            ]);
            $this->redirect('/cards');
        }
        else {
            return $this->render('credit_cards/edit', ['card' => $card]);
        }
    }

    public function update(Request $request) {
        $body = $request->getBody();
        $id = $body['id'];
        $card = CreditCard::findById($id);
        if (!$card) {
            $request->session->set(Session::FLASH, [
                'type' => 'warning',
                'message' => 'Credit card not found'
            ]);
            $this->redirect('/cards');
        }
        else {
            $year = date('Y');
            $rules = [
                "name"      => "present|minlength:6|maxlength:256",
                "number"    => "present|length:16",
                "exp_month" => "present|integer|min:1|max:12",
                "exp_year"  => "present|integer|min:$year|max:" . ($year + 5),
                "cvv"       => "present|integer|length:3",
            ];
            $validator = new Validator();
            $errors = $validator->validate($rules, $body);
            if ($errors) {
                $request->session->set(Session::FORM_ERRORS, $errors);
                $request->session->set(Session::FORM_DATA, $body);
                $request->session->set(Session::FLASH, [
                    'type' => 'danger',
                    'message' => 'Please correct the errors below'
                ]);
                $this->redirect('/cards/edit?id=' . $id);
            }
            else {
                $card->name = $body['name'];
                $card->number = $body['number'];
                $card->exp_month = $body['exp_month'];
                $card->exp_year = $body['exp_year'];
                $card->cvv = $body['cvv'];
                $card->save();
                $request->session->set(Session::FLASH, [
                    'type' => 'success',
                    'message' => 'Credit card updated successfully'
                ]);
                $this->redirect('/cards');
            }
        }
    }

    public function delete(Request $request) {
        $body = $request->getBody();
        $id = $body['id'];
        $card = CreditCard::findById($id);
        $card->delete();
        $request->session->set(Session::FLASH, [
            'type' => 'success',
            'message' => 'Credit card deleted successfully'
        ]);
        $this->redirect('/cards');
    }
}