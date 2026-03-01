<x-mail::message>
     # Training Batch Assignment Confirmed

     Dear **{{ $studentName }}**,

     We are pleased to inform you that your application has been reviewed and you have been successfully assigned to a training batch. Please see the details below.

     <x-mail::panel>
          ## 📋 Training Batch Details

          | | |
          |---|---|
          | **Batch Name** | {{ $data['batch_name'] }} |
          | **Batch Code** | {{ $data['batch_code'] }} |
          | **Start Date** | {{ $data['start_date'] }} |
          | **End Date** | {{ $data['end_date'] }} |
          | **Schedule** | {{ $schedule }} |
          | **Venue** | {{ $venue }} |
          | **Trainer** | {{ $trainer }} |
     </x-mail::panel>

     ### What's Next?

     Please make sure to:

     - Review your training schedule carefully
     - Prepare all required documents before the start date
     - Log in to your student portal for further instructions and updates

     If you have any questions or concerns, feel free to reply to this email or contact our support team.

     Thank you and we look forward to seeing you in training!

     Regards,
     **{{ config('app.name') }}**
     ---
     *This is an automated notification. Please do not reply directly to this email.*
</x-mail::message>