 <pre style="font-size: 14px">
Dear User {{$user->name}}, 
Thanks for interest in our Amirbroker data plugin. We have successfully received your request.

@if($user->plugin_apply == 4)
{{-- course  --}}
We will contact you shortly to verify. Please make sure that your contact number is valid. 
You can check/change it by <a href="{{url('/user-information')}}">clicking here<a/>.
@else
Please pay your subscription fee.
How to Active Your plugin
============================
Please email us the scanned copy of the deposit slip with your registered User Email to info@stockbangladesh.com. 
If you pay through bKash please email us the mobile no that you used to pay.

Your account will be active within one working day and you will receive a confirmation email.

Deposit :
==============================
Bank Details : 
Account Name : Stock Bangladesh Ltd.
Account No : 107-110-9792
Bank Name : Dutch-Bangla Bank Ltd.
Branch Name : Kawran Bazar Br.

bkash account details :
===============================
phone : +8801929-912870
@endif

-------------------------------------------------------------------
For any query please call : 0192 9912 878
--------------------------------------------------------------------

</pre>