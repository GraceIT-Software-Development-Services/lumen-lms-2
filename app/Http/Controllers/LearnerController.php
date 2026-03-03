<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LearnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $learner = User::where('id', auth()->user()->id)->first();
        return view('learner.index', compact('learner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $learner = User::where('uuid', $uuid)->firstOrFail();
        $documents = UserDocument::where('user_id', $learner->id)->get();

        $workExperiences     = $learner->work_experiences
            ? json_decode($learner->work_experiences, true)
            : [];

        $trainings           = $learner->trainings
            ? json_decode($learner->trainings, true)
            : [];

        $licensureExamination = $learner->licensure_examination
            ? json_decode($learner->licensure_examination, true)
            : [];

        $competencyAssessment = $learner->competency_assessment
            ? json_decode($learner->competency_assessment, true)
            : [];

        return view('learner.show', compact(
            'learner',
            'documents',
            'workExperiences',
            'trainings',
            'licensureExamination',
            'competencyAssessment',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Learner $learner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $learner = User::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'picture'                        => 'nullable|image|max:2048',
            'school_name'                    => 'nullable|string|max:255',
            'school_address'                 => 'nullable|string',
            'client_type'                    => 'nullable|in:tvet_graduating_student,tvet_graduate,industry_worker,k12,owf',

            'sex'                            => 'nullable|in:male,female',
            'civil_status'                   => 'nullable|in:single,married,widow,separated',
            'birth_date'                     => 'nullable|date',
            'birth_place'                    => 'nullable|string|max:255',
            'mother_name'                    => 'nullable|string|max:255',
            'father_name'                    => 'nullable|string|max:255',

            'address_number_street'          => 'nullable|string',
            'address_barangay'               => 'nullable|string|max:255',
            'address_district'               => 'nullable|string|max:255',
            'address_city'                   => 'nullable|string|max:255',
            'address_province'               => 'nullable|string|max:255',
            'address_region'                 => 'nullable|string|max:255',
            'address_zip_code'               => 'nullable|string|max:10',

            'contact_mobile'                 => 'nullable|string|max:255',
            'contact_tel'                    => 'nullable|string|max:255',
            'contact_email'                  => 'nullable|email|max:255',
            'contact_fax'                    => 'nullable|string|max:255',
            'contact_others'                 => 'nullable|string',

            'educational_attainment'         => 'nullable|in:elementary_graduate,high_school_graduate,tvet_graduate,college_level,college_graduate,others',
            'educational_attainment_others'  => 'nullable|string|max:255',
            'employment_status'              => 'nullable|in:casual,job_order,probationary,permanent,self_employed,ofw',

            'work_experiences'               => 'nullable|array',
            'work_experiences.*.company'     => 'nullable|string|max:255',
            'work_experiences.*.position'    => 'nullable|string|max:255',
            'work_experiences.*.duration'    => 'nullable|string|max:255',
            'work_experiences.*.responsibilities' => 'nullable|string',

            'trainings'                      => 'nullable|array',
            'trainings.*.title'              => 'nullable|string|max:255',
            'trainings.*.provider'           => 'nullable|string|max:255',
            'trainings.*.date'               => 'nullable|string|max:255',
            'trainings.*.hours'              => 'nullable|string|max:255',

            'licensure_examination'                   => 'nullable|array',
            'licensure_examination.*.title'           => 'nullable|string|max:255',
            'licensure_examination.*.license_number'  => 'nullable|string|max:255',
            'licensure_examination.*.date_taken'      => 'nullable|string|max:255',
            'licensure_examination.*.validity'        => 'nullable|string|max:255',

            'competency_assessment'                      => 'nullable|array',
            'competency_assessment.*.qualification'      => 'nullable|string|max:255',
            'competency_assessment.*.certificate_number' => 'nullable|string|max:255',
            'competency_assessment.*.date_issued'        => 'nullable|string|max:255',
            'competency_assessment.*.expiry_date'        => 'nullable|string|max:255',

            // Documents: new uploads
            'documents'                      => 'nullable|array',
            'documents.*.id'                 => 'nullable|integer|exists:user_documents,id',
            'documents.*.type'               => 'nullable|string',
            'documents.*.file'               => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',

            // Documents to delete
            'deleted_document_ids'           => 'nullable|array',
            'deleted_document_ids.*'         => 'integer|exists:user_documents,id',

            'agreedToTerms'                  => 'accepted',
        ], [
            'picture.image'              => 'The file must be an image.',
            'picture.max'                => 'The picture size must not exceed 2MB.',
            'agreedToTerms.accepted'     => 'You must agree to the certification statement before submitting.',
            'documents.*.file.mimes'     => 'Document must be a file of type: jpg, jpeg, png, pdf.',
            'documents.*.file.max'       => 'Each document must not exceed 10MB.',
        ]);

        DB::transaction(function () use ($request, $validated, $learner) {

            // --- Profile picture ---
            if ($request->hasFile('picture')) {
                if ($learner->picture_path) {
                    Storage::disk('s3')->delete($learner->picture_path);
                }
                $picturePath = $request->file('picture')->store('profile-pictures', 's3');
            } else {
                $picturePath = $learner->picture_path;
            }

            // --- Core learner data ---
            $learner->update([
                'school_name'                    => $validated['school_name'] ?? null,
                'school_address'                 => $validated['school_address'] ?? null,
                'client_type'                    => $validated['client_type'] ?? null,
                'picture_path'                   => $picturePath,

                'sex'                            => $validated['sex'] ?? null,
                'civil_status'                   => $validated['civil_status'] ?? null,
                'birth_date'                     => $validated['birth_date'] ?? null,
                'birth_place'                    => $validated['birth_place'] ?? null,
                'mother_name'                    => $validated['mother_name'] ?? null,
                'father_name'                    => $validated['father_name'] ?? null,

                'address_number_street'          => $validated['address_number_street'] ?? null,
                'address_barangay'               => $validated['address_barangay'] ?? null,
                'address_district'               => $validated['address_district'] ?? null,
                'address_city'                   => $validated['address_city'] ?? null,
                'address_province'               => $validated['address_province'] ?? null,
                'address_region'                 => $validated['address_region'] ?? null,
                'address_zip_code'               => $validated['address_zip_code'] ?? null,

                'contact_mobile'                 => $validated['contact_mobile'] ?? null,
                'contact_tel'                    => $validated['contact_tel'] ?? null,
                'contact_email'                  => $validated['contact_email'] ?? null,
                'contact_fax'                    => $validated['contact_fax'] ?? null,
                'contact_others'                 => $validated['contact_others'] ?? null,
                'email'                          => $validated['contact_email'] ?? null,

                'educational_attainment'         => $validated['educational_attainment'] ?? null,
                'educational_attainment_others'  => $validated['educational_attainment_others'] ?? null,
                'employment_status'              => $validated['employment_status'] ?? null,

                'work_experiences'               => !empty($validated['work_experiences'])
                    ? json_encode($validated['work_experiences'])
                    : null,
                'trainings'                      => !empty($validated['trainings'])
                    ? json_encode($validated['trainings'])
                    : null,
                'licensure_examination'          => !empty($validated['licensure_examination'])
                    ? json_encode($validated['licensure_examination'])
                    : null,
                'competency_assessment'          => !empty($validated['competency_assessment'])
                    ? json_encode($validated['competency_assessment'])
                    : null,

                'agreed_to_terms'                => true,
            ]);

            // --- Delete removed documents ---
            if (!empty($validated['deleted_document_ids'])) {
                $toDelete = UserDocument::whereIn('id', $validated['deleted_document_ids'])
                    ->where('user_id', $learner->id)
                    ->get();

                foreach ($toDelete as $doc) {
                    if ($doc->file && Storage::disk('s3')->exists($doc->file)) {
                        Storage::disk('s3')->delete($doc->file);
                    }
                    $doc->delete();
                }
            }
            // --- Upsert documents ---
            $documentFiles = $request->file('documents', []);
            $documentInputs = $request->input('documents', []);

            foreach ($documentInputs as $index => $docData) {
                $docId   = $docData['id'] ?? null;
                $docType = $docData['type'] ?? null;
                $docFile = $documentFiles[$index]['file'] ?? null;

                if ($docFile && $docFile->isValid()) {
                    $filePath = $docFile->store('learner-documents', 's3');

                    if ($docId) {
                        // Replace existing
                        $existing = UserDocument::find($docId);
                        if ($existing && $existing->file) {
                            Storage::disk('s3')->delete($existing->file);
                        }
                        $existing?->update(['type' => $docType, 'file' => $filePath]);
                    } else {
                        // New document
                        UserDocument::create([
                            'user_id' => $learner->id,
                            'type'    => $docType,
                            'file'    => $filePath,
                        ]);
                    }
                } elseif ($docId) {
                    // Only update type, no new file uploaded
                    UserDocument::where('id', $docId)
                        ->where('user_id', $learner->id)
                        ->update(['type' => $docType]);
                }
            }
        });

        return redirect()->back()->with('success', 'Learner information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Learner $learner)
    {
        //
    }
}
