<?php
namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Interviewappraisal;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InterviewappraisalController extends Controller
{
    public function index(){
        return view('interview_appraisal.index');
    }

    public function prints($id){
        $show=Interviewappraisal::find($id);
        return view('interview_appraisal.print',compact('show'));
    }
    public function fetch(){
        $data=Interviewappraisal::all();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('id', function ($data) {
                return $data->id;
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('age', function ($data) {
                return $data->age;
            })
            ->addColumn('basic_qualification', function ($data) {
                return $data->basic_qualification;
            })
            ->addColumn('higher_qualification', function ($data) {
                return $data->highest_qualification;
            })
            ->addColumn('bu_for_candidate', function ($data) {
                return $data->bu_for_candidate;
            })
            ->addColumn('options', function ($data) {
                return "&emsp;
                <a title='Edit' class='btn btn-sm btn-success' href='" . url('/interview-appraisal/edit/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-edit'></i></a>
                <a title='Show' class='btn btn-sm btn-warning' href='" . url('/interview-appraisal/show/'. $data->id) . "' data-id='" . $data->id . "'><i class='fa fa-eye'></i></a>

                ";
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    public function create(){
        $departments=Department::all();
        return view('interview_appraisal.create',compact('departments'));
    }
    public function edit($id){
        $departments=Department::all();
        $edit=Interviewappraisal::find($id);
        return view('interview_appraisal.edit',compact('edit','departments'));
    }
    public function show($id){
        $show=Interviewappraisal::find($id);
        return view('interview_appraisal.show',compact('show'));
    }

    public function store(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'age' => 'required',
            'basic_qualification' => 'required',
            'basic_qualification_duration' => 'required',
            'highest_qualification' => 'required',
            'highest_qualification_duration' => 'required',
            'relevant_experience' => 'required',
            'total_experience' => 'required',
            'last_salary' => 'required',
            'desired_salary' => 'required',
            'bu_for_candidate' => 'required',
            'education' => 'required',
            'computer_literacy' => 'required',
            'intelligence' => 'required',
            'experience_related_to_the_job_interviewed_for' => 'required',
            'experience_related_to_the_other_lines_of_company_business' => 'required',
            'job_knowledge_skills' => 'required',
            'personality' => 'required',
            'communication_skills' => 'required',
            'development_potential_motivation' => 'required',
            'personal_aptitude_related_to_the_job_interviewed_for' => 'required',
            'suitability_for_other_department' => 'required',
        ]);

        $perosnal_trait=array(
            'education'=>$request->education,
            'computer_literacy'=>$request->computer_literacy,
            'intelligence'=>$request->intelligence,
            'experience_related_to_the_job_interviewed_for'=>$request->experience_related_to_the_job_interviewed_for,
            'experience_related_to_the_other_lines_of_company_business'=>$request->experience_related_to_the_other_lines_of_company_business,
            'job_knowledge_skills'=>$request->job_knowledge_skills,
            'personality'=>$request->personality,
            'communication_skills'=>$request->communication_skills,
            'development_potential_motivation'=>$request->development_potential_motivation,
            'personal_aptitude_related_to_the_job_interviewed_for'=>$request->personal_aptitude_related_to_the_job_interviewed_for
        );
        $appraisal=new Interviewappraisal();
        $appraisal->fname=$request->fname;
        $appraisal->lname=$request->lname;
        $appraisal->age=$request->age;
        $appraisal->basic_qualification=$request->basic_qualification;
        $appraisal->basic_qualification_duration=$request->basic_qualification_duration;
        $appraisal->highest_qualification=$request->highest_qualification;
        $appraisal->highest_qualification_duration=$request->highest_qualification_duration;
        $appraisal->relevant_experience=$request->relevant_experience;
        $appraisal->total_experience=$request->total_experience;
        $appraisal->last_salary=$request->last_salary;
        $appraisal->desired_salary=$request->desired_salary;
        $appraisal->bu_for_candidate=$request->bu_for_candidate;
        $appraisal->suitable_for_other_department=$request->suitability_for_other_department;
        $appraisal->personal_traits= json_encode($perosnal_trait);
        $appraisal->evaluator=auth()->user()->id;
        $appraisal->save();
        return  redirect()->back()->with('success', 'Interview appraisal has added successfully.');
    }
    public function update(Request $request){
        //dd($request->all());
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',

            'age' => 'required',
            'basic_qualification' => 'required',
            'basic_qualification_duration' => 'required',
            'highest_qualification' => 'required',
            'highest_qualification_duration' => 'required',
            'relevant_experience' => 'required',
            'total_experience' => 'required',
            'last_salary' => 'required',
            'desired_salary' => 'required',
            'bu_for_candidate' => 'required',
            'education' => 'required',
            'computer_literacy' => 'required',
            'intelligence' => 'required',
            'experience_related_to_the_job_interviewed_for' => 'required',
            'experience_related_to_the_other_lines_of_company_business' => 'required',
            'job_knowledge_skills' => 'required',
            'personality' => 'required',
            'communication_skills' => 'required',
            'development_potential_motivation' => 'required',
            'personal_aptitude_related_to_the_job_interviewed_for' => 'required',
            'suitability_for_other_department' => 'required',

        ]);

        $perosnal_trait=array(
            'education'=>$request->education,
            'computer_literacy'=>$request->computer_literacy,
            'intelligence'=>$request->intelligence,
            'experience_related_to_the_job_interviewed_for'=>$request->experience_related_to_the_job_interviewed_for,
            'experience_related_to_the_other_lines_of_company_business'=>$request->experience_related_to_the_other_lines_of_company_business,
            'job_knowledge_skills'=>$request->job_knowledge_skills,
            'personality'=>$request->personality,
            'communication_skills'=>$request->communication_skills,
            'development_potential_motivation'=>$request->development_potential_motivation,
            'personal_aptitude_related_to_the_job_interviewed_for'=>$request->personal_aptitude_related_to_the_job_interviewed_for
        );
        $appraisal=Interviewappraisal::find($request->id);
        $appraisal->fname=$request->fname;
        $appraisal->lname=$request->lname;
        $appraisal->age=$request->age;
        $appraisal->basic_qualification=$request->basic_qualification;
        $appraisal->basic_qualification_duration=$request->basic_qualification_duration;
        $appraisal->highest_qualification=$request->highest_qualification;
        $appraisal->highest_qualification_duration=$request->highest_qualification_duration;
        $appraisal->relevant_experience=$request->relevant_experience;
        $appraisal->total_experience=$request->total_experience;
        $appraisal->last_salary=$request->last_salary;
        $appraisal->desired_salary=$request->desired_salary;
        $appraisal->bu_for_candidate=$request->bu_for_candidate;
        $appraisal->suitability_for_other_department=$request->suitability_for_other_department;
        $appraisal->personal_traits= json_encode($perosnal_trait);
        $appraisal->save();
        return  redirect()->back()->with('success', 'Interview appraisal has updated successfully.');
    }
    //
}