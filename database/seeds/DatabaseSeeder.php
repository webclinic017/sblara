<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(MarketsTableSeeder::class);
        $this->call(ExchangesTableSeeder::class);
        $this->call(SectorListsTableSeeder::class);
        $this->call(DataBanksAdjustedEodsTableSeeder::class);
        $this->call(DataBanksEodsTableSeeder::class);
        $this->call(DataBanksIntradaysTableSeeder::class);
        $this->call(FundamentalsTableSeeder::class);
        $this->call(InstrumentsTableSeeder::class);
        $this->call(MetaGroupsTableSeeder::class);
        $this->call(MetasTableSeeder::class);
        $this->call(SectorIntradaysTableSeeder::class);
		$this->call(TradesTableSeeder::class);
		$this->call(NewsTableSeeder::class);
		$this->call(IndexValuesTableSeeder::class);
		$this->call(TransactionTypeTableSeeder::class);

    }
}
