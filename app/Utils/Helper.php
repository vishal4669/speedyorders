<?php

namespace App\Utils;

use App\Models\AirlineCarrier;
use App\Models\Airport;
use App\Models\EmailTemplate;
use App\Jobs\SendEmail;
use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Helper
{
    /**ADMIN USERS TABLE STATUS */
    const DELETED = 0;

    const INACTIVE = 0;

    const ACTIVE = 1;

    const AGENT_DISAPPROVE_STATUS = 0;

    const AGENT_APPROVE_STATUS = 1;


    /**
     * RBAC ROLES
     */
    const SUPER_ADMIN_ROLE = 1;

    /**
     * minio folder path
     */
    const ASSETS_FOLDER = 'assets/';
  
    public static function sendMail($emailPayload)
    {
        try {

            $emailTemplate = isset($emailPayload['template_id']) ? EmailTemplate::find($emailPayload['template_id']) : null;
            $emailBody = ($emailTemplate) ? $emailTemplate->description : $emailPayload['body'];
            $emailSubject = ($emailTemplate) ? $emailTemplate->subject : $emailPayload['subject'];
            $email_job = [
                'subject' => $emailSubject,
                'to' => $emailPayload['email'],
                'body' => $emailBody,
                'has_attachment' => isset($emailPayload['file']) ? $emailPayload['file'] : '',
            ];

            $vars = array(
                '[[FULL_NAME]]' => $emailPayload['name'],
                '[[BODY]]' => $emailBody
            );

            $email_job['vars'] = $vars;

            SendEmail::dispatch($email_job);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

}
