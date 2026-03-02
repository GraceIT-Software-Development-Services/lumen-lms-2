<p>Dear {{ $data['user']->full_name_searchable }},</p>

<p>Congratulations! We are pleased to inform you that your application has been <strong>approved</strong>. You have been successfully assigned to a batch for your upcoming training.</p>

<p>Please find your batch details below:</p>

<table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
     <tr style="background-color: #f3f4f6;">
          <td style="padding: 10px 14px; font-weight: bold; border: 1px solid #e5e7eb; width: 35%;">Batch Name</td>
          <td style="padding: 10px 14px; border: 1px solid #e5e7eb;">{{ $data['batch']->batch_name }}</td>
     </tr>
     <tr>
          <td style="padding: 10px 14px; font-weight: bold; border: 1px solid #e5e7eb;">Program / Course</td>
          <td style="padding: 10px 14px; border: 1px solid #e5e7eb;">{{ $data['course']->course_name }}</td>
     </tr>
     <tr style="background-color: #f3f4f6;">
          <td style="padding: 10px 14px; font-weight: bold; border: 1px solid #e5e7eb;">Start Date</td>
          <td style="padding: 10px 14px; border: 1px solid #e5e7eb;">{{ date('F d, Y', strtotime($data['batch']->start_date)) }}</td>
     </tr>
     <tr>
          <td style="padding: 10px 14px; font-weight: bold; border: 1px solid #e5e7eb;">End Date</td>
          <td style="padding: 10px 14px; border: 1px solid #e5e7eb;">{{ date('F d, Y', strtotime($data['batch']->end_date)) }}</td>
     </tr>
     <tr style="background-color: #f3f4f6;">
          <td style="padding: 10px 14px; font-weight: bold; border: 1px solid #e5e7eb;">Schedule</td>
          <td style="padding: 10px 14px; border: 1px solid #e5e7eb;">
               {{ implode(', ', $data['schedule']->schedule_days) }}
               ({{ date('h:i A', strtotime($data['schedule']->start_time)) }} to {{ date('h:i A', strtotime($data['schedule']->end_time)) }})
          </td>
     </tr>
     <tr>
          <td style="padding: 10px 14px; font-weight: bold; border: 1px solid #e5e7eb;">Location / Venue</td>
          <td style="padding: 10px 14px; border: 1px solid #e5e7eb;">{{ $data['center']->name }}</td>
     </tr>
</table>

<p>Please make sure to be present on your first day of training. If you have any questions or concerns regarding your schedule or batch assignment, do not hesitate to contact us.</p>

<p>We look forward to seeing you and wish you the best in your training journey.</p>

<p>Warm regards,</p>
<p><strong>LUMEN Generation Training and Assessment Center</strong></p>