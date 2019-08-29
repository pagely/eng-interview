<?php


namespace Pagely\Interview\Input;


/**
 * @Annotation
 * @Annotation\Target({"CLASS"})
 */
class Request
{
    public $title;
    public $path;
    public $method;
    public $contentType;
    public $pathParameters = [];
    public $queryParameters = [];
    public $bodyParameters = [];
    public $validationClass;// if not using dynamic validation
    public $requiredQueryParameters = [];
    public $requiredBodyParameters = [];
}
