<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Learner;
use App\Models\LearnerAssociation;
use App\Models\User;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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

        $nttc = $learner->nttc ? json_decode($learner->nttc, true) : [];

        $associations = Association::all();
        $user_associations = LearnerAssociation::where('user_id', $learner->id)->get();

        return view('learner.show', compact(
            'learner',
            'documents',
            'workExperiences',
            'trainings',
            'licensureExamination',
            'competencyAssessment',
            'nttc',
            'associations',
            'user_associations'
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
            'uli'                                    => ['nullable', 'string', 'max:255'],
            'firstName'                              => ['required', 'string', 'max:255'],
            'middleName'                             => ['nullable', 'string', 'max:255'],
            'lastName'                               => ['required', 'string', 'max:255'],
            'suffix'                                 => ['nullable', 'string', 'max:10'],
            'sex'                                    => ['required', 'in:male,female'],
            'civilStatus'                            => ['required', 'in:single,married,widow,separated'],
            'birthDate'                              => ['required', 'date'],
            'birthPlace'                             => ['nullable', 'string', 'max:255'],
            'motherName'                             => ['nullable', 'string', 'max:255'],
            'fatherName'                             => ['nullable', 'string', 'max:255'],

            'picture'                                => ['nullable', 'image', 'max:2048'],
            'schoolName'                             => ['nullable', 'string', 'max:255'],
            'schoolAddress'                          => ['nullable', 'string'],
            'clientType'                             => ['nullable', 'in:Industry Worker,Student,Cooperative,Association,Graduate'],

            'addressNumberStreet'                    => ['nullable', 'string'],
            'addressBarangay'                        => ['nullable', 'string', 'max:255'],
            'addressDistrict'                        => ['nullable', 'string', 'max:255'],
            'addressCity'                            => ['nullable', 'string', 'max:255'],
            'addressProvince'                        => ['nullable', 'string', 'max:255'],
            'addressRegion'                          => ['nullable', 'string', 'max:255'],
            'addressZipCode'                         => ['nullable', 'string', 'max:10'],

            'contactMobile'                          => ['required', 'string', 'max:255'],
            'contactTel'                             => ['nullable', 'string', 'max:255'],
            'contactEmail'                           => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($learner->id)],
            'contactFax'                             => ['nullable', 'string', 'max:255'],
            'contactOthers'                          => ['nullable', 'string'],

            'educationalAttainment'                  => ['nullable', 'in:elementary_graduate,high_school_graduate,tvet_graduate,college_level,college_graduate,others'],
            'educationalAttainmentOthers'            => ['nullable', 'string', 'max:255'],
            'employmentStatus'                       => ['nullable', 'in:casual,job_order,probationary,permanent,self_employed,ofw'],

            'work_experiences'                       => ['nullable', 'array'],
            'work_experiences.*.company'             => ['nullable', 'string', 'max:255'],
            'work_experiences.*.position'            => ['nullable', 'string', 'max:255'],
            'work_experiences.*.duration'            => ['nullable', 'string', 'max:255'],
            'work_experiences.*.responsibilities'    => ['nullable', 'string'],

            'trainings'                              => ['nullable', 'array'],
            'trainings.*.title'                      => ['nullable', 'string', 'max:255'],
            'trainings.*.provider'                   => ['nullable', 'string', 'max:255'],
            'trainings.*.date'                       => ['nullable', 'string', 'max:255'],
            'trainings.*.hours'                      => ['nullable', 'string', 'max:255'],

            'licensure_examination'                  => ['nullable', 'array'],
            'licensure_examination.*.title'          => ['nullable', 'string', 'max:255'],
            'licensure_examination.*.license_number' => ['nullable', 'string', 'max:255'],
            'licensure_examination.*.date_taken'     => ['nullable', 'string', 'max:255'],
            'licensure_examination.*.validity'       => ['nullable', 'string', 'max:255'],

            'competency_assessment'                      => ['nullable', 'array'],
            'competency_assessment.*.qualification'      => ['nullable', 'string', 'max:255'],
            'competency_assessment.*.certificate_number' => ['nullable', 'string', 'max:255'],
            'competency_assessment.*.date_issued'        => ['nullable', 'string', 'max:255'],
            'competency_assessment.*.expiry_date'        => ['nullable', 'string', 'max:255'],

            'nttc'                                      => 'nullable|array',
            'nttc.*.level'                              => 'nullable|in:Level I,Level II,Level III,Level IV',
            'nttc.*.competency'                         => 'nullable|string|max:255',
            'nttc.*.certificate_number'                 => 'nullable|string|max:255',
            'nttc.*.issued_on'                          => 'nullable|string|max:255',
            'nttc.*.valid_until'                        => 'nullable|string|max:255',
            'nttc.*.file'                               => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:10240'],

            'documents'                              => ['nullable', 'array'],
            'documents.*.id'                         => ['nullable', 'integer', 'exists:user_documents,id'],
            'documents.*.type'                       => ['nullable', 'string'],
            'documents.*.file'                       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],

            'deleted_document_ids'                   => ['nullable', 'array'],
            'deleted_document_ids.*'                 => ['integer', 'exists:user_documents,id'],

            'association_ids'                       => ['nullable', 'array'],
            'association_ids.*'                     => ['integer', 'exists:associations,id'],
        ], [
            'contactEmail.unique'    => 'This email is already used by another learner.',
            'documents.*.file.mimes' => 'Document must be a file of type: jpg, jpeg, png, pdf.',
            'documents.*.file.max'   => 'Each document must not exceed 10MB.',
            'nttc.*.file.mimes'      => 'NTTC file must be a file of type: jpg, jpeg, png, pdf, doc, docx.',
            'nttc.*.file.max'        => 'Each NTTC file must not exceed 10MB.',
        ]);

        DB::transaction(function () use ($request, $validated, $learner) {

            if (!empty($validated['contactEmail'])) {
                $learner->update([
                    'password' => Hash::make('password')
                ]);
            }

            if ($request->hasFile('picture')) {
                if ($learner->picture_path) {
                    Storage::disk('s3')->delete($learner->picture_path);
                }
                $picturePath = $request->file('picture')->store('profile-pictures', 's3');
            } else {
                $picturePath = $learner->picture_path;
            }

            // ── Handle NTTC file uploads ────────────────────────────────────────
            $nttcFiles  = $request->file('nttc', []);
            $nttcInputs = $validated['nttc'] ?? [];

            // Existing NTTC data from DB (decode if stored as JSON string)
            $existingNttc = is_array($learner->nttc)
                ? $learner->nttc
                : (json_decode($learner->nttc ?? '[]', true) ?: []);

            foreach ($nttcInputs as $index => &$nttcItem) {
                $newFile = $nttcFiles[$index]['file'] ?? null;

                if ($newFile && $newFile->isValid()) {
                    // Delete old file if exists
                    $oldPath = $existingNttc[$index]['file_path'] ?? null;
                    if ($oldPath && Storage::disk('s3')->exists($oldPath)) {
                        Storage::disk('s3')->delete($oldPath);
                    }

                    // Store new file
                    $nttcItem['file_path'] = $newFile->store('nttc-documents', 's3');
                } else {
                    // Keep existing file path if no new file uploaded
                    $nttcItem['file_path'] = $existingNttc[$index]['file_path'] ?? null;
                }

                // Remove the uploaded file object before json_encode (not serializable)
                unset($nttcItem['file']);
            }
            unset($nttcItem);

            // 
            $learner->update([
                'uli'                           => $validated['uli'] ?? null,
                'name'                          => $validated['firstName'],
                'middle_name'                   => $validated['middleName'] ?? null,
                'last_name'                     => $validated['lastName'],
                'extension'                     => $validated['suffix'] ?? null,
                'picture_path'                  => $picturePath,
                'email'                         => $validated['contactEmail'] ?? null,
                'school_name'                   => $validated['schoolName'] ?? null,
                'school_address'                => $validated['schoolAddress'] ?? null,
                'client_type'                   => $validated['clientType'] ?? null,
                'address_number_street'         => $validated['addressNumberStreet'] ?? null,
                'address_barangay'              => $validated['addressBarangay'] ?? null,
                'address_city'                  => $validated['addressCity'] ?? null,
                'address_district'              => $validated['addressDistrict'] ?? null,
                'address_province'              => $validated['addressProvince'] ?? null,
                'address_region'                => $validated['addressRegion'] ?? null,
                'address_zip_code'              => $validated['addressZipCode'] ?? null,
                'mother_name'                   => $validated['motherName'] ?? null,
                'father_name'                   => $validated['fatherName'] ?? null,
                'sex'                           => $validated['sex'],
                'civil_status'                  => $validated['civilStatus'],
                'contact_tel'                   => $validated['contactTel'] ?? null,
                'contact_mobile'                => $validated['contactMobile'] ?? null,
                'contact_email'                 => $validated['contactEmail'] ?? null,
                'contact_fax'                   => $validated['contactFax'] ?? null,
                'contact_others'                => $validated['contactOthers'] ?? null,
                'birth_date'                    => $validated['birthDate'],
                'birth_place'                   => $validated['birthPlace'] ?? null,
                'educational_attainment'        => $validated['educationalAttainment'] ?? null,
                'educational_attainment_others' => $validated['educationalAttainmentOthers'] ?? null,
                'employment_status'             => $validated['employmentStatus'] ?? null,
                'work_experiences'              => !empty($validated['work_experiences'])
                    ? json_encode($validated['work_experiences'])
                    : null,
                'trainings'                     => !empty($validated['trainings'])
                    ? json_encode($validated['trainings'])
                    : null,
                'licensure_examination'         => !empty($validated['licensure_examination'])
                    ? json_encode($validated['licensure_examination'])
                    : null,
                'competency_assessment'         => !empty($validated['competency_assessment'])
                    ? json_encode($validated['competency_assessment'])
                    : null,
                'nttc'                          => !empty($nttcInputs)
                    ? json_encode($nttcInputs)
                    : null,
            ]);

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

            $documentFiles  = $request->file('documents', []);
            $documentInputs = $request->input('documents', []);

            foreach ($documentInputs as $index => $docData) {
                $docId   = $docData['id'] ?? null;
                $docType = $docData['type'] ?? null;
                $docFile = $documentFiles[$index]['file'] ?? null;

                if ($docFile && $docFile->isValid()) {

                    $filePath = $docFile->store('learner-documents', 's3');

                    if ($docId) {
                        // Replace existing file
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
                    // Only update type, no new file
                    UserDocument::where('id', $docId)
                        ->where('user_id', $learner->id)
                        ->update(['type' => $docType]);
                }
            }

            if (auth()->user()->hasRole('Trainer')) {
                $associationIds = $request->input('association_ids', []);

                LearnerAssociation::where('user_id', $learner->id)->delete();

                if (!empty($associationIds)) {
                    foreach ($associationIds as $id) {
                        LearnerAssociation::create([
                            'user_id'        => $learner->id,
                            'association_id' => $id,
                        ]);
                    }
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
