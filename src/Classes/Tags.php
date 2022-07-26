<?php namespace treehousetim\ActiveCampaign\Classes;

class Tags extends \treehousetim\ActiveCampaign\Connector
{


	public function get($tag_id)
	{
		return $this->request('GET', 'tags/' . strval($tag_id));
	}


	public function all( $search = null )
	{
		return $this->request('GET', 'tags', ['search' => $search] );
	}


	public function create( array $params )
	{
		return $this->request( 'POST', 'tags', ['tag' => $params] );
	}


	public function update( $tag_id, $params )
	{
		return $this->request('PUT', 'tags/' . strval($tag_id), ['tag' => $params]);
	}


	public function delete( $tag_id )
	{
		return $this->request('DELETE', 'tags/' . strval($tag_id));
	}


}