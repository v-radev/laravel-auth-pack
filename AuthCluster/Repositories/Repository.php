<?php namespace App\Clusters\AuthCluster\Repositories;

use App\Clusters\AuthCluster\Repositories\Contracts\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{


    protected $model = NULL;


    public function all( $columns = [ '*' ] )
    {
        return $this->model->get( $columns );
    }

    public function lists( $value, $key = NULL )
    {
        $lists = $this->model->lists( $value, $key );

        //On 5.1 you have to say all() to get to array
        return is_array( $lists ) ? $lists : $lists->all();
    }

    public function paginate( $perPage = 1, $columns = [ '*' ] )
    {
        return $this->model->paginate( $perPage, $columns );
    }

    public function find( $id, $columns = [ '*' ] )
    {
        return $this->model->find( $id, $columns );
    }

    public function findOrFail( $id, $columns = [ '*' ] )
    {
        return $this->model->findOrFail( $id, $columns );
    }

    public function findBy( $attribute, $value, $columns = [ '*' ] )
    {
        return $this->model->where( $attribute, '=', $value )->first( $columns );
    }

    public function findAllBy( $attribute, $value, $columns = [ '*' ] )
    {
        return $this->model->where( $attribute, '=', $value )->get( $columns );
    }

}