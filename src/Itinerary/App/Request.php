<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 23/11/2016
 * Time: 20:36
 */

namespace Itinerary\App;


class Request
{

    private $method;
    private $path;
    private $post;
    private $route;

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    public function __construct ()
    {
        $this->method = $_SERVER['REQUEST_METHOD']??NULL;
        $this->path   = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:NULL;

        parse_str(file_get_contents("php://input"),$post_vars);

        $this->post   = array_merge($_POST,$post_vars);

        $this->route =  $_SERVER["REQUEST_URI"]?? NULL;
    }

    /**
     * TRUE if GET request, FALSE otherwise
     * @return bool
     */
    public function isGet() :bool
    {
        return $this->method == 'GET';
    }

    /**
     * @return bool
     */
    public function isPost() :bool
    {
        return $this->method == 'POST';
    }

    public function isUpdate()
    {
        return $this->method == 'UPDATE';
    }

    public function isDelete()
    {
        return $this->method == 'DELETE';
    }

    public function isPut()
    {
        return $this->method == 'PUT';
    }

    public function hasPost($name){
        return isset($this->post[$name]);
    }

    public function has ($name) {
        return isset($_REQUEST[$name]);
    }

    public function getParam($name,$default=NULL){
        return isset($_GET[$name])?$_GET[$name]:$default;
    }

    public function getPost($name,$default=NULL){
        return isset($this->post[$name])?$this->post[$name]:$default;
    }


    public function getAllPost(){
        return $this->post;
    }

    /**
     * @return bool
     */
    public function isCli() : bool
    {
            return (php_sapi_name() === 'cli');
    }
}