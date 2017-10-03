<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseParticipantPayments;
use App\CourseParticipants;

class CoursePaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $participant = CourseParticipants::find($id);
      $payments = CourseParticipantPayments::where('course_participant_id', $id)->get();

      return view('admin_courses.payments.list', ['participant' => $participant, 'payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      //  dd('create');
        $participant = CourseParticipants::find($id);
        return view('admin_courses.payments.create', ['participant' => $participant]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'payment_mr_no' => 'required|max:30',
           'payment_type' => 'required|max:20',
           'payment_amount' => 'required',
           'payment_mr_no' => 'required|max:30',
           'payment_due' => 'required',
        ]);

        $payment = new CourseParticipantPayments();
        $payment->payment_mr_no = $request->input('payment_mr_no');
        $payment->payment_type = $request->input('payment_type');
        $payment->payment_amount = $request->input('payment_amount');
        $payment->payment_mr_no = $request->input('payment_mr_no');
        $payment->payment_due = $request->input('payment_due');
        $payment->course_participant_id = $request->input('course_participant_id');
        $payment->payment_date = date('Y-m-d H:i:s');
        $payment->save();

        return redirect()->route('participant_payment.index', ['id' => $request->input('course_participant_id') ])->with('message_success', 'Payment successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
}
