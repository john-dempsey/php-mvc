<?php

namespace app\models;

use app\core\Model;

class CreditCard extends Model {

    public static function tableName(): string {
        return 'credit_cards';
    }
    public static function tableColumns(): array {
        return ['id', 'name', 'number', 'exp_month', 'exp_year'];
    }

    public ?int $id = null;
    public string $name;
    public string $number;
    public int $exp_month;
    public int $exp_year;
}