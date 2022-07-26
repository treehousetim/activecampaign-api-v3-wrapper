<?php namespace treehousetim\ActiveCampaign\Classes;

class Tags extends \treehousetim\ActiveCampaign\Connector
{


	public function get($tag_id)
	{
		return $this->request('GET', 'tags/' . strval($tag_id));
	}


	public function all()
	{
		return $this->request('GET', 'tags');
	}


	public function create($params)
	{
		return $this->request('POST', 'tags', ['tag' => $params]);
	}


	public function update($tag_id, $params)
	{
		return $this->request('PUT', 'tags/' . strval($tag_id), ['tag' => $params]);
	}


	public function delete($tag_id)
	{
		return $this->request('DELETE', 'tags/' . strval($tag_id));
	}


}