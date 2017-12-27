<?php 
namespace App\Importers;
use \DB as DB;
class UserImporter extends BaseImporter
{
							// from => to;
	protected 	$oneToOneMap = [
					'id' 					=>  'id',
					'username' 				=>  'username',
					'name' 					=>  'name',
					'password' 				=>  'password_old',
					'email' 				=>  'email',
					'profession' 			=>  'profession',
					'address' 				=>  'address',
					'broker_name' 			=>  'broker_name',
					'contact_no' 			=>  'contact_no',
					'last_visit' 			=>  'last_visit',
					'group_id' 				=>  'group_id',
					'is_active' 			=>  'verified',
					'created' 				=>  'created_at',
					'modified' 				=>  'updated_at',
					'tokenhash' 			=>  'tokenhash',
					'daily_report' 			=>  'daily_report',
					'user_type' 			=>  'user_type',
					'pic_path' 				=>  'pic_path',
				];

	function __construct($console)
	{
		parent::__construct( $console );
	}

	public function handle()
	{
		$this->oneToOne('users', 'users');
		$this->new('users')->where('name', '')->update(['name' => DB::raw('username')]);
		return ;
	}

}