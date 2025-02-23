<?php

namespace app\models;

use app\core\Model;

class CreditCard extends Model {

    public static function tableName(): string {
        return 'credit_cards';
    }
    public static function tableColumns(): array {
        return ['id', 'name', 'number', 'exp_month', 'exp_year', 'cvv'];
    }

    public static function rules(): array {
        $year = date('Y');
        return [
            "name"      => "present|minlength:6|maxlength:256",
            "number"    => "present|length:16",
            "exp_month" => "present|integer|min:1|max:12",
            "exp_year"  => "present|integer|min:$year|max:".($year+5),
            "cvv"       => "present|integer|length:3",
        ];
    }

    public ?int $id = null;
    public string $name;
    public string $number;
    public int $exp_month;
    public int $exp_year;
    public int $cvv;
}