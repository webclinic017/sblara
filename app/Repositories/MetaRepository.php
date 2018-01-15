<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/13/2017
 * Time: 3:34 PM
 */

namespace App\Repositories;
use App\Fundamental;
use App\Meta;
use App\MetaGroup;
use DB;

class MetaRepository {

    /*
     * $metaGroupKey= name of the meta group
     * $deleteAllMeta= delete all meta of this meta group from "metas" table
     * $deleteAllData= delete all data available for these metas of this meta group. Meta data is preserved in various table.
     * So we wil check all tables step by step.
     *
     * TODO: This task can be done nicely with association. Re write whole function using association
    */

    public static function deleteMetaGroup($metaGroupKey='string',$deleteAllMeta=0, $deleteAllData=0)
    {
        $all_meta_of_this_group=Meta::getMetaKeyByGroup(array($metaGroupKey));

        if($deleteAllMeta)
        {
            $all_meta_id_of_this_group = $all_meta_of_this_group[$metaGroupKey]->pluck('id');
            Meta::deleteMeta($all_meta_id_of_this_group);
        }

        if($deleteAllData)
        {
            //first check fundamental table
            Fundamental::deleteFundamental($all_meta_id_of_this_group);

            // other table here ...

        }

        MetaGroup::deleteMetaGroup($metaGroupKey);
    }

    /*
     * $deleteAllData = delete all data available for these metas of this meta group. Meta data is preserved in various table.
    So we wil check all tables step by step.
    */

    public static function deleteMetaData($metaKey='string',$deleteAllData=1, $deleteMetaAlso = 0)
    {
        $meta_info=Meta::getMetaInfo(array($metaKey));
        $meta_id= $meta_info[$metaKey]->pluck('id');

        if($deleteAllData)
        {
            //first check fundamental table
            Fundamental::deleteFundamental($meta_id);

            // other table here ...

        }

        if($deleteMetaAlso)
        {
            Meta::deleteMeta($meta_id);
        }

    }


    /*find all meta of a table ($table_name) whose meta is absent/deleted in metas table*/


    public static function showOrphan($table_name='fundamentals')
    {
        $all_meta_id_of_fundamentals_table=DB::table($table_name)->distinct()->select('meta_id')->pluck('meta_id');
        //$all_meta_id_of_fundamentals_table = Fundamental::distinct()->select('meta_id')->pluck('meta_id');
        $all_available_meta_id_in_meta_table = DB::table('metas')->select('id')->whereIn('id', $all_meta_id_of_fundamentals_table)->pluck('id');
        $orphan_meta_ids = array_diff($all_meta_id_of_fundamentals_table->toArray(), $all_available_meta_id_in_meta_table->toArray());
        return $orphan_meta_ids;

    }

    public static function deleteOrphan($table_name = 'fundamentals')
    {
        $orphan_meta_ids = self::showOrphan($table_name);
        $deletedRows = DB::table($table_name)->whereIn('meta_id', $orphan_meta_ids)->delete();
        return true;
    }

} 