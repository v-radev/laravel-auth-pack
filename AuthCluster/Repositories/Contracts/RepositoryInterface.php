<?php namespace App\Clusters\AuthCluster\Repositories\Contracts;


interface RepositoryInterface
{

    /**
     * @param array $columns
     *
     * @return mixed
     */
    public function all( $columns = [ '*' ] );

    /**
     * @param       $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate( $perPage = 1, $columns = [ '*' ] );

    /**
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find( $id, $columns = [ '*' ] );

    /**
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrFail( $id, $columns = [ '*' ] );

    /**
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy( $field, $value, $columns = [ '*' ] );

    /**
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findAllBy( $field, $value, $columns = [ '*' ] );

}