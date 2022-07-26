<?php namespace treehousetim\ActiveCampaign;

class ActiveCampaign
{
	protected $base_url;
	protected $api_key;

	public function __construct( $base_url = null, $api_key = null )
	{
		$this->base_url = rtrim( $base_url ?? getenv( 'ACTIVE_CAMPAIGN_URL' ), '/' ) . '/';
		$this->api_key = $api_key ?? getenv( 'ACTIVE_CAMPAIGN_KEY' );

		if( $this->base_url === null || $this->api_key === null )
		{
			throw new \Exception( 'Pass configuration or set env vars for ACTIVE_CAMPAIGN_URL and ACTIVE_CAMPAIGN_KEY' );
		}
	}

	public function lists()
	{
		return new Classes\Lists( $this->base_url, $this->api_key );
	}

	public function contacts()
	{
		return new Classes\Contacts( $this->base_url, $this->api_key );
	}

	public function tags()
	{
		return new Classes\Tags( $this->base_url, $this->api_key );
	}

	public function customFields()
	{
		return new Classes\CustomFields( $this->base_url, $this->api_key );
	}
}