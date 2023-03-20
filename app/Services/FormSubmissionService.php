<?php

namespace App\Services\Auth;

use App\Helpers\UuidGeneratorHelper;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormSubmissionService
{
    public function register($data, $role)
    {
        DB::beginTransaction();
        try {
            $last_name = '';
            if (isset($data['last_name']) && !empty($data['last_name'])) {
                $last_name = $data['last_name'];
            }

            $uuid = UuidGeneratorHelper::generateUniqueUuidForTable('users');

            $user = User::create([
                'role_id' => Role::where('name', '=', $role)->pluck('id')->first(),
                'uuid' =>  $uuid,
                'first_name' => $data['first_name'],
                'last_name' => $last_name,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'verification_token' => Str::random(40),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            switch ($role) {
                case 'agency':
                    $APP_URL = str_replace(['http://', 'https://', 'www.'], '', config('app.url'));
                    $tenant_domain = preg_replace('/[^a-zA-Z0-9]+/', '', strtolower($data['subdomain'])) . '.' . $APP_URL;

                    $tenant = new Tenant();
                    $tenant->save();
                    $tenant->domains()->create([
                        'domain' => $tenant_domain,
                    ]);

                    $login_domain = request()->getScheme() . '://' . $tenant_domain;

                    $agency = new Agency();
                    $agency->user_id = $user->id;
                    $agency->tenant_id = $tenant->id;
                    $agency->uuid = UuidGeneratorHelper::generateUniqueUuidForTable('agencies');
                    $agency->fill($data);
                    $agency->save();

                    break;
                case 'client':

                    // Set the first and last names from the full name
                    // $user->setNamesFromFullName($data('first_name'));

                    $agency = Agency::where('tenant_id', tenant('id'))->first();
                    $client = new Client();
                    $client->user_id = $user->id;
                    $client->agency_id = $agency->id;
                    $client->uuid = UuidGeneratorHelper::generateUniqueUuidForTable('clients');
                    $data['status'] ?? $data['status'] ?? $data['status'] = 'IN REVIEW';
                    $data['email_verification_token'] = Str::random(10);
                    
                    $client->fill($data);
                    $client->save();
                    break;
                case 'candidate':
                    $agency = Agency::where('tenant_id', tenant('id'))->first();
                    $candidate = new Candidate();
                    $candidate->user_id = $user->id;
                    $candidate->agency_id = $agency->id;

                    $candidate->status = 'APPROVED';

                    $candidate->uuid = UuidGeneratorHelper::generateUniqueUuidForTable('candidates');
                    $candidate->fill($data);

                    if (isset($data['resume']) && !empty($data['resume'])) {
                        $file = $data['resume'];
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filename = preg_replace('#[ -]+#', '-', $filename);
                        $filename = strtolower($filename);
                        $destinationPath = 'files/candidate/resume/';
                        $file->move($destinationPath, $filename);
                        $candidate->resume = $destinationPath . $filename;
                    }

                    $candidate->save();
                    break;
                default:
                    throw new Exception("Invalid role");
            }

            DB::commit();

            switch ($role) {
                case 'agency':
                    // Send email notification to the newly created agency user
                    dispatch(new SendNewAgencyUserNotificationJob($user->email, $data['password'], $login_domain));
                    break;
                case 'client':
                     // Send Verification Mail
                    dispatch(new SendEmailVerificationMailClientJob($user));
                
                    // Send email notification to the agency about client
                    dispatch(new SendNewClientNotificationJob($user, $agency->id));
                    break;
                case 'candidate':
                    dispatch(new NewCandidateNotificationJob($user, $agency->id));
                    
      
                    break;
                default:
                    throw new Exception("Invalid role");
            }

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function verify(Request $request, $token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();
        $user->email_verified_at = Carbon::now();
        $user->save();

        return view('email-verified');
    }
}
