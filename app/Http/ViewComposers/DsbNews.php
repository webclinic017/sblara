<?php
/**
 * Created by PhpStorm.
 * User: sohail
 * Date: 4/16/2017
 * Time: 12:13 PM
 */

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DsbNews
{
    /**
     * The index repository implementation.
     *
     * @var IndexRepository
     */

    /**
     * Create a new market_summary composer.
     *
     * @param  IndexRepository $indexes
     * @return void
     */


    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {

        $sql = "SELECT *
                FROM  dsbp_posts
                INNER JOIN dsbp_postmeta ON dsbp_postmeta.post_id = dsbp_posts.id
                WHERE  dsbp_posts.post_status LIKE  'publish'
                AND  dsbp_postmeta.meta_key LIKE  '_thumbnail_id'
                ORDER BY  dsbp_posts.post_date DESC
                LIMIT 0 , 5";

        $result = DB::connection('dsb')->select($sql);


        $allNews = array();
        $liveNews = array();
        foreach ($result as $row) {
            $post_id = $row->ID;

            $temp = array();
            $thumbnail_post_id = $row->meta_value;
            $tsql = "SELECT id,guid  FROM dsbp_posts WHERE id=$thumbnail_post_id";
            $thumbArr = DB::connection('dsb')->select($tsql);


            //  $db->debug();
            $temp['post_id'] = $post_id;
            $temp['post_date'] = $row->post_date;
            $temp['guid'] = $row->guid;
            $temp['post_content'] = $row->post_content;
            $temp['post_title'] = $row->post_title;
            $temp['thmbnail'] = $thumbArr[0]->guid;
           // $temp['taxonomy'] = $tagArr;
            $liveNews[] = $temp;

        }

        $view->with('allnews', $liveNews);



    }


}