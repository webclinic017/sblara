<?php 
namespace App\Importers;
class PortfolioImporter extends BaseImporter
{

	protected $limit = '3000';
							// from => to;
	protected 	$oneToOneMap = [
						'portfolios' => [
						   'id'			=> 'id',
						  'user_id'			=> 'user_id',
						  'portfolio_value'			=> 'portfolio_value',
						  'cash_amount'			=> 'cash_amount',
						  'portfolio_name'			=> 'portfolio_name',
						  'broker_fee'			=> 'broker_fee',
						  'broker'			=> 'broker',
						  'email_alert'			=> 'email_alert',
						  'creation_date'			=> 'created_at|filter',
						],
						'portfolio_scrips'  => [
							   'id'			=> 'id',
							  'protfolio_id'  => 'portfolio_id',
							  'symbol_id'  => 'instrument_id',
							  'no_of_shares'  => 'no_of_shares',
							  'buying_price'  => 'buying_price',
							  'buying_date'  => 'buying_date|filter',
							  'is_active'  => 'is_active',
							  'share_status'  => 'share_status',
							  'sell_price'  => 'sell_price',
							  'sell_date'  => 'sell_date|filter',
							  'commission'  => 'commission',
							  'market'  => 'exchange_id|filter',
						]

				];

	function __construct($console)
	{
		parent::__construct( $console );
	}

	public function handle()
	{
		$this->oneToOne('portfolios', 'portfolios');
		$this->oneToOne('portfolio_shares', 'portfolio_scrips');
		\DB::raw("update portfolio_scrips set created_at = buying_date");
		return ;
	}
	public function sell_dateFilter($value)
	{
		if($value == 0){
			return null;
		}
		 return \Carbon\Carbon::createFromTimestamp($value);

	}
	public function exchange_idFilter($value)
	{
		return 1;
	}
	
	public function created_atFilter($value)
	{
		 return \Carbon\Carbon::createFromTimestamp($value);
	}


}