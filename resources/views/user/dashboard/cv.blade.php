<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV-Download</title>

    <style>
        body {
            font-size: 16px;
        }

        .cv {
            width: 100%;
            margin: auto;
            padding: 35px;
        }

        .user-detail {
            /* padding-bottom: 20px;
            border-bottom: 1px solid #ed5a37; */
            margin-bottom: 30px;
        }

        .user-name strong {
            font-size: 20px !important;
            color: #000;
        }

        .education-title {
            font-size: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ed5a37;
            color: #000;
            margin-bottom: 15px;
        }

        .user-img {
            float: right;
        }

        .user-img .avatar-lg {
            width: 95px;
        }

        .user-info>div {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .education-table {
            padding-bottom: 20px;
        }

        .education-table table td {
            padding: 7px 15px;
            padding-left: 0;
        }

        .education-table table .edu-info {
            padding-left: 25px;
        }

        .edu-info strong {
            font-size: 20px;
        }

        .user-preference,
        .user-skill {
            padding-bottom: 24px;
        }

        .preference-list,
        .skill-list {
            padding-left: 20px;
        }

        .preference-list li,
        .skill-list li {
            padding-bottom: 6px;
        }

        .color-bg {
            background-color: #eaeaea;
            padding: 5px;
        }


        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>

</head>

<body>

    <div class="cv">
        <div class="user-detail">
            <?php
            if ($job_seeker_personal_info->profile_pic != null) {
                $path = public_path('storage/job-seeker/' . $job_seeker_personal_info->profile_pic);
            } else {
                $path = public_path('frontend/assets/images/files/spy.png');
            }
            $imageData = file_get_contents($path);
            $base64Image = base64_encode($imageData);
            ?>
            <div class="user-img">
                <img src="data:image;base64,{{ $base64Image }}" alt="profile image" class="avatar-lg">
            </div>
            <div class="user-info">
                <div class="user-name">
                    <strong>
                        @if (isset($job_seeker_personal_info->first_name))
                            {{ $job_seeker_personal_info->first_name }} {{ $job_seeker_personal_info->middle_name }}
                            {{ $job_seeker_personal_info->last_name }}
                        @endif
                    </strong>
                </div>
                <div class="user-address">
                    <label>Address: </label>
                    <strong>{{ \App\Models\City::find($job_seeker_personal_info->current_city)->name }},
                        {{ \App\Models\District::find($job_seeker_personal_info->current_district)->name }}</strong>
                </div>
                <div class="user-number">
                    <label>Number: </label> <strong>{{ $job_seeker_personal_info->mobile_number }}</strong>
                </div>
                <div class="user-mail">
                    <label>Email: </label> <strong>{{ $job_seeker_personal_info->user->email }}</strong>
                </div>
            </div>
        </div>
        @if ($job_seeker_education_info != null)
            <?php
            $education = $job_seeker_education_info;
            $degree = json_decode($education->education_id);
            $institution = json_decode($education->institution);
            $university = json_decode($education->university);
            $passed_year = json_decode($education->passed_year);
            $study_field = json_decode($education->study_field_id);
            ?>
            <div class="user-education">
                <div class="education-title">
                    <strong>Education</strong>
                </div>

                <div class="education-table">
                    <table>
                        @foreach ($degree as $key => $data)
                            <tr>
                                <td>{{ $passed_year[$key] }}</td>
                                <td class="edu-info">
                                    <div>
                                        <strong>{{ \App\Models\Education::find($data)->title }} of
                                            {{ \App\Models\StudyField::find($study_field[$key])->title }}</strong>
                                    </div>
                                    <label class="small">
                                        {{ $university[$key] }}
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        @endif
        <?php
        $items = $job_seeker_personal_info->preferedJobs->pluck('title')->toArray();
        ?>
        @if ($items != null)
            <div class="user-preference">
                <div class="education-title">
                    <strong>Job Preference</strong>
                </div>
                <ul class="preference-list">
                    <li>
                        <label>Categories:</label>


                        <strong> {{ implode(', ', $items) }}</strong>
                    </li>
                    <li>
                        <label>Industries:</label>
                        <?php
                        $industries = $job_seeker_personal_info
                            ->preferedIndustry()
                            ->pluck('name')
                            ->toArray();
                        ?>

                        <strong> {{ implode(', ', $industries) }}</strong>
                    </li>
                    @if ($job_seeker_personal_info->looking_for != null)
                        <li>
                            <label>Available for:</label>
                            <strong>{{ $job_seeker_personal_info->employee_type($job_seeker_personal_info->looking_for)->title }}</strong>
                        </li>
                    @endif
                    @if ($job_seeker_personal_info->expected_salary != null)
                        <li>
                            <label>Expected Salary:</label> <strong>{{ $job_seeker_personal_info->expected_salary }}
                                <span class="color-bg">Monthly</span></strong>
                        </li>
                    @endif
                </ul>

            </div>
        @endif
        @if ($additional_field != null && $additional_field->skill != null)
            <div class="user-skill">
                <div class="education-title">
                    <strong>Skills & Specializations</strong>
                </div>


                <div class="skills-title">
                    <strong>Skills</strong>
                </div>
                <ul class="skill-list">
                    <?php
                    $skillIds = json_decode($additional_field->skill);
                    
                    if (!empty($skillIds)) {
                        $skills = App\Models\Skill::whereIn('id', $skillIds)
                            ->get(['title'])
                            ->toArray();
                    
                        if (!empty($skills)) {
                            foreach ($skills as $skill) {
                                echo '<li><strong>' . $skill['title'] . '</strong></li>';
                            }
                        }
                    }
                    ?>
                </ul>
                @if ($additional_field->language != null)
                    <div class="skills-title">
                        <strong>Language</strong>
                    </div>
                    <ul class="skill-list">
                        <ul class="skill-list">
                            <?php
                            $langIds = json_decode($additional_field->language);
                            
                            if (!empty($langIds)) {
                                $languages = App\Models\Language::whereIn('id', $langIds)
                                    ->get(['title'])
                                    ->toArray();
                            
                                if (!empty($languages)) {
                                    foreach ($languages as $language) {
                                        echo '<li><strong>' . $language['title'] . '</strong></li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                @endif
                </ul>

            </div>

        @endif
        <div class="user-skill">
            <div class="education-title">
                <strong>Personal Information</strong>
            </div>
            <ul class="skill-list">
                <li>
                    <label>Gender: </label><strong>{{ $job_seeker_personal_info->gender }}</strong>
                </li>
                <li>
                    <label>Maritial Status: </label><strong>{{ $job_seeker_personal_info->maritial_status }}</strong>
                </li>
                <li>
                    <label>Current Address: </label>
                    <strong>{{ \App\Models\City::find($job_seeker_personal_info->current_city)->name }},
                        {{ \App\Models\District::find($job_seeker_personal_info->current_district)->name }},
                        {{ \App\Models\Province::find($job_seeker_personal_info->current_province)->name }}</strong>
                </li>
                <li>
                    <label>Permanent Address:
                    </label><strong>{{ \App\Models\City::find($job_seeker_personal_info->permanent_city)->name }},
                        {{ \App\Models\District::find($job_seeker_personal_info->permanent_district)->name }},
                        {{ \App\Models\Province::find($job_seeker_personal_info->permanent_province)->name }}</strong>
                </li>
            </ul>

        </div>

    </div>

</body>

</html>
