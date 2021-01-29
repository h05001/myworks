<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RecordingPack;

class RecordingPackController extends Controller
{
    //
    public function add()
  {
      return view('admin.recordingpack.create');
  }

    public function create(Request $request)
  {
    // Varidationを行う
          $this->validate($request, RecordingPack::$rules);

          $recordingpack = new RecordingPack;
          $form = $request->all();

          // フォームから送信されてきた_tokenを削除する
          unset($form['_token']);

          // データベースに保存する
          $recordingpack->fill($form);
          $recordingpack->save();

      return redirect('admin/recordingpack/create');
  }

  // 以下を追記
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = RecordingPack::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = RecordingPack::all();
        }
        return view('admin.recordingpack.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }


    public function edit(Request $request)
  {
    // RecordingPack Modelからデータを取得する
      $recordingpack = RecordingPack::find($request->id);
      if (empty($recordingpack)) {
        abort(404);
      }
      return view('admin.recordingpack.edit',['recordingpack_form' => $recordingpack]);
  }

    public function update(Request $request)
  {
    // Validationをかける
        $this->validate($request, RecordingPack::$rules);
        // RecordingPack Modelからデータを取得する
        $recordingpack = RecordingPack::find($request->id);
        // 送信されてきたフォームデータを格納する
        $recordingpack_form = $request->all();
        unset($recordingpack_form['_token']);

        // 該当するデータを上書きして保存する
        $recordingpack->fill($recordingpack_form)->save();
      return redirect('admin/recordingpack/');
  }

  public function delete(Request $request)
   {
       // 該当するRecordingPack Modelを取得
       $recordingpack = RecordingPack::find($request->id);
       // 削除する
       $recordingpack->delete();
       return redirect('admin/recordingpack/');
   }

}
