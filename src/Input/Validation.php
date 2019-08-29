<?php


namespace Pagely\Interview\Input;


/**
 * @Annotation
 * @Annotation\Target({"Property"})
 */
class Validation
{
    public $type;
    public $options;
}
