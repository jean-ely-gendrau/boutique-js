<?php

namespace Motor\Mvc\Interfaces;

interface CrudInterface
{
    /**
     * Method getConnectBdd
     *
     * @return void
     */
    public function getConnectBdd(): object;

    /**
     * Method getById
     *
     * @param string $id [explicite description]
     *
     * @return object
     */
    public function getById(string $id): object;

    /**
     * Method getAll
     *
     * @return object
     */
    public function getAll(): object;

    /**
     * Method getByEmail
     *
     * @param string $email [explicite description]
     *
     * @return object
     */
    public function getByEmail(string $email): object;

    /**
     * Method create
     *
     * @param object $objectClass [explicite description]
     * @param array $param [explicite description]
     *
     * @return void
     */
    public function create(object $objectClass, array $param): void;

    /**
     * Method update
     *
     * @param object $objectClass [explicite description]
     * @param array $param [explicite description]
     *
     * @return mixed
     */
    public function update(object $objectClass, array $param): mixed;

    /**
     * Method delete
     *
     * @param object $objectClass [explicite description]
     *
     * @return mixed
     */
    public function delete(object $objectClass): mixed;
}
