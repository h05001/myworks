<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RecordingCard;

class RecordingCardController extends Controller
{
    //
    public function add()
  {
      return view('admin.recordingcard.create');
  }

    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, RecordingCard::$rules);

          $recordingcard = new RecordingCard;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);
          // フォームから送信されてきたimageを削除する
          unset($form['image']);

          // データベースに保存する
          $recordingcard->fill($form);
          $recordingcard->save();

      return redirect('admin/recordingcard/create');
  }

  // 以下を追記
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = RecordingCard::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = RecordingCard::all();
        }
        return view('admin.recordingcard.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
  {
    // RecordingCard Modelからデータを取得する
      $recordingcard = RecordingCard::find($request->id);
      if (empty($recordingcard)) {
        abort(404);
      }
      return view('admin.recordingcard.edit',['recordingcard_form' => $recordingcard]);
  }

    public function update(Request $request)
  {
    // Validationをかける
        $this->validate($request, RecordingCard::$rules);
        // RecordingCard Modelからデータを取得する
        $recordingcard = RecordingCard::find($request->id);
        // 送信されてきたフォームデータを格納する
        $recordingcard_form = $request->all();
        unset($recordingcard_form['_token']);

        // 該当するデータを上書きして保存する
        $recordingcard->fill($recordingcard_form)->save();
      return redirect('admin/recordingcard/');
  }

  public function delete(Request $request)
   {
       // 該当するRecordingCard Modelを取得
       $recordingcard = RecordingCard::find($request->id);
       // 削除する
       $recordingcard->delete();
       return redirect('admin/recordingcard/');
   }

}
