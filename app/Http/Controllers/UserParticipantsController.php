<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use App\CourseVenues;
use App\CourseFacilitators;
use App\CourseCategories;
use App\CourseBatches;
use App\CourseParticipants;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class UserParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $batches = CourseParticipants::getActiveCourse();
      return view('user_courses.list', ['batches' => $batches]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $batch = CourseBatches::find($id);
      return view('user_courses.registration', ['batch' => $batch]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
           'course_batch_id' => 'required|unique:course_facilitators,faci_name|max:255',
           'p_name' => 'required',
           'p_email' => 'required|email',
           'p_phone' => 'required',
           'p_address' => 'required',
           'p_profession' => 'max:100',
           'p_organisation' => 'max:100',
           'p_designation' => 'max:100',
           'where_heard' => 'max:100',
           'p_comments' => 'max:255'

        ]);

        $participant = new CourseParticipants();
        $participant->course_batch_id = $request->input('course_batch_id');
        $participant->p_name = $request->input('p_name');
        $participant->p_email = $request->input('p_email');
        $participant->p_phone = $request->input('p_phone');
        $participant->p_address = $request->input('p_address');
        $participant->p_profession = $request->input('p_profession');
        $participant->p_organisation = $request->input('p_organisation');
        $participant->p_designation = $request->input('p_designation');
        $participant->where_heard = $request->input('where_heard');
        $participant->p_comments = $request->input('p_comments');
        $participant->save();


        //Mail::to($request->input('p_email'))->send(new OrderShipped($participant->id,$participant->course_batch_id));
        Mail::to('afmsohail@gmail.com')->send(new OrderShipped($participant->id,$participant->course_batch_id));

        $batches = CourseParticipants::getActiveCourse();


        return view('user_courses.list', ['batches' => $batches, 'message_success' => 'You have successfully registered for the course!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $batches = CourseBatches::find($id);
        return view('admin_courses.participants.detail', ['batches' => $batches]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //return view('admin_courses.category.list', ['course_categories' => $course_categories, 'message_success' => 'Category is update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function home()
    {

        $view_data = Cache::remember("fb_course_album_data", 1440, function () {


            $access_token="746070542263177|DaEZ2tZKr7jaCPlabo3GmHklr6o";

            $fields="id,name,description,link,cover_photo,count";
            $fb_page_id = "8352309942";

            $json_link = "https://graph.facebook.com/v2.8/{$fb_page_id}/albums?fields={$fields}&access_token={$access_token}";
            $json = file_get_contents($json_link);

            $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

            $album_count = count($obj['data']);



            $view_data=array();

            for($x=0; $x<$album_count; $x++){

                $id = isset($obj['data'][$x]['id']) ? $obj['data'][$x]['id'] : "";
                $name = isset($obj['data'][$x]['name']) ? $obj['data'][$x]['name'] : "";
                $name=trim($name);
                $url_name=urlencode($name);
                $description = isset($obj['data'][$x]['description']) ? $obj['data'][$x]['description'] : "";
                $link = isset($obj['data'][$x]['link']) ? $obj['data'][$x]['link'] : "";

                $cover_photo = isset($obj['data'][$x]['cover_photo']['id']) ? $obj['data'][$x]['cover_photo']['id'] : "";

                // use this for older access tokens:
                // $cover_photo = isset($obj['data'][$x]['cover_photo']) ? $obj['data'][$x]['cover_photo'] : "";

                $count = isset($obj['data'][$x]['count']) ? $obj['data'][$x]['count'] : "";

                // if you want to exclude an album, just add the name on the if statement

                if(
                    $name!="Untitled Album" &&
                    $name!="Cover Photos" &&
                    $name!="Timeline Photos"
                ){


                    $json_link = "https://graph.facebook.com/v2.3/{$id}/photos?fields={$fields}&access_token={$access_token}";
                    $json = file_get_contents($json_link);

                    $photo_obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);


                    $temp=array();


                    $temp['name']=$name;
                    $temp['description']=$description;
                    $temp['show_pictures_link']=$photo_obj['data'][0]['link'];
                    $temp['view_on_facebook']=$link;
                    $temp['src']="https://graph.facebook.com/v2.3/{$cover_photo}/picture?access_token={$access_token}";

                    $view_data[]=$temp;


                }
            }



            return $view_data;

        });


        $batches = CourseParticipants::getActiveCourse();

        $events=array();
        $colors=array('#578ebe','#1BBC9B','#555555','#d05454','#E87E04','#8E44AD','#c8d046','#1BBC9B');

        $i=0;
        foreach($batches as $batch)
        {

            $temp=array();
            $temp['title']= $batch->course_name;
            $temp['start']=date('Y-m-d', strtotime($batch->c_start_date));
            $temp['end']=date('Y-m-d', strtotime($batch->c_end_date));
            $temp['backgroundColor']= $colors[$i%count($colors)];
            $temp['url']=url('courses/upcoming-courses/batches/'. $batch->id);
            $events[]= $temp;


            $i++;
        }
        $events=json_encode($events);

        return view('user_courses.home', ['view_data' => $view_data,'batches' => $batches,'events' => $events]);
    }
    public function basic_technical_analysis()
    {
        $course_details=\DB::select("select * from courses where id=36");
        return view('user_courses.course_details', ['course_details' => $course_details[0]]);
    }
    public function executive_technical_analysis()
    {
        $course_details=\DB::select("select * from courses where id=33");
        return view('user_courses.course_details', ['course_details' => $course_details[0]]);
    }
    public function free_technical_analysis()
    {
        $course_details=\DB::select("select * from courses where id=47");
        return view('user_courses.course_details', ['course_details' => $course_details[0]]);
    }
    public function advance_technical_analysis()
    {
        $course_details=\DB::select("select * from courses where id=43");
        return view('user_courses.course_details', ['course_details' => $course_details[0]]);
    }
    public function advance_usage_of_amibroker()
    {
        $course_details=\DB::select("select * from courses where id=30");
        return view('user_courses.course_details', ['course_details' => $course_details[0]]);
    }

    public function mechanical_trading_method()
    {
        $course_details=\DB::select("select * from courses where id=38");
        return view('user_courses.course_details', ['course_details' => $course_details[0]]);
    }





    public function basic_fundamental_analysis()
    {
        $course_details=\DB::select("select * from courses where id=46");
        return view('user_courses.course_details_fundamental', ['course_details' => $course_details[0]]);
    }
    public function business_and_financial_modeling()
    {
        $course_details=\DB::select("select * from courses where id=25");
        return view('user_courses.course_details_fundamental', ['course_details' => $course_details[0]]);
    }
    public function risk_management()
    {
        $course_details=\DB::select("select * from courses where id=37");
        return view('user_courses.course_details_fundamental', ['course_details' => $course_details[0]]);
    }
    public function standard_financial_reporting_with_useful_tips()
    {
        $course_details=\DB::select("select * from courses where id=32");
        return view('user_courses.course_details_fundamental', ['course_details' => $course_details[0]]);
    }
}
