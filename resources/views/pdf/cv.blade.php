<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV - {{ $applicant->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 15px; }
        .label { font-weight: bold; }
        .value { margin-left: 10px; }
        .divider { border-bottom: 1px solid #ccc; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $profile->full_name ?? $applicant->name }}</h2>
        <p>{{ $profile->address ?? '' }} | {{ $profile->phone ?? '' }}</p>
        <p>{{ $profile->dob ?? '' }} | {{ $profile->gender ?? '' }} | {{ $profile->nationality ?? '' }}</p>
    </div>
    <div class="divider"></div>
    <div class="section">
        <span class="label">About:</span>
        <span class="value">{{ $profile->about ?? '' }}</span>
    </div>
    <div class="divider"></div>
    <div class="section">
        <span class="label">Applied For:</span>
        <span class="value">{{ $post->job_title ?? '' }}</span>
    </div>
    <div class="section">
        <span class="label">Company:</span>
        <span class="value">{{ $company->title ?? '' }}</span>
    </div>
    <div class="divider"></div>
    <div class="section">
        <span class="label">Application Date:</span>
        <span class="value">{{ $application->created_at->format('d M Y') }}</span>
    </div>
</body>
</html>
