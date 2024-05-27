<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Uuid;
use Carbon\Carbon;
use App\Models\FormInput;
use App\Models\FileUpload;
use App\Models\question;
use App\Models\answer;
use App\Models\AnswerSave;
use Brian2694\Toastr\Facades\Toastr;

class FormController extends Controller
{
    /** form index */
    public function formIndex()
    {
        return view('form.forminput');
    }

    /** save record */
    public function formSaveRecord(Request $request)
    {
        $request->validate([
            'full_name'   => 'required|string|max:255',
            'gender'      => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'state'       => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'country'     => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'blood_group' => 'required|not_in:0',
        ]);

        DB::beginTransaction();
        try {

            $saveRecord = new FormInput;
            $saveRecord->full_name   = $request->full_name;
            $saveRecord->gender      = $request->gender;
            $saveRecord->address     = $request->address;
            $saveRecord->state       = $request->state;
            $saveRecord->city        = $request->city;
            $saveRecord->country     = $request->country;
            $saveRecord->postal_code = $request->postal_code;
            $saveRecord->blood_group = $request->blood_group;
            $saveRecord->save();
            DB::commit();
            Toastr::success('Data has been saved successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Data save fail :)','Error');
            return redirect()->back();
        }
    }

    /** page form view */
    public function formView()
    {
        $dataFormInput = FormInput::all();
        return view('pageview.form-input-table',compact('dataFormInput'));
    }

    /** page edit form input */
    public function formInputEdit($id)
    {
        $formInputView = FormInput::where('id',$id)->first();
        return view('pageview.form-input-edit',compact('formInputView'));
    }

    /** update record form input */
    public function formUpdateRecord(Request $request)
    {
        $request->validate([
            'full_name'   => 'required|string|max:255',
            'gender'      => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'state'       => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'country'     => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'blood_group' => 'required|not_in:0',
        ]);

        DB::beginTransaction();
        try {

            $updateRecord = [
                'full_name'   => $request->full_name,
                'gender'      => $request->gender,
                'address'     => $request->address,
                'state'       => $request->state,
                'city'        => $request->city,
                'country'     => $request->country,
                'postal_code' => $request->postal_code,
                'blood_group' => $request->blood_group,
            ];
            
            FormInput::where('id',$request->id)->update($updateRecord);

            DB::commit();
            Toastr::success('Data has been updated successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Data update fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function formDelete(Request $request)
    {
        try {
            FormInput::destroy($request->id);
            Toastr::success('Data has been deleted successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Data delete fail :)','Error');
            return redirect()->back();
        }
    }

    /** form upload file index */
    public function formUpdateIndex()
    {
        return view('form.form-upload-file');
    }

    /** update file */
    public function formFileUpdate(Request $request) 
    {
        $request->validate([
            'upload_by' => 'required|string|max:255',
            'file_name' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $dt = Carbon::now();
            $date_time = $dt->toDayDateTimeString();
            $folder_name = "file_store";
            \Storage::disk('local')->makeDirectory($folder_name, 0775, true); // create directory
            if($request->hasFile('file_name'))
            {
                foreach($request->file_name as $photos) {
                    $file_name = $photos->getClientOriginalName(); // get file original name
                    $saveRecord = new FileUpload;
                    $saveRecord->upload_by = $request->upload_by;
                    $saveRecord->date_time = $date_time;
                    $saveRecord->file_name = $file_name;
                    $saveRecord->uuid = Uuid::generate(5,$date_time . $file_name .$folder_name, Uuid::NS_DNS);
                    \Storage::disk('local')->put($folder_name.'/'.$file_name,file_get_contents($photos->getRealPath()));
                    $saveRecord->save();
                }
                DB::commit();
                Toastr::success('Data has been saved successfully :)','Success');
                return redirect()->back();
            }

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Data save fail :)','Error');
            return redirect()->back();
        }
    }

    /** view file upload */
    public function formFileView()
    {
        $fileUpload = FileUpload::all();
        return view('pageview.view-file-upload-table',compact('fileUpload'));
    }

    /** file upload */
    public function fileDownload($file_name)
    {
        $fileDownload = FileUpload::where('file_name',$file_name)->first();
        $download     = storage_path("app/file_store/{$fileDownload->file_name}");
        return \Response::download($download);
    }

    /** delete record and remove file in folder */
    public function fileDelete(Request $request)
    {
        try {
            FileUpload::destroy($request->id);
            unlink(storage_path("app/file_store/".$request->file_name));
            Toastr::success('Data has been deleted successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Data delete fail :)','Error');
            return redirect()->back();
        }
    }

    /** radio index page */
    public function radioIndex()
    {
        $questions = question::all();
        $answers   = answer::all();
        return view('form.form-radio',compact('questions','answers'));
    }

    /** save record */
    public function radioSave(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->question_id1 == 1) {
                $count = 1;
                foreach ($request->input('answer_name'.$count) as $key => $answer) {
                    $saveRecord = [
                        'answer_name'=> $request->input('answer_name'.$count)[$key],
                        'question_id'=> $request->input('question_id'.$count)[$key],
                    ];
                }
                DB::table('answer_saves')->insert($saveRecord);
            }
            if ($request->question_id2 == 2) {
                $count = 2;
                foreach ($request->input('answer_name'.$count) as $key => $answer) {
                    $saveRecord = [
                        'answer_name'=> $request->input('answer_name'.$count)[$key],
                        'question_id'=> $request->input('question_id'.$count)[$key],
                    ];
                }
                DB::table('answer_saves')->insert($saveRecord);
            }
            if ($request->question_id3 == 3) {
                $count = 3;
                foreach ($request->input('answer_name'.$count) as $key => $answer) {
                    $saveRecord = [
                        'answer_name'=> $request->input('answer_name'.$count)[$key],
                        'question_id'=> $request->input('question_id'.$count)[$key],
                    ];
                }
                DB::table('answer_saves')->insert($saveRecord);
            }

            DB::commit();
            Toastr::success('Question has been saved successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Question save fail :)','Error');
            return redirect()->back();
        }
    }

    /** checkbox index page */
    public function checkboxIndex()
    {
        return view('form.form-checkbox');
    }

    /** save record checkbox */
    public function saveRecordCheckbox(Request $request)
    {
        DB::beginTransaction();
        try {

            $id_value = DB::table('language_codes')->select('id')->orderBy('id','DESC')->first();
            if(!empty($id_value->id)) { /** if id in table not null */
                $language_id = $id_value->id;
            } else { /** id in table is null */
                $language_id = 1;
            }

            if ($request->front_end_id == 1) {
                for ($i = 0; $i< count($request->front_end);$i++) {
                    $saveRecord = [
                        'id_value'      => $request->front_end_id,
                        'language_name' => $request->front_end[$i],
                        'language_id'   => $language_id,
                    ];
                    DB::table('language_codes')->insert($saveRecord);
                }
            }
            
            if ($request->back_end_id == 2) {
                for ($i = 0; $i< count($request->back_end);$i++) {
                    $saveRecord = [
                        'id_value'      => $request->back_end_id,
                        'language_name' => $request->back_end[$i],
                        'language_id'   => $language_id,
                    ];
                    DB::table('language_codes')->insert($saveRecord);
                }
            }
           
            DB::commit();
            Toastr::success('Data has been saved successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Data save fail :)','Error');
            return redirect()->back();
        }
    }
}
