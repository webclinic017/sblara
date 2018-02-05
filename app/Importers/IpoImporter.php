<?php 
namespace App\Importers;
class IpoImporter extends BaseImporter
{

	protected $truncate = false;
	protected $oneToOneMap = [
		// form => to
		'ipo_name' => 'ipo_name',
		'short_name' => 'short_name',
		'logo' => 'logo',
		'bank_list' => 'bank_list',
		'nrb_form' => 'nrb_form',
		// 'prospectus' => 'prospectus',
		'result_general' => 'result_general',
		'result_nrb' => 'result_nrb',
		'result_mutual_fund' => 'result_mutual_fund',
		'result_affected_users' => 'result_affected_users',
		'distribution_locations' => 'distribution_locations',
		'webaddress' => 'webaddress',
		'address1' => 'address1',
		'address2' => 'address2',
		'address3' => 'address3',
		'form_address_to' => 'form_address_to',
		'proposed_share' => 'proposed_share',
		'share_price' => 'share_price',
		'premium_per_share' => 'premium_per_share',
		//'offeredPrice' => 'offeredPrice',
		'lot' => 'lot',
		'eps' => 'eps',
		'revaluation_reserve' => 'revaluation_reserve',
		'w_revaluation_reserve' => 'w_revaluation_reserve',
		'amount_in_words' => 'amount_in_words',
		'subscription_open' => 'subscription_open|filter',
		'subscription_close' => ['subscription_close|filter', 'year|filter'],
		'result_published' => 'result_published',
		'alert_marker' => 'alert_marker',
		'is_active' => 'is_active',
		'returnValue' => 'returnValue',
		'nature_of_business' => 'nature_of_business',
		'major_product' => 'major_product',
		'use_of_ipo_proceeds' => 'use_of_ipo_proceeds',
		'issue_manager' => 'issue_manager',
		//'firstDayClose' => 'firstDayClose',
		'created_at' => 'created_at',
		'updated_at' => 'updated_at',
		'deleted_at' => 'deleted_at',
		// 'currentPrice' => 'currentPrice',
	];

	public function filter($value)
	{
		if(strpos($value, '.pdf') || strpos($value, '.png'))
		{
			//[{"download_link":"ipolists\/January2018\/TT4DnImntDWisj8XWIzw.jpg","original_name":"LOGO QSTML.jpg"}]
			$value = json_encode([['download_link' => "sbcake/ipo/".$value, 'original_name' => $value]]);
		}
		return $value;
	}

	public function yearFilter($value)
	{
		// dd("make sure all done");
		if(is_object($value))
		{
			return $value;
		}
		return \Carbon\Carbon::createFromTimestamp($value)->format('Y');
	}


	public function subscription_openFilter($value)
	{
		return \Carbon\Carbon::createFromTimestamp($value);
	}

	public function subscription_closeFilter($value)
	{
		return \Carbon\Carbon::createFromTimestamp($value);
	}

	function __construct($console)
	{
		parent::__construct( $console );
	}

	public function handle()
	{
		$this->oneToOne('ipolists', 'ipolists');
	}

}