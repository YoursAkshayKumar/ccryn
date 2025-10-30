<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Form | Central Council for Research in Yoga & Naturopathy (CCRYN)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
            background-color: #fff;
            margin: 20px;
        }
        .container {
            width: 95%;
            margin: auto;
        }
        h2, h4 {
            text-align: center;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px 8px;
            vertical-align: middle;
        }
        th {
            background-color: #f0f0f0;
        }
        .section-title {
            margin-top: 20px;
            font-weight: bold;
            background-color: #eee;
            padding: 6px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .print-btn {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .print-btn:hover {
            background: #218838;
        }
        @media print {
            .print-btn { display: none; }
            body { margin: 0; }
        }
    </style>
</head>
<body>
<div class="container" id="applicationForm">
    <div class="text-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" height="80">
        <h2>Central Council for Research in Yoga & Naturopathy (CCRYN)</h2>
        <h4>Application Form for Registration</h4>
    </div>

    <div class="text-right">
        <button class="print-btn" onclick="window.print()">🖨 Print / Save as PDF</button>
    </div>

    <table>
        <tr>
            <td><strong>Application No</strong></td>
            <td>{{ $applicant->application_no }}</td>
            <td><strong>Applicant Name</strong></td>
            <td>{{ $applicant->applicant_name }}</td>
        </tr>
        <tr>
            <td><strong>Gender</strong></td>
            <td>{{ $applicant->gender }}</td>
            <td><strong>Date of Birth</strong></td>
            <td>{{ \Carbon\Carbon::parse($applicant->dob)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Place of Birth</strong></td>
            <td>{{ $applicant->place_of_birth }}</td>
            <td><strong>Father's Name</strong></td>
            <td>{{ $applicant->fathers_name }}</td>
        </tr>
        <tr>
            <td><strong>Category</strong></td>
            <td>{{ $applicant->category }}</td>
            <td><strong>Religion</strong></td>
            <td>{{ $applicant->religion }}</td>
        </tr>
        <tr>
            <td><strong>Mobile No</strong></td>
            <td>{{ $applicant->mobile_no }}</td>
            <td><strong>Aadhaar No</strong></td>
            <td>{{ $applicant->aadhaar_no }}</td>
        </tr>
    </table>

    <div class="section-title">Permanent Address</div>
    <table>
        <tr>
            <td><strong>House No</strong></td>
            <td>{{ $applicant->address->permanent_house_no ?? '' }}</td>
            <td><strong>Village/Locality</strong></td>
            <td>{{ $applicant->address->permanent_village_locality ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Police Station</strong></td>
            <td>{{ $applicant->address->permanent_police_station ?? '' }}</td>
            <td><strong>District</strong></td>
            <td>{{ $applicant->address->permanent_district ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>State</strong></td>
            <td>{{ $applicant->address->permanent_state ?? '' }}</td>
            <td><strong>Country</strong></td>
            <td>{{ $applicant->address->permanent_country ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>PIN Code</strong></td>
            <td>{{ $applicant->address->permanent_pin_code ?? '' }}</td>
            <td><strong>Nationality</strong></td>
            <td>{{ $applicant->nationality ?? '' }}</td>
        </tr>
    </table>

    <div class="section-title">Correspondence Address</div>
    <table>
        <tr>
            <td><strong>House No</strong></td>
            <td>{{ $applicant->address->correspondence_house_no ?? '' }}</td>
            <td><strong>Village/Locality</strong></td>
            <td>{{ $applicant->address->correspondence_village_locality ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Police Station</strong></td>
            <td>{{ $applicant->address->correspondence_police_station ?? '' }}</td>
            <td><strong>District</strong></td>
            <td>{{ $applicant->address->correspondence_district ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>State</strong></td>
            <td>{{ $applicant->address->correspondence_state ?? '' }}</td>
            <td><strong>Country</strong></td>
            <td>{{ $applicant->address->correspondence_country ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>PIN Code</strong></td>
            <td colspan="3">{{ $applicant->address->correspondence_pin_code ?? '' }}</td>
        </tr>
    </table>

    <div class="section-title">Educational Qualifications</div>
    <table>
        <thead>
            <tr>
                <th>Qualification</th>
                <th>Examining Body</th>
                <th>Institution Name</th>
                <th>Course Start</th>
                <th>Course End</th>
                <th>Max Marks</th>
                <th>Obtained Marks</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicant->educations as $edu)
            <tr>
                <td>{{ $edu->qualification }}</td>
                <td>{{ $edu->examining_body }}</td>
                <td>{{ $edu->institution_name }}</td>
                <td>{{ $edu->course_start_year }}</td>
                <td>{{ $edu->course_end_year }}</td>
                <td>{{ $edu->max_marks }}</td>
                <td>{{ $edu->obtained_marks }}</td>
                <td>{{ $edu->percentage }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Internship Details</div>
    <table>
        <tr>
            <td><strong>Hospital / Organization Name</strong></td>
            <td>{{ $applicant->internship->organization_name ?? '' }}</td>
            <td><strong>Address</strong></td>
            <td>{{ $applicant->internship->address ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>District</strong></td>
            <td>{{ $applicant->internship->district ?? '' }}</td>
            <td><strong>Internship Period</strong></td>
            <td>{{ $applicant->internship->internship_start ?? '' }} - {{ $applicant->internship->internship_end ?? '' }}</td>
        </tr>
    </table>

    <div class="section-title">Uploaded Documents</div>
    <table>
        <thead>
            <tr>
                <th>Document Name</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicant->documents as $doc)
            <tr>
                <td>{{ $doc->document_name }}</td>
                <td class="text-center">
                    <a href="{{ asset('storage/' . $doc->file_url) }}" target="_blank">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section-title">Photo & Signature</div>
    <table>
        <tr>
            <td class="text-center">
                <p><strong>Photograph</strong></p>
                @if($applicant->photo_url)
                    <img src="{{ asset('storage/' . $applicant->photo_url) }}" height="120">
                @endif
            </td>
            <td class="text-center">
                <p><strong>Signature</strong></p>
                @if($applicant->signature_url)
                    <img src="{{ asset('storage/' . $applicant->signature_url) }}" height="60">
                @endif
            </td>
        </tr>
    </table>

    <p class="section-title">Declaration</p>
    <p style="line-height:1.6;">
        I hereby declare that all the information submitted by me in this application form is correct, true, and valid.
        If any ambiguity or false information is found, my registration will be cancelled automatically with immediate effect.
    </p>
</div>
</body>
</html>
