<style>
/*.light_version .table tr td, .light_version .table tr th {*/
/*  border-color: #eaeaea;*/
/*  background: #fff;*/
/*}*/
table {
    border-collapse: collapse;
}
table tr td, table tr th{
    border:1px solid #000 !important;
}
@media print {
    html, body {
        print-color-adjust: exact;
    }
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script>
    document.getElementById('downloadBtn').addEventListener('click', function () {
        // Import jsPDF
        const { jsPDF } = window.jspdf;

        // Create a new instance of jsPDF
        const doc = new jsPDF();

        // Fetch data from the table
        const table = document.getElementById('table_data');
        const username = document.getElementById('user_name').innerText;
        const rows = table.querySelectorAll('tr');

        // Calculate cell width for two columns to take up 50% each
        const pageWidth = doc.internal.pageSize.getWidth();
        const margin = 10;
        const cellWidth = (pageWidth - margin * 2) / 2; // Subtracting margin for each side

        let startY = 20; // Start a bit lower to avoid top margin
        const rowHeight = 10;

        rows.forEach((row) => {
            const cells = row.querySelectorAll('th, td');
            let startX = margin;

            cells.forEach((cell, index) => {
                if (index < 2) { // Limit to 2 columns
                    // Draw border
                    doc.rect(startX, startY, cellWidth, rowHeight);

                    // Draw text with word wrapping
                    const text = doc.splitTextToSize(cell.innerText, cellWidth - 4); // Adjust for padding
                    doc.text(text, startX + 2, startY + 7); // Adjust for padding

                    startX += cellWidth; // Adjust this value based on your cell width
                }
            });

            startY += rowHeight; // Adjust this value based on your row height
        });

        // Save the generated PDF
        doc.save(username + '.pdf');
    });
    </script>
<div class="card">
    <div class="card-body ">
        <h3>{{ $user->name }}</h3>
        <table class="table table-bordered" id="table_data">
            <tr>
                <th colspan=2>Personal Details:</th>
            </tr>
            <tr>
                <th>Name: </th>
                <td id="user_name">{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email: </th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Username: </th>
                <td>@ {{ $user->username }}</td>
            </tr>
            <tr>
                <th>Mobile Number:</th>
                <td>{{ $user->job_seeker->mobile_number }}</td>
            </tr>



            <tr>
                <th>Date of Birth:</th>
                <td>{{ $user->job_seeker->date_of_birth }}</td>
            </tr>

            <tr>
                <th>Gender:</th>
                <td>{{ $user->job_seeker->gender }}</td>
            </tr>
<!--             <tr>-->
<!--                <th>Experience:</th>-->
<!--                <td>{{ $user->job_seeker->experience }}</td>-->
<!--            </tr>-->
            <!--<tr>-->
            <!--    <th>Date of Birth:</th>-->
            <!--    <td>{{ $user->job_seeker->date_of_birth }}</td>-->
            <!--</tr>-->

            <!--<tr>-->
            <!--    <th>Mobile Number:</th>-->
            <!--    <td>{{ $user->job_seeker->mobile_number }}</td>-->
            <!--</tr>-->

            <tr>
                <th>Maritial Status:</th>
                <td>{{ $user->job_seeker->maritial_status }}</td>
            </tr>

            <tr>
                <th colspan="2">Current Address:</th>
            </tr>
                <tr>
                <th>Province: </th>
                <td>{{ \App\Models\Province::find($user->job_seeker->current_province)->name??'' }}</td>
            </tr>
            <tr>
                <th>District: </th>
                <td>{{ \App\Models\District::find($user->job_seeker->current_district)->name??'' }}</td>
            </tr>
            <tr>
                <th>City: </th>
                <td>{{ \App\Models\City::find($user->job_seeker->current_city)->name??'' }}</td>
            </tr>
            <tr>
                <th colspan="2">Permanent Address: </th>
            </tr>
             <tr>
                <th>Province: </th>
                <td>{{ \App\Models\Province::find($user->job_seeker->permanent_province)->name??"" }}</td>
            </tr>
            <tr>
                <th>District: </th>
                <td>{{ \App\Models\District::find($user->job_seeker->permanent_district)->name??'' }}</td>
            </tr>
            <tr>
                <th>City: </th>
                <td>{{ \App\Models\City::find($user->job_seeker->permanent_city)->name??"" }}</td>
            </tr>

            <tr>
                <th colspan="2">Additional Information</th>
            </tr>
            <tr>
                <th>Prefered Job</th>
                <?php
        $items = $user->job_seeker->preferedJobs->pluck('title')->toArray();
        ?>
                @if ($items != null)
                 <?php
                        $industries = $user->job_seeker
                            ->preferedIndustry()
                            ->pluck('name')
                            ->toArray();
                        ?>
                <td>  {{ implode(', ', $items) }}</td>

 <tr>
                <th>Prefered Industries</th>
                <td>{{ implode(', ', $industries) }}</td>
            </tr>
@endif
            </tr>
            <tr>
                <th>Do the user have license?</th>
                <td>{{ $user->job_seeker->have_license }}</td>
            </tr>
            <tr>
                <th>Do the user have vehicle?</th>
                <td>{{ $user->job_seeker->have_vehicle }}</td>
            </tr>
            <tr>
                <th>Expected Salary:</th>
                <td>{{ $user->job_seeker->expected_salary }}</td>
            </tr>

            <tr>
                <th>Career Objective: </th>
                <td>{!! $user->job_seeker->career_objective !!}</td>
            </tr>
            @if(isset($user->job_seeker_experience))
            <tr>
                <th colspan="2">Experience </th>
            </tr>


            <tr>
                <th>Position</th>
                <td>
                    {{ json_decode($user->job_seeker_experience->position, true)[0] ?? 'N/A' }}
                </td>
            </tr>

            <tr>
                <th>Organization Name</th>
                <td>
                   {{ json_decode($user->job_seeker_experience->organization_name, true)[0] ?? 'N/A' }}
                </td>

            @if($user->job_seeker_experience->roles_and_responsibility)
            <tr>
                <th>Roles and Responsibilities</th>
                <td>
                    @php
                    // Decode the string into a plain text
                    $responsibilities = json_decode($user->job_seeker_experience->roles_and_responsibility, true)[0] ?? '';
                    // Split the text by the numbers (1., 2., etc.)
                    $responsibilities = preg_split('/(?=\d+\.)/', $responsibilities);
                    @endphp

                    @foreach($responsibilities as $responsibility)
                    @if(trim($responsibility))
                    {{ trim($responsibility) }}<br>
                    @endif
                    @endforeach
                </td>
            </tr>
            @else
            <tr>
                <th>Roles and Responsibilities</th>
                <td>N/A</td>
            </tr>
            @endif


            <tr>
                <th>Working From and To</th>
                <td>

                {{ json_decode($user->job_seeker_experience->joined_year, true)[0] ?? 'N/A' }} -
                {{ json_decode($user->job_seeker_experience->left_year, true)[0] ?? 'Present' }}

                </td>
            </tr>
            @else
            <tr>
                <th colspan="2">Experience</th>
            </tr>
            <tr>
                <td colspan="2">No experience data available</td>
            </tr>
            @endif

        </table>
    </div>
</div>
