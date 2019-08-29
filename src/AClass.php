<?php


namespace Pagely\Interview;


class AClass
{
    public $db;

    public function addProduct(Product $thingOne, $values)
    {
        $data = array();

        $this->data->values[] = $values;

        if ($this->method = 'POST' && in_array('price', array_keys($data))) {
            $type = $values['type'];
            $price = $values['price'];
            $productName = $values['name'];
        }

        foreach ($this->data->values as $set) {
            foreach ($set as $key => $value) {
                if ($key == 'price') {
                    $totalPrice = $value;
                }
            }
        }

        $this->data->totalPrice = $totalPrice;

        $sql = "INSERT INTO products (type, price, name) VALUES('{$type}', {$price}, '{$name}')";

        $this->db->execute($sql);

        foreach ($data as $key => $value) {
            if ($key == 'price') {
                $thingOne->price = $value;
            }
            if ($key == 'name') {
                $thingOne->productName = $value;
            }
            if ($key == 'type') {
                $thingOne->type = $value;
            }
        }

        return $thingOne;
    }
}
