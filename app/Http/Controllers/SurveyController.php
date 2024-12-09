<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Quesionnairs;
use App\Models\TheEntry;
use App\Models\User;
use App\Notifications\EmergencyNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class SurveyController extends Controller
{
    public function get()
    {

        $quessionnairs = DB::table('quesionnairs')->get();
        return view('survey.getsurvey', compact('quessionnairs'));
    }

    public function create()
    {

        $questionnairs = Quesionnairs::get();
        return view('survey.createnew', compact('questionnairs'));
    }

    public function store(Request $request)
    {

        $question_id = Quesionnairs::insertGetId([
            'question' => $request->question,
        ]);

        $choices = Count($request->choice);

        if ($choices != NULL) {

            for ($i = 0; $i < $choices; $i++) {

                $chcount = new Choice();
                $chcount->question_id = $question_id;
                $chcount->choice = $request->choice[$i];
                $chcount->points = $request->points[$i];
                $chcount->save();
            }
        }

        $notification = array(
            'message' => 'تم إنشاء السؤال بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('create.survey')->with($notification);
    }

    public function update(Request $request)
    {

        Quesionnairs::whereId($request->id)->update([
            'id'     =>  $request->id,
            'question' => $request->question,
        ]);

        $choices = Choice::where('question_id', $request->id)->delete();

        for ($i = 0; $i < $choices; $i++) {

            $chcount = new Choice();
            $chcount->question_id = $request->id;
            $chcount->choice = $request->choice[$i];
            $chcount->points = $request->points[$i];
            $chcount->save();
        }

        $notification = array(
            'message' => 'تم تعديل السؤال بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('create.survey')->with($notification);
    }

    public function DeleteQuestion($id)
    {

        Quesionnairs::where('id', $id)->delete();

        Choice::where('question_id', $id)->delete();

        $notification = array(
            'message' => 'تم حذف السؤال بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('create.survey')->with($notification);
    }

    ///From here Entry Operations starts.

    public function storeEntry(Request $request)
    {
        if ($request->counts != NULL) {
            TheEntry::create([

                'user_id' => Auth::user()->id,
                'user_name' => Auth::user()->name,
                'counts' =>  array_sum($request->counts),
            ]);

            $user = User::where('role', 'student')->where('id', Auth::user()->id)->get();

            Notification::send($user, new EmergencyNotification($request->user_name));


            $notification = array(
                'message' => 'تمت معالجة بياناتك بنجاح',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard')->with($notification);
        } else {

            $request->session()->put('Error', 'لايمكنك إرسال النموذج دون تعبئة الإستبيان');
            return redirect()->back();
        }
    }


    public function MarkAsRead(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications->where('id', $notificationId)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['count' => $user->unreadNotifications->count()]);
    }
}
