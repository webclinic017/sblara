<?php 
namespace App\Importers;
class ContestImporter extends BaseImporter
{
							// from => to;
	protected 	$oneToOneMap = [
					'contests' =>[
						'id' 					=>  'id',
						'start_date' 					=>  'start_date',
						'end_date' 					=>  'end_date',
						'access_level' 					=>  'access_level',
						'is_active' 					=>  'is_active',
						'members' 					=>  'members',
						'members' 					=>  'contest_amount',
						'max_amount' 					=>  'max_amount',
						'author' 					=>  'user_id',
						'contest_name' 					=>  'name',
						'max_member' 					=>  'max_member',
						'contest_category' 				=>  'contest_category',
					],
					'contest_portfolios' => [
							'id'						=> 			'id',
							'user_id'					=> 			'user_id',
							'portfolio_value'			=> 			'portfolio_value',
							'cash_amount'				=> 			'cash_amount',
							'portfolio_name'			=> 			'portfolio_name',
							'broker_fee'				=> 			'broker_fee',
							'broker'					=> 			'broker',
							'email_alert'				=> 			'email_alert',
							'join_date'					=> 			'join_date|filter',
							'contest_id'				=> 			'contest_id',
							'is_trade'					=> 			'is_trade',
							'contest_isactive'			=> 			'contest_isactive',
							'is_active'					=> 			'is_active',
							'current_portfolio_value'	=> 			'current_portfolio_value',
					],
					'contest_portfolio_shares' => [
							'id'   =>   'id',
							'portfolio_id'   =>   'contest_portfolio_id',
							'symbol_id'   =>   'instrument_id', 
							'no_of_shares'   =>   'no_of_shares',
							'buying_price'   =>   'buying_price',
							'buying_date'   =>   'buying_date|filter',
							'is_active'   =>   'is_active',
							'share_status'   =>   'share_status',
							'sell_quantity'   =>   'sell_quantity',
							'sell_price'   =>   'sell_price',
							'sell_date'   =>   'sell_date|filter',
							'commission'   =>   'commission',
							'market'   =>   'market',
							'contest_id'   =>   'contest_id',
							'is_mature'   =>   'is_mature',

					]
				];

	function __construct($console)
	{
		parent::__construct( $console );
	}

	public function handle()
	{
		 $this->oneToOne('contests', 'contests');
		 $this->oneToOne('contest_portfolios', 'contest_portfolios');
		 $this->new('contest_portfolios')->update(['approved' => 1]);
		 $this->oneToOne('contest_portfolio_shares', 'contest_portfolio_shares');
		 return ;
	}

	public function buying_dateFilter($value)
	{
		 return \Carbon\Carbon::createFromTimestamp($value);

	}

	public function sell_dateFilter($value)
	{
		 return \Carbon\Carbon::createFromTimestamp($value);
	}

	public function join_dateFilter($value)
	{
		 return \Carbon\Carbon::createFromFormat('Y-m-d', $value);
	}

}